<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Service\Route;

Route::get('/', [ViewController::class, 'authorization']);
Route::get('/registration', [ViewController::class, 'registration']);

Route::post('/api/registration', [AuthController::class, 'registration']);
