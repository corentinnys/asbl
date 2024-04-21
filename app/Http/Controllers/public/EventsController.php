<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function confirmation(Request $request)
    {
        DB::table('planning_has_users')->insert(
            [
                "userID"=>$request->get('userID'),
                "planningID"=>$request->get('event'),
                'confirmation'=>$request->get('response')
            ]);
        return view('public.emails.confirmation');
    }
}
