<?php

namespace App\Http\Controllers\API;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {

        try {

            $kategori = Kategori::all();
            if ($kategori->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data kategori yang ditemukan", 404);
            }
            return ResponseFormatter::success($kategori, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }

    // Menampilkan kategori beserta subkategorinya
    public function show($id)
    {
        try {
            $kategori = Kategori::with('subkategori')->find($id); // Mengambil kategori dan subkategori terkait

            if (!$kategori) {
                return ResponseFormatter::error(null, "Tidak ada data kategori yang ditemukan", 404);
            }

            return ResponseFormatter::success($kategori, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }
}
