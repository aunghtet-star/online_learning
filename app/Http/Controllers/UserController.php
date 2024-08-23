<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\ZoomLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // home page
    public function index(Request $request)
    {

        $courses = Course::when(request('searchKey'), function($query){
            return $query->orwhere('name', 'like', '%' . request('searchKey') . '%')
                ->orwhere('description', 'like', '%' . request('searchKey') . '%')
                ->orwhere('instructor_name', 'like', '%' . request('searchKey') . '%');
        })->orderBy('created_at', 'desc')->paginate(6);
        // dd($courses);
        $categories = Category::all();

        return view('user.home', compact('courses', 'categories'));
    }

    // course list taken by user
    public function user_courses()
    {

        $user_courses = ZoomLink::join('users', 'users.id', 'zoom_links.user_id')
        ->leftjoin('courses', 'courses.id', 'zoom_links.course_id')
        ->select('zoom_links.*', 'zoom_links.id as zoom_link_id', 'courses.name as course_name',
                'users.name', 'users.email as email')
        ->where('zoom_links.user_id', Auth::user()->id)
        ->get();

        // dd($user_courses);

        return view('user.course.user_courses', compact('user_courses'));
    }

    // the couse detials which has been bought by user
    public function user_course_detials($id)
    {
        $zoom_data = ZoomLink::join('courses', 'courses.id', 'zoom_links.course_id')
        ->select('zoom_links.*', 'courses.name as course_name')
        ->where('zoom_links.id', $id)->firstOrFail();
        // dd($zoom_data);

        return view('user.course.user_course_details', compact('zoom_data'));
    }

    public function filterByCategory($id) {
        $courses = Course::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::all();
        // to show title for filtering
        $category = Category::where('id', $id)->first();
        return view('user.home', compact('courses', 'categories', 'category'));
    }

    // course details
    public function course_details($id) {
        $course = Course::findOrFail($id);
        // dd($course);
        return view('user.course.details', compact('course'));
    }
}
