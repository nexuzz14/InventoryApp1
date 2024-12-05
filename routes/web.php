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
Route::get("/invoice", function(){
    return view('invoice');
})->name("page.invoice");
Route::get("dashboard/kategori", function(){
    return view('dashboard.kategori');
})->name("kategory");

Route::fallback(function () {
    return view('404');
})->name('fallback');