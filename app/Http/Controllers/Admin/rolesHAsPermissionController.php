<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rolesHAsPermissionController extends Controller
{
    public function index(int $permissionID)
    {
        return DB::table("roles_has_permission")
            ->join("roles",'roles_has_permission.roleID','=','roles.id')
            ->where('permissionID','=',$permissionID)
            ->get();
    }


}
