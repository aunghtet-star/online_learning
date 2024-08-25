<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    // account list
    public function list() {
        $users = User::get();
        return view('admin.account.list', compact('users'));
    }
}
