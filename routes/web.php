<?php

use App\Http\Controllers\ViewController;
use App\Service\Route;

Route::get('/', [ViewController::class, 'authorization']);
Route::get('/registration', [ViewController::class, 'registration']);
