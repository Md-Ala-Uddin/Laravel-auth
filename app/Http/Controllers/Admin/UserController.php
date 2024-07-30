<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request) {
        $users = User::all();
        return view('admin.users', [ 'users' => $users ]);
    }
}
