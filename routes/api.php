<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemsRequestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::post('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/me', function (Request $request) {
//     return response()->json($request->user()
// })
// );->middleware('auth :sanctum');
// Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
//     return response()->json(['name' => $request->user()->name]);
// });
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json([
        'user' => $request->user()->only(['name', 'email', 'role'])
    ]);
});

Route::middleware('auth:sanctum')->get('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    Auth::logout();
});



Route::middleware(['auth:sanctum', 'RoleGuard:superadmin'])->group(function () {

    Route::post('/test', function (Request $request) {
        return $request->user()->role;
    });

    Route::post('/category/new', [CategoryController::class, 'store']);
    Route::patch('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::post('/location/new', [LocationController::class, 'store']);
    Route::patch('/location/update/{id}', [LocationController::class, 'update']);
    Route::delete('/location/delete/{id}', [LocationController::class, 'destroy']);

    Route::post('/unit/new', [UnitController::class, 'store']);
    Route::patch('/unit/update/{id}', [UnitController::class, 'update']);
    Route::delete('/unit/delete/{id}', [UnitController::class, 'destroy']);

    Route::post('/supplier/new', [SupplierController::class, 'store']);
    Route::patch('/supplier/update/{id}', [SupplierController::class, 'update']);
    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'destroy']);

    Route::post('/pengguna/new', [UserController::class, 'store']);
    Route::patch('/pengguna/update/{id}', [UserController::class, 'update']);
    Route::delete('/pengguna/delete/{id}', [UserController::class, 'destroy']);

    Route::post('/client/new', [ClientController::class, 'store']);
    Route::patch('/client/update/{id}', [ClientController::class, 'update']);
    Route::delete('/client/delete/{id}', [ClientController::class, 'destroy']);


    Route::get('/request/get', [ItemsRequestController::class, 'getAllRequest']);
    Route::get('/request/get/{id}', [ItemsRequestController::class, 'getDetailRequest']);
    Route::patch('/request/updateDetail', [ItemsRequestController::class, 'updateItemsRequestDetail']);
    //storeRequest
    Route::post('/transaction/store', [TransactionController::class, 'storeTransaction']);
    Route::post('/transaction/create', [TransactionController::class, 'create']);


    Route::post('/sale/store', [saleController::class, 'create']);
    Route::patch('/sale/update/{id}', [saleController::class, 'updatePayDate']);
    Route::get('/sale/get/{id}', [saleController::class, 'getDetail']);
    Route::get('/sale/get', [saleController::class, 'getAllSales']);
    Route::get('/item/{id}/warehouse', [SaleController::class, 'getItemLocations']);




    // Route::get('/transaction/get', [TransactionController::class, 'getAllInvoice']);
    Route::get('/transaction/get', [TransactionController::class, 'getAllTransactions']);
    Route::get('/invoice/get/{id}', [TransactionController::class, 'getDetailTransactions']);
    Route::get('/transaction/get/{id}', [TransactionController::class, 'getDetailPurchase']);
    Route::patch('/transaction/pay/{id}', [TransactionController::class, 'pay']);


    Route::post('/items/new', [ItemController::class, 'store']);
    Route::get('/items/get', [ItemController::class, 'getAllData']);
    Route::patch('/items/locationStock', [ItemController::class, 'updateLocation']);
    Route::patch('/items/update', [ItemController::class, 'update']);
    Route::delete('/items/delete/{id}', [ItemController::class, 'destroy']);
    Route::get('/items/getDetail/{id}', [ItemController::class, 'getLocalData']);






});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/request/new', [TransactionController::class, 'store']);
    Route::get('/items/get', [ItemController::class, 'getAllData']);
    Route::get('/category/get', [CategoryController::class, 'getData']);
    Route::get('/location/get', [LocationController::class, 'getData']);
    Route::get('/unit/get', [UnitController::class, 'getData']);
    Route::get('/supplier/get', [SupplierController::class, 'getData']);
    Route::get('/pengguna/get', [UserController::class, 'getData']);
    Route::get('/client/get', [ClientController::class, 'getData']);
});
