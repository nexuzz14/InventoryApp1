<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
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
    Route::patch('/category/update', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);


    Route::post('/request/new', [chartController::class, 'store']);
    Route::get('/request/get', [TransactionController::class, 'getAllRequest']);
    Route::patch('/request/update', [TransactionController::class, 'updateItemsRequestDetail']);


    Route::post('/transaction/store', [TransactionController::class, 'storeTransaction']);
    Route::get('/transaction/get', [TransactionController::class, 'getAllInvoice']);
    Route::patch('/transaction/pay', [TransactionController::class, 'updateTransaction']);


    Route::post('/items/new', [ItemController::class, 'store']);
    Route::post('/items/locationStock', [ItemController::class, 'updateAll']);
    Route::get('/items/get', [ItemController::class, 'getLocalData']);
    // Route::post('/items/get', [ItemController::class, 'getAllItems']);


});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/category/get', [CategoryController::class, 'getData']);
});
