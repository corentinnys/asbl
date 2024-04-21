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
});
