<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::post('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'RoleGuard:superadmin'])->group(function () {

    Route::post('/test', function (Request $request) {
       return $request->user()->role;
    });

    Route::post('/category/new', [CategoryController::class, 'store']);
    Route::patch('/category/update', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/category/get', [CategoryController::class, 'get']);
});