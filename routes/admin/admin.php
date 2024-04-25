<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as adminLogin;




Route::prefix('admin')->group(function () {
    Route::get('/gestion/users', [App\Http\Controllers\Admin\UserController::class, 'gestion'])->name('gestionUser');
    Route::post('/gestion/users/insert', [App\Http\Controllers\Admin\UserController::class, 'insert'])->name('insertUser');
    Route::get('/gestion/users/delete/{userID}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('removeUser');
    Route::get('/login', [adminLogin::class, 'loginForm'])->name('AdminLogin');
    Route::post('/login', [adminLogin::class, 'login'])->name('AdminLogin');
    Route::post('/connexion', [adminLogin::class, 'connexion'])->name('AdminConnexion');
    Route::get('/gestion/permissions',[App\Http\Controllers\Admin\UserController::class, 'roleForm'])->name('permission');
    Route::post('/gestion/permissions/create',[App\Http\Controllers\Admin\PermissionsController::class, 'create'])->name('createPermission');
    Route::get('/gestion/permissions/delete',[App\Http\Controllers\Admin\PermissionsController::class, 'delete'])->name('deletePermission');
    Route::post('/gestion/permissions/update',[App\Http\Controllers\Admin\PermissionsController::class, 'update'])->name('updatePermission');

    Route::get('/gestion/roles',[App\Http\Controllers\Admin\RolesController::class, 'roles'])->name('roles');
    Route::post('/gestion/roles/update',[App\Http\Controllers\Admin\RolesController::class, 'update'])->name('roleUpdate');
    Route::get ('/gestion/roles/permission',[App\Http\Controllers\Admin\RolesController::class, 'getPermission'])->name('getPermissions');
});
