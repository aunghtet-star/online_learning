<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ZoomLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZoomLinkController extends Controller
{
    // admin ကနေ zoom list ပို့ထားတဲ့ users များ
    public function list()
    {
        $zoomLinkUsers = ZoomLink::join('users', 'users.id', 'zoom_links.user_id')
            ->leftjoin('courses', 'courses.id', 'zoom_links.course_id')
            ->select('users.id as user_id', 'zoom_links.*', 'courses.name as course_name', 'users.name', 'users.email')
            ->get();
        // dd($zoomLinkUsers);

        return view('admin.zoomlink.list', compact('zoomLinkUsers'));
    }

    // create page
    public function create($payment_id)
    {
        // zoom link create page မှာ အဲ့ single payment record တစ်ခုထဲမှာ ပေးထားတဲ့ user ရဲ့ email, name ရချင်လို့
        $paidUser = Payment::join('users', 'users.id', 'payments.user_id')
            ->join('courses', 'courses.id', 'payments.course_id')
            ->select('users.id as user_id', 'users.name', 'users.email', 'courses.name as course_name', 'courses.id as course_id')
            ->where('payments.id', $payment_id)->firstOrFail();
        // dd($paidUser);

        return view('admin.zoomlink.create', compact('paidUser'));
    }

    // edit page
    public function edit($id)
    {
        $zoom_data = ZoomLink::join('users', 'users.id', 'zoom_links.user_id')
            ->join('courses', 'courses.id', 'zoom_links.course_id')
            ->select('users.id as user_id', 'zoom_links.*', 'courses.name as course_name', 'users.name', 'users.email')
            ->where('zoom_links.id', $id)->firstOrFail();
        // dd($zoom_data);

        return view('admin.zoomlink.edit', compact('zoom_data'));
    }

    // update zoom table
    public function update(Request $request, $id)
    {
        $this->zoomLinkCheckValidation($request);

        $data = [
            'user_id' => $request->userId,
            'course_id' => $request->courseId,
            'link' => $request->zoomLink,
            'description' => $request->zoomLinkDescription
        ];

        ZoomLink::where('id', $id)->update($data);
        return redirect()->route('admin.zoomLink.list')->with(['message' => 'Zoom Link has been updated']);
    }

    // delete
    public function delete($id)
    {
        // $zoomlink->delete();
        $zoom_data = ZoomLink::where('id', $id)->firstOrFail();
        if ($zoom_data) {
            $zoom_data->delete();
        }

        return back();
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->zoomLinkCheckValidation($request);

        $data = [
            'user_id' => $request->userId,
            'course_id' => $request->courseId,
            'link' => $request->zoomLink,
            'description' => $request->zoomLinkDescription
        ];

        ZoomLink::create($data);
        return redirect()->route('admin.zoomLink.list')->with(['message' => 'Zoom Link has been sent']);
    }

    private function zoomLinkCheckValidation($request)
    {
        return Validator::make($request->all(), [
            'zoomLink' => 'required',
            'zoomLinkDescription' => 'required',
        ])->validate();
    }
}
