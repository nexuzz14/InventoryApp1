<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/login', [AuthController::class, 'checkAuth'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("category");
    Route::get("dashboard/barang", function () {
        return view("dashboard.barang");
    })->name("barang");
    Route::get("dashboard/supplier", function () {
        return view("dashboard.supplier");
    })->name("supplier");
    Route::get("dashboard/satuan", function(){
        return view("dashboard.satuan");
    })->name("satuan");

    Route::get("dashboard/lokasi", function () {
        return view("dashboard.lokasi");
    })->name("lokasi");

    Route::get("dashboard/pengguna", function () {
        return view("dashboard.pengguna");
    })->name("pengguna");


    Route::delete("category/delete/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
    Route::patch("category/update", [CategoryController::class, 'update'])->name("category.update");

    Route::get("dashboard/user", function(){
        return view("dashboard.user");
    })->name("user");

    Route::post("category/create", [CategoryController::class, 'create'])->name("category.create");
    Route::get("category/delete/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
});

Route::get("/invoice", function () {
    return view('invoice');
})->name("page.invoice");


Route::get("dashboard/barang", function () {
    return view("dashboard.barang");
})->name("barang");
Route::fallback(function () {
    return view('404');
})->name('fallback');
