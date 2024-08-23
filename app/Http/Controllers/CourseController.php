<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{


    // course list
    public function list(Request $request)
    {

        $courses = Course::when($request->searchKey, function ($query) {
            return $query->where('category_id', request('searchKey'));
        })->orderBy('created_at', 'desc')->paginate(5);

        // $courses->append()->query();
        $courses->appends(request()->query());

        $categories = Category::all();
        // $courses->appends(request()->query());

        return view('admin.course.list', compact('courses', 'categories'));
    }

    // course create page
    public function create()
    {
        $categories = Category::all();
        return view('admin.course.create', compact('categories'));
    }

    // course store
    public function store(Request $request)
    {
        // dd($request->all());
        $this->courseValidationCheck($request, 'create');
        $course = $this->getCourseData($request);

        if ($request->hasFile('courseVideo') && $request->hasFile('courseImage')) {
            $video = uniqid() . "_" . $request->courseVideo->getClientOriginalName();
            $image = uniqid() . "_" . $request->courseImage->getClientOriginalName();
            // dd($video, $request->all());
            $request->courseVideo->storeAs('public/courseVideo/', $video);
            $request->courseImage->storeAs('public/courseImage/', $image);
            $course['course_video'] = $video;
            $course['image'] = $image;
        }

        Course::create($course);
        return redirect()->route('course.list')->with(['createSuccess' => 'Course Created Successfully!']);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        // dd($course);
        return view('admin.course.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $this->courseValidationCheck($request, 'update');

        $data = $this->getCourseData($request);

        if ($request->hasFile('courseImage')) {
            $dbImage = Course::where('id', $request->id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                // Storage dir means Storage/app
                Storage::delete('public/courseImage/' . $dbImage);
            }

            $imageName = uniqid() . $request->courseImage->getClientOriginalName();
            $request->courseImage->storeAs('public/courseImage/', $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('courseVideo')) {
            $dbVideo = Course::where('id', $request->id)->first();
            $dbVideo = $dbVideo->course_video;

            if ($dbVideo != null) {
                // Storage dir means Storage/app
                Storage::delete('public/courseVideo/' . $dbVideo);
            }

            $video = uniqid() . $request->courseVideo->getClientOriginalName();
            $request->courseVideo->storeAs('public/courseVideo/', $video);
            $data['course_video'] = $video;
        }

        Course::where('id', $id)->update($data);
        return redirect()->route('course.list')->with(['updateSuccess' => 'Course Updated Successfully!']);
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        if ($course) {
            $dbImage = $course->image;
            Storage::delete('public/courseImage/' . $dbImage);
        }

        $course->delete();
        return back();
    }

    public function searchWithCategory(Request $request)
    {
        // dd($request->category_id);
        $category_id = $request->category_id;
        $courses = Course::where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->get();


        return response()->json(['status' => "success", "courses" => $courses]);
    }


    private function courseValidationCheck($request, $action)
    {
        $validationRule = [
            'courseName' => 'required|max:100',
            'courseCategoryId' => 'required',
            'courseDescription' => 'required',
            // 'courseVideo' => 'required|mimes:mp4|max:204800',
            'courseInstructorName' => 'required',
            'coursePrice' => 'required',
        ];

        $validationRule['courseVideo'] = $action == "create" ? "required|mimes:mp4|max:204800" : 'mimes:mp4|max:204800';
        $validationRule['courseImage'] = $action == "create" ? "required|file|mimes:png,jpg,jpeg" : 'file|mimes:png,jpg,jpeg';

        Validator::make($request->all(), $validationRule)->validate();
    }

    private function getCourseData($request)
    {
        return [
            'author_id' => Auth::user()->id,
            'category_id' => $request->courseCategoryId,
            'name' => $request->courseName,
            'description' => $request->courseDescription,
            'instructor_name' => $request->courseInstructorName,
            'price' => $request->coursePrice
        ];
    }
}
