<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\chartController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'checkAuth'])->name("welcome");
// Route::get('/{kategori?}', [AuthController::class, 'checkAuth']);
Route::delete("/chart/{id?}", [chartController::class, 'delete'])->name('chart.delete');
Route::patch("/chart/{id?}", [chartController::class, 'update'])->name('chart.update');
Route::post("/chart/{id?}", [chartController::class, 'store'])->name('chart.store');


Route::fallback(function () {
    return view('404');
})->name('fallback');
