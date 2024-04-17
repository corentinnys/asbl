<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\Admin\LoginController as adminLogin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('download/{filename}', [App\Http\Controllers\public\DocumentsController::class, 'download'])->name('download')->middleware(\App\Http\Middleware\verifIsConnect::class);
Route::get('admin/logs', [App\Http\Controllers\Admin\DocumentController::class, 'logs'])->name('logs')->middleware(\App\Http\Middleware\verifIsConnect::class);
Route::post("import/csv",[App\Http\Controllers\Admin\UserController::class,'importCsv'])->name("importFile");
Route::get("import/csv",[App\Http\Controllers\Admin\UserController::class,'formCsv']);
Route::get('/home', function () {
    return view('welcome');
})->name("home")->middleware('App\Http\Middleware\verifIsConnect');
Route::get("login",[LoginController::class, 'ShowLoginForm'])->name("formLogin");
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('documents',[\App\Http\Controllers\public\DocumentsController::class,'index'])->name('documents')->middleware('App\Http\Middleware\verifIsConnect');;
Route::post('connexion', [LoginController::class, 'connexion'])->name('connexion');
Route::get('deconnexion', [LoginController::class, 'deconnexion'])->name('deconnexion');
Route::get('admin/login', [adminLogin::class, 'loginForm'])->name('AdminLogin');
Route::post('admin/login', [adminLogin::class, 'login'])->name('AdminLogin');
Route::post('admin/connexion', [adminLogin::class, 'connexion'])->name('AdminConnexion');
Route::get('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'createForm'])
    ->name('createForm')->middleware('App\Http\Middleware\verifAdmin');
Route::post('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser')->middleware('App\Http\Middleware\verifAdmin');;
Route::get('admin/modify/password', [App\Http\Controllers\Admin\UserController::class, 'passwordForm'])->name('passwordUpdate');
Route::post('admin/modify/password', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('passwordUpdated');
Route::post('admin/create/document', [App\Http\Controllers\Admin\DocumentController::class, 'create'])->name('createDocument');
Route::get('admin/create/document', [App\Http\Controllers\Admin\DocumentController::class, 'documentForm'])->name('createForm');
Route::get('admin/gestion/users', [App\Http\Controllers\Admin\UserController::class, 'gestion'])->name('gestionUser');
Route::get('profils/show/{id}', [App\Http\Controllers\UsersController::class, 'profils'])->name('profils');
Route::post('profils/update', [App\Http\Controllers\UsersController::class, 'update'])->name('userUpdate');
Route::get('update/user/confirm/{id}', [App\Http\Controllers\UsersController::class, 'confirm'])->name('updateUser');
Route::get('search', [App\Http\Controllers\public\DocumentsController::class, 'search'])->name('searchDoc');
Route::get('search/degre', [App\Http\Controllers\public\DocumentsController::class, 'searchByDegre'])->name('searchDegre');
Route::get('search/category', [App\Http\Controllers\public\DocumentsController::class, 'searchByCategory'])->name('searchByCategory');
Route::get('tri', [App\Http\Controllers\public\DocumentsController::class, 'tri'])->name('triFolder')->middleware(\App\Http\Middleware\verifIsConnect::class);
Route::get('pdf/view', [App\Http\Controllers\public\DocumentsController::class, 'view'])->name('view')->middleware(\App\Http\Middleware\verifIsConnect::class);
Route::post('user/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('updateUsers');
Route::get('mailing', [App\Http\Controllers\Admin\MailingController::class, 'index']);
Route::post('mailing', [App\Http\Controllers\Admin\MailingController::class, 'send'])->name('mailingPost');
