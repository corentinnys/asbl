<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        // Vérifier si un fichier a été téléchargé
        $destinationPath = 'storage/docs';
        $file->move($destinationPath,$file->getClientOriginalName());
    }
}
