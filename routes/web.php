<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("category");
    Route::post("category/create", [CategoryController::class, 'create'])->name("category.create");
    Route::get("category/delete/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
});

Route::get("/invoice", function () {
    return view('invoice');
})->name("page.invoice");


Route::fallback(function () {
    return view('404');
})->name('fallback');