<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::post('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/me', function (Request $request) {
//     return response()->json($request->user()
// })
// );->middleware('auth :sanctum');
// Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
//     return response()->json(['name' => $request->user()->name]);
// });
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user()->only(['name', 'email', 'role']));
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


    Route::post('/request/new', [TransactionController::class, 'store']);
    Route::get('/request/get', [TransactionController::class, 'getAllRequest']);
    Route::patch('/request/update', [TransactionController::class, 'updateItemsRequestDetail']);


    Route::post('/transaction/store', [TransactionController::class, 'storeTransaction']);
    Route::get('/transaction/get', [TransactionController::class, 'getAllInvoice']);
    Route::patch('/transaction/pay', [TransactionController::class, 'updateTransaction']);


    Route::post('/items/new', [ItemController::class, 'store']);
    Route::get('/items/get', [ItemController::class, 'getAllData']);
    Route::post('/items/locationStock', [ItemController::class, 'updateAll']);
    Route::get('/items/getDetail', [ItemController::class, 'getLocalData']);



});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/category/get', [CategoryController::class, 'getData']);
    Route::get('/location/get', [LocationController::class, 'getData']);
    Route::get('/unit/get', [UnitController::class, 'getData']);
    Route::get('/supplier/get', [SupplierController::class, 'getData']);
    Route::get('/pengguna/get', [UserController::class, 'getData']);
    Route::get('/client/get', [ClientController::class, 'getData']);
});
