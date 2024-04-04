<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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
                "two_factor_secret"=>$token,
                "end_twoo_factor_code"=>Carbon::now()->addMinute(2)
           ]);
    }

    public function getByMailAndToken($mail,$token)
    {

        return User::where('email',$mail)
            ->where('two_factor_secret',$token)->first();
    }

    public function getByMail($mail)
    {
        return User::where('email',$mail)->first();
    }

    public function getByMailAndRole($mail)
    {
        return User::where('email',$mail)
            ->whereIn('roleID',[2,3,4])->first();
    }
    public function passwordUpdate()
    {
      return view("auth.password") ;
    }
}
