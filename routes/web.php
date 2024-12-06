<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'checkAuth'])->name('home');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("dashboard.category");
    Route::get("dashboard/barang", function () {
        return view("dashboard.barang");
    })->name("category");
    Route::get("dashboard/supplier", [SupplierController::class, 'index'])->name("category");
    Route::get("dashboard/satuan", function () {
        return view("dashboard.satuan");
    })->name("category");

    Route::delete("category/delete/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
    Route::patch("category/update", [CategoryController::class, 'update'])->name("category.update");
    Route::post("category/create", [CategoryController::class, 'create'])->name("category.create");

    Route::post("supplier/create", [SupplierController::class, 'create'])->name("supplier.create");
    Route::patch("supplier/update", [SupplierController::class, 'update'])->name("supplier.update");
    Route::delete("supplier/delete/{id?}", [SupplierController::class, 'destroy'])->name("supplier.delete");
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