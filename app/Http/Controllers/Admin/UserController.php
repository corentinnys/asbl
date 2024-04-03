<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createForm()
    {
        return view('admin.createForm');
    }
    public function create(Request $request)
    {
        DB::table('users')->insert([
            "name"=>$request->input('name'),
            "email"=>$request->input('mail'),
            "password"=>Hash::make($request->input("password"))
        ]);
    }
}
