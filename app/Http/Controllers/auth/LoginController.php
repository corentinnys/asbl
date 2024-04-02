<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $mail = $request->get('mail');
        $password = $request->get('password');
        $user =$this->_usersController->getByMailAndPassword($mail,$password);
        $request->session()->put('mail', $mail);

        if (!is_null($user))
        {
            $token =  $this->getToken();
            $this->_usersController->setTokenIntoDb($user->id,$token);


            return view("auth.token");
        }
    }
    public function getToken()
    {
        $token = [];
        for ($i = 0; $i <5 ; $i++) {
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
        if(!is_null($user))
        {
            Auth::login($user);
            dd(Auth::check());
        }
    }
}
