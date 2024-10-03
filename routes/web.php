<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barcode-scanner', [CheckerController::class, 'showScanner']);
