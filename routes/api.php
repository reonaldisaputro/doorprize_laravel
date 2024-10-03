<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckerController;
use App\Http\Controllers\API\UndianController;
use App\Http\Controllers\API\PesertaController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\ValidationController;
use App\Http\Controllers\API\SubkategoriController;

Route::get('peserta', [PesertaController::class, 'index']);
Route::post('peserta', [PesertaController::class, 'store']);
Route::get('peserta/{id}', [PesertaController::class, 'show']);
Route::put('peserta/{id}', [PesertaController::class, 'update']);
Route::delete('peserta/{id}', [PesertaController::class, 'destroy']);

Route::post('undi/{subkategoriId}', [UndianController::class, 'undi']);
Route::get('undian/history', [UndianController::class, 'history']);
Route::get('undian/export', [UndianController::class, 'export']);

// Routes untuk Kategori
Route::get('kategori', [KategoriController::class, 'index']); // Menampilkan semua kategori
Route::get('kategori/{id}', [KategoriController::class, 'show']); // Menampilkan kategori dengan subkategori

// Routes untuk Subkategori
Route::get('subkategori', [SubkategoriController::class, 'index']); // Menampilkan semua subkategori
Route::get('subkategori/{id}', [SubkategoriController::class, 'show']); // Menampilkan subkategori berdasarkan ID

Route::put('peserta/{id}/validate', [ValidationController::class, 'validatePeserta']);

Route::put('/peserta/validate-by-code/{kode_peserta}', [CheckerController::class, 'validateByCode']);
