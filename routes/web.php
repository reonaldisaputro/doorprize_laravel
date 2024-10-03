<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\CheckerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barcode-scanner', [CheckerController::class, 'showScanner']);
Route::get('/generate-qrcode/{kodePeserta}', [QRCodeController::class, 'generateQRCode']);
