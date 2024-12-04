<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::fallback(function () {
    return view('404');
})->name('fallback');