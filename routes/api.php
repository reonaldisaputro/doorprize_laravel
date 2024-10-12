<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckerController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UndianController;
use App\Http\Controllers\API\PesertaController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\ValidationController;
use App\Http\Controllers\API\SubkategoriController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route protected (hanya bisa diakses jika sudah login)
// Route::middleware('auth:sanctum')->group(function () {

// });

// Route::group([
//     'prefix' => 'v1',
//     'middleware' => ['auth:sanctum', 'with_fast_api_key'], // Menggabungkan middleware Sanctum dan middleware custom
// ], function () {

//     Route::post('/logout', [AuthController::class, 'logout']);

//     Route::get('/peserta', [PesertaController::class, 'index']);
//     Route::post('peserta', [PesertaController::class, 'store']);
//     Route::get('peserta/{id}', [PesertaController::class, 'show']);
//     Route::put('peserta/{id}', [PesertaController::class, 'update']);
//     Route::delete('peserta/{id}', [PesertaController::class, 'destroy']);

//     Route::post('undi/{subkategoriId}', [UndianController::class, 'undi']);
//     Route::get('undian/history', [UndianController::class, 'history']);
//     Route::get('undian/export', [UndianController::class, 'export']);

//     // Routes untuk Kategori
//     Route::get('kategori', [KategoriController::class, 'index']); // Menampilkan semua kategori
//     Route::get('kategori/{id}', [KategoriController::class, 'show']); // Menampilkan kategori dengan subkategori

//     // Routes untuk Subkategori
//     Route::get('subkategori', [SubkategoriController::class, 'index']); // Menampilkan semua subkategori
//     Route::get('subkategori/{id}', [SubkategoriController::class, 'show']); // Menampilkan subkategori berdasarkan ID
//     Route::get('/subkategori/kategori/{kategoriId}', [SubkategoriController::class, 'getSubkategoriByKategoriId']);

//     Route::put('peserta/{id}/validate', [ValidationController::class, 'validatePeserta']);

//     Route::put('/peserta/validate-by-code/{kode_peserta}', [CheckerController::class, 'validateByCode']);
// });

Route::middleware('with_fast_api_key', 'auth:sanctum')->group(function () {

    Route::get('/peserta', [PesertaController::class, 'index']);
    Route::post('peserta', [PesertaController::class, 'store']);
    Route::get('peserta/{id}', [PesertaController::class, 'show']);
    Route::put('peserta/{id}', [PesertaController::class, 'update']);
    Route::delete('peserta/{id}', [PesertaController::class, 'destroy']);

    Route::post('undi/{subkategoriId}', [UndianController::class, 'undi']);
    // Route::post('/undi/{subkategoriId}/{jumlahPerUndian}', [UndianController::class, 'undi']);

    Route::get('undian/history', [UndianController::class, 'history']);
    Route::get('undian/export', [UndianController::class, 'export']);

    // Routes untuk Kategori
    Route::get('kategori', [KategoriController::class, 'index']); // Menampilkan semua kategori
    Route::get('kategori/{id}', [KategoriController::class, 'show']); // Menampilkan kategori dengan subkategori

    // Routes untuk Subkategori
    Route::get('subkategori', [SubkategoriController::class, 'index']); // Menampilkan semua subkategori
    Route::get('subkategori/{id}', [SubkategoriController::class, 'show']); // Menampilkan subkategori berdasarkan ID
    Route::get('/subkategori/kategori/{kategoriId}', [SubkategoriController::class, 'getSubkategoriByKategoriId']);

    Route::put('peserta/{id}/validate', [ValidationController::class, 'validatePeserta']);

    Route::put('/peserta/validate-by-code/{kode_peserta}', [CheckerController::class, 'validateByCode']);

    Route::get('/subkategori-count/count', [SubkategoriController::class, 'countAllSubkategori']);

    Route::post('/increment-counter', [CounterController::class, 'incrementCounter']);
});
