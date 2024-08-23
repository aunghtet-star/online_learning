<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Psr\Log\LoggerAwareInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function list()
    {
        $paidUsers = Payment::select('users.name', 'users.email', 'courses.name as course_name', 'payments.*')
        ->leftjoin('users', 'users.id', 'payments.user_id')
        ->leftjoin('courses', 'courses.id', 'payments.course_id')
        ->get();
        // dd($paidUsers);
        return view('admin.payment.list', compact('paidUsers'));
        // dd($userPaid);

    }

    // create payment
    public function create(Request $request)
    {
        // logger($request->all());
        $validator = $this->paymentValidationCheck($request);

        if ($validator->fails()) {
            return response()->json(["status" => 400, "errors" => $validator->messages()]);
        } else {

            $data = [
                'user_id' => Auth::user()->id,
                'course_id' => $request->input('courseId'),
            ];

            if ($request->hasFile('paymentImage')) {
                $image = uniqid() . "_" . $request->paymentImage->getClientOriginalName();
                $request->paymentImage->storeAs('public/paymentImage/', $image);
                $data['image'] = $image;
            }

            Payment::create($data);
            return response()->json(['status' => 200, 'message' => "Pyament have been sent successfully! Admin will contact you recently ☺️☺️☺️☺️"]);
        }


        // $paymentImage = $request->paymentImage;
        // logger($paymentImage);
        // return response()->json(["message"=>"Payment success"]);

    }



    private function paymentValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'paymentImage' => 'required|file|mimes:png,jpg,jpeg',
        ]);
    }
}
