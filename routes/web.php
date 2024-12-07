<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [AuthController::class, 'checkAuth'])->name("welcome");
Route::get('/', function(){
    return view('welcome');
})->name("welcome");

Route::get('/login', [AuthController::class, 'checkAuth'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("dashboard.category");
    Route::get("dashboard/barang", [ItemController::class, 'index'])->name("dashboard.barang");
    Route::get("dashboard/supplier", [SupplierController::class, 'index'])->name("category");
    Route::get("dashboard/satuan", [UnitController::class, 'index'])->name("satuan");

    Route::get("dashboard/lokasi", [LocationController::class, "index"])->name("lokasi");

    Route::get("dashboard/pengguna/{role?}", [UserController::class, 'index'])->name("pengguna");
    Route::post("dashboard/pengguna/store", [UserController::class, 'store'])->name("pengguna.store");
    Route::post("dashboard/pengguna/edit", [UserController::class, 'edit'])->name("pengguna.edit");
    Route::delete("dashboard/pengguna/delete/{id?}", [UserController::class, 'destroy'])->name("pengguna.delete");



    Route::delete("category/{id?}", [CategoryController::class, 'destroy'])->name("category.delete");
    Route::patch("category", [CategoryController::class, 'update'])->name("category.update");
    Route::post("category", [CategoryController::class, 'store'])->name("category.store");

    Route::post("supplier", [SupplierController::class, 'store'])->name("supplier.store");
    Route::patch("supplier", [SupplierController::class, 'update'])->name("supplier.update");
    Route::delete("supplier/{id?}", [SupplierController::class, 'destroy'])->name("supplier.delete");

    Route::post("unit", [UnitController::class, 'store'])->name("unit.store");
    Route::patch("unit", [UnitController::class, 'update'])->name("unit.update");
    Route::delete("unit/{id?}", [UnitController::class, 'destroy'])->name("unit.delete");

    Route::post("location", [LocationController::class, "store"])->name("location.store");
    Route::delete("location/{id?}", [LocationController::class, "destroy"])->name("location.delete");
    Route::patch("location", [LocationController::class, "update"])->name("location.update");

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
