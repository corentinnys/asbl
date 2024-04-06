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

Route::get('/home', function () {
    return view('welcome');
})->name("home")->middleware('App\Http\Middleware\verifIsConnect');
Route::get("login",[LoginController::class, 'ShowLoginForm'])->name("formLogin");
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('documents',[\App\Http\Controllers\public\DocumentsController::class,'index'])->name('documents');
Route::post('connexion', [LoginController::class, 'connexion'])->name('connexion');
Route::get('deconnexion', [LoginController::class, 'deconnexion'])->name('deconnexion');
Route::get('admin/login', [adminLogin::class, 'loginForm'])->name('AdminLogin');
Route::post('admin/login', [adminLogin::class, 'login'])->name('AdminLogin');
Route::post('admin/connexion', [adminLogin::class, 'connexion'])->name('AdminConnexion');
Route::get('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'createForm'])
    ->name('createForm')->middleware('App\Http\Middleware\verifAdmin');
Route::post('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser');
Route::get('admin/modify/password', [App\Http\Controllers\Admin\UserController::class, 'passwordForm'])->name('passwordUpdate');
Route::post('admin/modify/password', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('passwordUpdated');

