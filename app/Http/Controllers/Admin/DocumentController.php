<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    private $_fileController;
    public function __construct(FileController $fileController)
    {
        $this->_fileController = $fileController;
    }
    public function documentForm()
    {
        return view("admin.document");
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'degre' => 'bail|required',
            'type' => 'bail|required',
            'file' => 'required|file|mimes:pdf'
        ],[
            'required' => 'Le champ :attribute est requis.',
            'mimes' =>"accepte uniquement des pdf"
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }



       $document = $request->file('file');
       $name = $request->get('name');
       $degre = $request->get('degree');
       $typeID = $request->get('type');
       $this->_fileController->upload($request);
       DB::table('documents')->insert([
           "name"=>$name,
           "degree_id"=>$degre,
           "link"=>"storage/docs/".$document->getClientOriginalName(),
           "type_id"=>$typeID
       ]);
    }
}
