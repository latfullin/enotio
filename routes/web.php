<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Service\Route;

Route::get('/', [ViewController::class, 'authorization'])->middleware(['guest']);
Route::get('/registration', [ViewController::class, 'registration'])->middleware(['guest']);

Route::get('/dashboard', [ViewController::class, 'registration'])->middleware(['auth']);

Route::post('/api/registration', [AuthController::class, 'registration']);
Route::post('/api/authorization', [AuthController::class, 'authorization']);
Route::post('/api/logout', [AuthController::class, 'logout']);
