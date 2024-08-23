<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // dashboard user or admin
    public function dashboard() {
        // dd(Auth::user()->role);
        // return true;
        if (Auth::user()->role == "user") {
            return redirect()->route('user.index');
        }

        return redirect()->route('course.list');
    }
}
