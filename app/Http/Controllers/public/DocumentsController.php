<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    public function index()
    {
        $docs = DB::table("documents")->get();
        return view("public.documents.index",compact("docs"));
    }
}
