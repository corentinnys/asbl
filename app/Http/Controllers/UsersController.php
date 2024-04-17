<?php

namespace App\Http\Controllers;

use App\Mail\UpdateUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
    public function profils(int $id)
    {
      $user =DB::table('Users')->where('id','=',$id)->first();
      if (is_null($user))
      {
          return redirect('home');
      }
        if ($user->id == Auth::id() && Auth::check() == true )
        {
            return view('public.users.show',compact('user'));

        } else
        {
            return redirect('home');
        }
    }
    public function update(Request $request)
    {
        $email = $request->get('email');
        $street = $request->get('street');
        $commune = $request->get('commune');
        $codePostal = $request->get('codePostal');



        $user = DB::table("users")->where('id', '=', $request->get('id'))->first();
        Mail::to('administrateur@chezmoi.com')->send(new UpdateUser($email, $street, $commune, $codePostal, $user));
    }
    private function verificationMail($mail)
    {
        return is_null($this->getByMail($mail))?true:false;
    }

    public function confirm(Request $request,int $id)
    {
        // Obtenir les valeurs de session
        $email = $request->get('email');

        $codePostal = $request->get('codePostal');
        $commune = $request->get('commune');
        $street = $request->get('rue');

        // Mise à jour des données utilisateur dans la base de données
        DB::table("users")->where('id', '=', $id)->update([
            'email' => $email,
            'Rue' => $street,
            'CodePostal' => $codePostal,
            'Commune' => $commune
        ]);
        return view('admin.users.confirmupdate');
    }
}
