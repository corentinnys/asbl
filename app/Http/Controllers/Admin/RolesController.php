<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class RolesController extends Controller
{
    public function roles()
    {
        $roles = DB::table("roles")->get();
        return view('admin.roles', compact('roles'));
    }

    public function countUserHasRole($roleID)
    {
        return DB::table("users")->where('roleID', $roleID)->count();
    }

    public function update(Request $request)
    {
        $valeurs =$request->get('valeurs');
        $roleName =$request->get('role');
        $role =DB::table('roles')->where('name',$roleName)->first();
        foreach ($valeurs as $key =>$item)
        {

            if ($item=="true")
            {
                DB::table('roles_has_permission')->insert([
                    "roleID"=>$role->id,
                    "permissionID"=>$key
                ]);
            }
        }





        }




}
