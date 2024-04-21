<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

class CalendarController extends Controller
{
    public function __construct()
    {

    }
    public function calendar()
    {
        $events = DB::table('planning')->get();

        // Formater les événements pour les passer à la vue
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event->name,
                'start' => $event->date
                // Ajoutez d'autres propriétés d'événement si nécessaire
            ];
        }
        return view('admin.calendar', ['events' => $formattedEvents]);
    }

    public function setPlanning(Request $request)
    {
        $name = $request->input('name');
        $dateString = $request->input('date');
       // $dateString = "Sat Apr 20 2024 00:00:00 GMT+0200 (heure d’été d’Europe centrale)";

// Supprimer les informations de fuseau horaire
        $dateString = preg_replace('/\(.*\)/', '', $dateString);

// Parser la date avec Carbon
        $date = \Carbon\Carbon::parse($dateString);

// Formater la date au format jour-mois-année
        $dateObj = new \DateTime($date);

// Formater la date en français
        $dateFormattee = $dateObj->format('d F Y');

// Remplacer le nom du mois en anglais par sa traduction française
        $moisEnAnglais = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $moisEnFrancais = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $dateFormattee = str_replace($moisEnAnglais, $moisEnFrancais, $dateFormattee);

        DB::table('planning')->insert([
            "name"=>$name,
            "date"=>$dateObj->format('y-m-d')
        ]);
        $lastEventID = DB::getPdo()->lastInsertId();
        $users = DB::table('users')->get();
        foreach ($users as $user)
        {
            Mail::to('administrateur@chezmoi.com')
                ->send(new Calendar($dateFormattee,$name,$user->id,$lastEventID));
        }




    }


}
