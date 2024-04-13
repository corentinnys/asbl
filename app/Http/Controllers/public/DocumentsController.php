<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{

    public function index()
    {
        $degreeIDs = [];

        for ($i=1;$i<=auth()->user()->degreeID;$i++)
        {
           array_push($degreeIDs,$i) ;
        }

        // Vérifier si un utilisateur est authentifié
        if (auth()->check()) {
            // Récupérer les documents seulement si l'utilisateur est authentifié
            $docs = DB::table("documents")
                ->join('type',"type.id","=","documents.type_id")
                ->select("type.name as typeName","documents.*")
                ->whereIn('degree_id', $degreeIDs)
                ->get();
            return view("public.documents.index", compact("docs"));
        } else {
            // Rediriger l'utilisateur  vers la page de connexion ou effectuer une autre action appropriée
            return redirect()->route('login');
        }
    }

    public function search(Request $request)
    {
        $search  = $request->get('search');
        $degreeIDs = [];

       if (Auth::check() == false)
       {
           return redirect()->route("login");
       }

        for ($i=1;$i<=auth()->user()->degreeID;$i++)
        {
            array_push($degreeIDs,$i) ;
        }


        $search = $request->get('search');

        $docs = DB::table("documents")
            ->join('type',"type.id","=","documents.type_id")
            ->where('documents.name', 'like', "%$search%")
            ->whereIn('degree_id', $degreeIDs)
            ->select("type.name as typeName","documents.*")
            ->get();
        return view("public.documents.index", compact("docs"));
    }
    public function tri(Request $request)
    {

       $niveau = $request->get('niveau');

        $docs = DB::table("documents")
            ->Join('type',"type.id","=","documents.type_id")
            ->where('documents.degree_id', '=', $niveau)
            ->select("type.name as typeName","documents.*")
            ->get();

        return view("public.documents.index", compact("docs"));
    }
    public function searchByDegre(Request $request)
    {

        $degreValues = $request->get('degre'); // Assurez-vous que $degreValues est un tableau simple

        $docs = DB::table("documents")
            ->join('type', 'type.id', '=', 'documents.type_id')
            ->whereIn('documents.degree_id', $degreValues)
            ->select("type.name as typeName", "documents.*")
            ->get();
        return response()->json($docs);
    }

    public function searchByCategory(Request $request)
    {
        $categoryValues = $request->get('category'); // Assurez-vous que $degreValues est un tableau simple

        $docs = DB::table("documents")
            ->join('type', 'type.id', '=', 'documents.type_id')
            ->whereIn('type.id', $categoryValues)
        ->select("type.name as typeName", "documents.*")
            ->get();

        return response()->json($docs);
    }

}
