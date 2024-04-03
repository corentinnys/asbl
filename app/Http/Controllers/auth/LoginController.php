<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticate;
use App\Mail\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    private $_usersController;
    public function __construct(UsersController $usersController)
    {
        $this->_usersController = $usersController;
    }
    public function ShowLoginForm()
    {
        if (Auth::check())
        {
            return redirect()->route("home");
        }else
        {
            return view('auth.login');
        }

    }
    public function login(Request $request)
    {
        $mail = $request->get('mail');
        $password = $request->get('password');
        $user =$this->_usersController->getByMail($mail);
        if (is_null($user))
        {
            return redirect()->route("login")->with('error', 'email incorrect');
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

                return view("auth.token");
            }


        } else {

            return redirect()->route("login")->with('error', 'mot de passe incorrect');

        }

    }

    public function getToken()
    {
        $token = [];
        for ($i = 0; $i <7 ; $i++) {
            array_push($token,random_int(1,9));
        }
        $array = implode("", $token);
        return $array;
    }
    public function connexion(Request $request)
    {
        $token = $request->get('token');
        $mailFromSession = $request->session()->get('mail');

        $user = $this->_usersController->getByMailAndToken($mailFromSession,$token);
        if (!is_null($user) && Carbon::now()->lessThanOrEqualTo($user->end_twoo_factor_code))
        {
            Auth::login($user);
           return view("welcome");
        }else if (is_null($user)){
            $error = "numero invalide";
            return view("auth.token",compact("error"));
        }else{
            $error = "code expiré";
            return view("auth.token",compact("error"));
        }
    }
    public function deconnexion()
    {

        Auth::logout();
        return \redirect()->route("login");
    }


}
