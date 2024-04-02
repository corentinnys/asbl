<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getByMailAndPassword($mail,$password)
    {
       return  DB::table("users")
            ->where('email',$mail)
            ->where('password',$password)->first();
    }

    public function setTokenIntoDb(int $userID,string $token)
    {
       DB::table("users")
           ->where("id",$userID)
           ->update([
                "two_factor_secret"=>$token
           ]);
    }

    public function getByMailAndToken($mail,$token)
    {

        return User::where('email',$mail)
            ->where('two_factor_secret',$token)->first();
    }
}
