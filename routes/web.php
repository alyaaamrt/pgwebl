<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;

Route::get('/', [PointsController::class, 'index'])->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');

Route::post('/store-point', [PointsController::class,'store'])->name('point.store');

Route::resource('points', PointsController::class);
