<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Mail\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $_usersController;
    public function __construct(UsersController $usersController)
    {
        $this->_usersController = $usersController;
    }
    public function loginForm()
    {
        return view('admin.auth.loginForm');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail' => 'bail|required|email',
            'password' => 'bail|required'
        ],[
            'required' => 'Le champ :attribute est requis.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $mail = $request->get('mail');
        $password = $request->get('password');
        $user =$this->_usersController->getByMailAndRole($mail);

        if (is_null($user))
        {
            return redirect()->route("AdminLogin")->with('error', 'email incorrect');
        }
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($password);
            $user->save();
        }

        else if (Hash::check($password, $user->password)) {
            $request->session()->put('mail', $mail);

            if (!is_null($user))
            {
                $token =  $this->getToken();
                $this->_usersController->setTokenIntoDb($user->id,$token);
                Mail::to('administrateur@chezmoi.com')
                    ->send(new Token($token));

                return view("admin.auth.token");
            }


        } else {

            return redirect()->route("login")->with('error', 'mot de passe incorrect');

        }

    }
    public function getToken()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}|[];\',./?><';
        $token = '';
        $length = strlen($characters);
        for ($i = 0; $i < 7; $i++) {
            $token .= $characters[random_int(0, $length - 1)];
        }
        return $token;
    }
    public function connexion(Request $request)
    {

        $token = $request->get('token');
        $mailFromSession = $request->session()->get('mail');

        $user = $this->_usersController->getByMailAndToken($mailFromSession,$token);

        if (!is_null($user) && Carbon::now()->lessThanOrEqualTo($user->end_twoo_factor_code))
        {
            Auth::login($user);
            return view("admin.index");
        }else if (is_null($user)){
            $error = "numero invalide";
            return view("auth.token",compact("error"));
        }else{
            $error = "code expiré";
            return view("auth.token",compact("error"));
        }
    }

}
