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
use Illuminate\Testing\Fluent\Concerns\Has;use Maatwebsite\Excel\Facades\Excel;

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

    public function gestion()
    {
        $users = DB::table('users')->get();
        return view('admin.users.index',compact('users'));
    }

    public function update(Request $request)
    {
        $mail = $request->get('mail');
        $commune = $request->get('commune');
        $codePostal = $request->get('codePostal');
        $rue = $request->get('rue');
        $date_init = $request->get('date_init');
        $date_elev = $request->get('date_elev');
        $date_pass= $request->get('date_pass');
        $id = $request->get('id');

        DB::table("users")
            ->where("id",'=', $id)
            ->update([
                "email"=>$mail,
                "date_init"=>$date_init,
                "date_elev"=>$date_elev,
                "date_pass"=>$date_pass,
                "Commune"=>$commune,
                "CodePostal"=>$codePostal,
                'Rue' => $rue
            ]);
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('users');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        // Initialise un tableau pour stocker les données CSV
        $rows = [];

        // Ouvre le fichier CSV en mode lecture
        $handle = fopen(public_path("uploads/users.csv"), 'r');

        // Vérifie si le fichier a été ouvert avec succès
        if ($handle !== false) {
            // Lit la première ligne du fichier CSV pour obtenir les clés
            $keys = fgetcsv($handle, 4096);

            // Lit chaque ligne du fichier CSV
            while (($line = fgetcsv($handle, 4096)) !== false) {
                // Associe chaque valeur à sa clé correspondante
                $rowData = array_combine($keys, $line);

                // Ajoute les données au tableau des lignes
                $rows[] = $rowData;
            }

            // Ferme le fichier CSV
            fclose($handle);
        } else {
            // Gère les erreurs d'ouverture du fichier
            return response()->json(['error' => 'Impossible d\'ouvrir le fichier CSV'], 500);
        }
        $roleID = 1;
        // Affiche le tableau contenant toutes les lignes du fichier CSV
        foreach ($rows as $data)
        {
            switch ($data["role"])
            {
                case "secretaire" :
                    $roleID = 2;
                    break;

                case "admin" :
                    $roleID = 3;
                    break;
                case "tresorier" :
                    $roleID = 4;
                    break;
                default:
                    $roleID = 1 ;

            }


            if (!is_null($data['date_init']))
            {
                $degreID = 1 ;
            }
            else if (!is_null($data['date_pass']))
            {
                $degreID = 2 ;
            }
            else if (!is_null($data['date_elev']))
            {
                $degreID = 3 ;
            }

            if($data['date_pass']== "NULL")
            {
                $dateDegre = null;
            }else
            {
                $dateDegre = $data['date_pass'];
            }
            if($data['date_elev']== "NULL")
            {
                $dateDegre = null;
            }else{
                $dateDegre = $data['date_elev'];
            }

           $existUser= DB::table('users')
               ->where('name','=',$data["name"])
               ->where('lastName','=',$data["lastName"])
               ->first();
           $password = $this->createPassword(10);
            Mail::to('administrateur@chezmoi.com')
                ->send(new password($password));

            if (is_null($existUser))
            {

                DB::table('users')->insert(
                    [
                        "lastName"=>$data["lastName"],
                        "name"=>$data["name"],
                        "email"=>$data["email"],
                        "password"=> Hash::make($password),
                        "Commune"=>$data["Commune"],
                        "CodePostal"=>$data["codePostal"],
                        "Rue"=>$data["Rue"],
                        "roleID"=>$roleID,
                        "date_init"=>$data['date_init'],

                        "date_pass"=>$dateDegre,
                        "date_elev"=>$dateDegre,
                        "degreeID"=>$degreID
                    ]
                );
            }else
            {
                DB::table('users')->where('email','=',$data["email"])->update( [
                    "lastName"=>$data["lastName"],
                    "name"=>$data["name"],
                    "email"=>$data["email"],
                    "password"=> Hash::make($password),
                    "Commune"=>$data["Commune"],
                    "CodePostal"=>$data["codePostal"],
                    "Rue"=>$data["Rue"],
                    "roleID"=>$roleID,
                    "date_init"=>$data['date_init'],

                    "date_pass"=>$dateDegre,
                    "date_elev"=>$dateDegre,
                    "degreeID"=>$degreID
                ]);
            }


        }
        return redirect()->back();
    }
    public function formCsv()
    {
        return view('admin.users.importFile');
    }


    public function insert(Request $request)
    {
        $password =$this->getToken() ;
        DB::table('users')->insert([
           "lastName" =>$request->get('lastName'),
           "name" =>$request->get('name'),
           "email" =>$request->get('email'),
            "date_init"=> $request->get('date_init'),
            "date_pass"=> $request->get('date_pass'),
            "date_elev"=> $request->get('date_elev'),
            "Commune"=> $request->get('Commune'),
            "CodePostal"=> $request->get('codePostal'),
            "Rue"=> $request->get('rue'),
            "password"=>Hash::make($password)
        ]);
    }

    public function getToken()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}|[];\',./?><';
        $token = '';
        $length = strlen($characters);
        for ($i = 0; $i < 20; $i++) {
            $token .= $characters[random_int(0, $length - 1)];
        }
        return $token;
    }


    public function delete(int $userID)
    {
        DB::table('users')->where('id','=',$userID)->delete();
    }

    public function roleForm()
    {
       $permissions = DB::table('permissions')->get();
        return view('admin.permissions',compact('permissions'));
    }

}

