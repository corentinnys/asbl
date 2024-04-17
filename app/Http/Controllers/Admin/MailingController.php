<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\mailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class MailingController extends Controller
{
    public function index()
    {
        return view('admin.mailing.index');
    }
    public function send(Request $request)
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            Mail::to($user->email)
                ->send(new mailing($request->input('name'),$request->input('description')));
        }

        return view('admin.mailing.confirm');
    }
}
