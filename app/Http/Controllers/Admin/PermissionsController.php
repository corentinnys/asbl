<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    public function create(Request $request)
    {
        DB::table('permissions')->insert([
            'name'=>$request->input('name')
        ]);
    }
    public function update(Request $request)
    {
        DB::table('permissions')
            ->where('id','=',$request->input('id'))
            ->update([
            'name'=>$request->input('name')
        ]);
    }

    public function delete(Request $request)
    {
        DB::table('permissions')->where('id','=',$request->get('id'))->delete();
    }
}
