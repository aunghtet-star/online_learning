<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // admin profile page
    public function detail()
    {
        return view('admin.profile.detail');
    }

    public function update(Request $request, $id)
    {
        $this->profileValidationCheck($request);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->hasFile('profileImage')) {

            $dbImage = User::where('id', $id)->firstOrFail();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                // Storage dir means Storage/app
                Storage::delete('public/profileImage/' . $dbImage);
            }

            $image = uniqid() . "_" . $request->profileImage->getClientOriginalName();
            $request->profileImage->storeAs('public/profileImage/', $image);
            $data['image'] = $image;
        }

        $user = User::where('id', $id)->update($data);

        return back()->with(['updateSuccess' => "Your account has been updated successfully"]);
    }

    // change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    // change password
    public function changePassword(Request $request)
    {
        $this->checkPasswordValidation($request);

        $dbUser = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbUser->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            Auth::logout();

            // Redirect to the login page
            return redirect('/login')->with('status', 'Password changed successfully. Please log in with your new password.');
        }
        return back()->with(['changePasswordFail' => 'Old Password does not match!']);
    }

    // check
    private function profileValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'profileImage' => 'file|mimes:png,jpg,jpeg'
        ])->validate();
    }

    // check password validation
    private function checkPasswordValidation($request)
    {

        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|min:8|max:15',
        ])->validate();
    }
}
