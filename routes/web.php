<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitsRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'checkAuth'])->name("welcome");
// Route::get('/{kategori?}', [AuthController::class, 'checkAuth']);   
Route::get("/order/{idbarang?}", [UnitsRequestController::class, 'create'])->name('order');
Route::post("/order/{idbarang?}", [UnitsRequestController::class, 'store'])->name('storeOrder');
Route::get("/chart", [chartController::class, 'chart'])->name('chart');
Route::delete("/chart/{id?}", [chartController::class, 'delete'])->name('chart.delete');
Route::patch("/chart/{id?}", [chartController::class, 'update'])->name('chart.update');
Route::post("/chart/{id?}", [chartController::class, 'store'])->name('chart.store');

Route::get("/request-barang", [TransactionController::class, "getAllRequest"])->name("request.barang");

// gatau
// Route::get('/login', [AuthController::class, 'checkAuth'])->name('login');
Route::get('/categories-data', [CategoryController::class, 'getData'])->name('categories.data');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['RoleGuard:superadmin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("dashboard/category", [CategoryController::class, 'index'])->name("dashboard.category");
    Route::get("dashboard/barang", [ItemController::class, 'barangIndex'])->name("dashboard.barang");
    Route::get("dashboard/pembelian", [ItemController::class, 'pembelianIndex'])->name("dashboard.pembelian");
    Route::get("dashboard/supplier", [SupplierController::class, 'index'])->name("category");
    Route::get("dashboard/satuan", [UnitController::class, 'index'])->name("satuan");
    Route::get("/dashboard/permintaan-barang", function () {
        return view("dashboard.permintaan-barang");
    })->name('dashboard.permintaan');
    Route::get("/dashboard/invoice", function (){
        return view("dashboard.invoice");
    })->name('dashboard.invoice');

    Route::get("/list/invoice", [TransactionController::class, "getAllInvoice"])->name("list.invoice");
    Route::post("/dashboard/invoice", [TransactionController::class, "updateTransaction"])->name("invoice.updatePayment");

    Route::get("dashboard/lokasi", [LocationController::class, "index"])->name("lokasi");

    Route::get("dashboard/pengguna/{role?}", [UserController::class, 'index'])->name("pengguna");
    Route::post("dashboard/pengguna/store", [UserController::class, 'store'])->name("pengguna.store");
    Route::patch("dashboard/pengguna/{id?}", [UserController::class, 'update'])->name("pengguna.edit");
    Route::delete("dashboard/pengguna/{id?}", [UserController::class, 'destroy'])->name("pengguna.delete");



    Route::delete("category/
    {id?}", [CategoryController::class, 'destroy'])->name("category.delete");
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
    Route::patch("item", [ItemController::class, "update"])->name("item.update");
    
    Route::patch("request/item/detail", [TransactionController::class, "updateItemsRequestDetail"])->name("request.item.detail");
    Route::post("transaction", [TransactionController::class, "storeTransaction"])->name("transaction.store");
});
Route::get('/invoice', [UserController::class, "getOwnInvoice"])->name("invoice.user");
Route::get('/detail/invoice/{id}', [UserController::class, "getDetailOwnInvoice"])->name("invoice.detail");

Route::fallback(function () {
    return view('404');
})->name('fallback');
