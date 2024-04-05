<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\password;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function createForm()
    {
        return view('admin.createForm');
    }
    public function create(Request $request)
    {
        $passwod =$this->createPassword(16);
        Mail::to('administrateur@chezmoi.com')
            ->send(new password($passwod));
        DB::table('users')->insert([
            "name"=>$request->input('name'),
            "email"=>$request->input('mail'),
            "password"=>Hash::make($passwod)
        ]);

    }
    private function createPassword(int $numberCaractere)
    {
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}|[];\',./?><';
            $token = '';
            $length = strlen($characters);
            for ($i = 0; $i < $numberCaractere; $i++) {
                $token .= $characters[random_int(0, $length - 1)];
            }
            return $token;
        }
    }

    public function passwordForm()
    {
        return view("auth.password");
    }

    public function updatePassword(Request $request)
    {
        $old = $request->input('passwordOld');
        $mail = $request->input('mail');
        $new = $request->input('passwordNew');



        $validator = Validator::make($request->all(), [
            'mail' => 'bail|required|email',
            'passwordOld' => 'bail|required',
            'passwordNew' => 'bail|required'
        ],[
            'required' => 'Le champ :attribute est requis.']);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }



        $user =User::where("email",$mail)->first();
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        if (Hash::check($old, $user->password))
        {
            User::where("email",$mail)->update(
                [
                    "password"=> Hash::make($new)
                ]);
            return redirect()->route('home');
        }

    }
}
