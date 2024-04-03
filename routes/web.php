<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;

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

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('connexion', [LoginController::class, 'connexion'])->name('connexion');
Route::get('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'createForm'])->name('createForm');
Route::post('admin/create/user', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser');

