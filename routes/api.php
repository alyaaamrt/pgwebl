<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('api.points');
Route::get('/polylines', [ApiController::class, 'polylines'])->name('api.polylines');
Route::get('/polygons', [ApiController::class, 'polygons'])->name('api.polygons');
