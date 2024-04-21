<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    public function searchByFilter(Request $request)
    {
        //$values = $request->get('values');
        //$values = $request->all();

        $docs = DB::table("documents");

       /* foreach ($values as $value)
        {
           // dd($value['value']);
           // $value['name'] == "category";
            if( $value['name'] == "category" )
            {

                // Ajouter la condition pour la catégorie
                //$docs->whereIn('type_id', [$value['value']]);
                $docs->whereIn('type_id', [$value['value']]);
                //$docs->whereIn('type_id', [$value['value']]);
            }
          /*  else if ($value['name'] == "type") // Utiliser else if pour d'autres conditions
            {
                // Ajouter la condition pour le type
                $docs->whereIn('type_id', [$value['value']]);
            }*/
       // }*/

        // Exécuter la requête et obtenir les résultats
        //$result = $docs->get();

        $values = $request->get('values');

        $docs = DB::table("documents");

        $categoryValues = []; // Initialisez un tableau vide pour les valeurs de catégorie
        $degreeValues = []; // Initialisez un tableau vide pour les valeurs de catégorie

        foreach ($values as $key => $value) {
            if ($value['name'] == "category") {
                // Ajoutez la valeur de la catégorie à $categoryValues
                $categoryValues[] = $value['value'];
            }
           elseif  ($value['name'] == "degree") {
                // Ajoutez la valeur de la catégorie à $categoryValues
                $degreeValues[] = $value['value'];
            }

        }

// Vérifiez si des valeurs de catégorie ont été récupérées
        if (!empty($categoryValues)) {
            // Utilisez whereIn avec les valeurs de catégorie pour la condition
            $docs->whereIn('type_id', $categoryValues);
        }
        if (!empty($degreeValues)) {
            // Utilisez whereIn avec les valeurs de catégorie pour la condition
            $docs->whereIn('degree_id', $degreeValues);
        }

        $result = $docs->get();
        return response()->json($result);

    }

    public function download(string $filename)
    {
        $completeName = auth()->user()->name . " " . auth()->user()->lastName;

        try {
            // Début de la transaction
            DB::beginTransaction();

            // Insérer dans la table de logs
            DB::table('logs')->insert([
                'nameOfUser' => $completeName,
                'fichier' => $filename,
                'date' => now()
            ]);

            // Valider la transaction
            DB::commit();
        } catch (\Exception $e) {
            // En cas d'erreur, annuler la transaction
            DB::rollback();

            // Journaliser l'erreur
            Log::error('Une erreur est survenue lors de l\'insertion dans les logs: ' . $e->getMessage());

            // Retourner une réponse d'erreur
            return response()->json(['message' => 'Une erreur est survenue lors de la transaction.'], 500);
        }
        $filePath = 'storage/docs/' . $filename . '.pdf';

// Après avoir inséré dans les logs, procéder au téléchargement du fichier
        return Response::download($filePath, $filename . '.pdf');

        // Chemin du fichier à télécharger
       // $filePath = 'storage/docs/' . $filename . '.pdf';

        // Vérifier si le fichier existe sur le serveur
      //  if (!file_exists($filePath)) {
       //     return response()->json(['error' => 'Le fichier n\'existe pas sur le serveur'], 404);
        //}

        // Téléchargement du fichier avec une réponse différée
       // return Response::download($filePath, $filename . '.pdf');
    }

    public function view(Request $request)
    {
        $pdf = new Dompdf();

// Options de configuration
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

// Restreindre les autorisations du PDF
        $options->set('copy', false); // Interdire la copie du contenu
        $options->set('print', false); // Interdire l'impression du document

        $pdf->setOptions($options);

        $pdf->loadHtml('<h1>Contenu du PDF</h1>');

        $pdf->render();

// Retourne le PDF en tant que chaîne de caractères
        $pdfContent = $pdf->output();

// Envoyer le contenu du PDF en tant que réponse HTTP avec l'en-tête approprié
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="document.pdf"');

        echo $pdfContent;
        exit;


    }
}
