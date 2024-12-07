<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/login', [AuthController::class, 'checkAuth'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("dashboard.category");
    Route::get("dashboard/barang", [ItemController::class, 'index'])->name("dashboard.barang");
    Route::get("dashboard/supplier", [SupplierController::class, 'index'])->name("category");
    Route::get("dashboard/satuan", [UnitController::class, 'index'])->name("satuan");

    Route::get("dashboard/lokasi", function () {
        return view("dashboard.lokasi");
    })->name("lokasi");

    Route::get("dashboard/pengguna", function () {
        return view("dashboard.pengguna");
    })->name("pengguna");


    Route::delete("category/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
    Route::patch("category", [CategoryController::class, 'update'])->name("category.update");
    Route::post("category", [CategoryController::class, 'store'])->name("category.store");

    Route::post("supplier", [SupplierController::class, 'store'])->name("supplier.store");
    Route::patch("supplier", [SupplierController::class, 'update'])->name("supplier.update");
    Route::delete("supplier/{id?}", [SupplierController::class, 'destroy'])->name("supplier.delete");

    Route::post("unit", [UnitController::class, 'store'])->name("unit.store");
    Route::patch("unit", [UnitController::class, 'update'])->name("unit.update");
    Route::delete("unit/{id?}", [UnitController::class, 'destroy'])->name("unit.delete");

    Route::get("/form-options", [MasterController::class, 'getAllMasterData'])->name("form-options");

    Route::post("item", [ItemController::class, "store"])->name("item.store");
    Route::delete("item/{id}", [ItemController::class, "destroy"])->name("item.delete");

});

Route::get("/invoice", function () {
    return view('invoice');
})->name("page.invoice");

Route::fallback(function () {
    return view('404');
})->name('fallback');
