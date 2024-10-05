<?php

namespace App\Http\Controllers\API;

use App\Models\Subkategori;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class SubkategoriController extends Controller
{

    public function index()
    {
        try {
            $subkategori = Subkategori::with('kategori')->get();
            if ($subkategori->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data subkategori yang ditemukan", 404);
            }
            return ResponseFormatter::success($subkategori, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $subkategori = Subkategori::with('kategori')->find($id);

            if (!$subkategori) {
                return response()->json(['message' => 'Subkategori tidak ditemukan'], 404);
            }

            return ResponseFormatter::success($subkategori, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }

    // Function untuk mendapatkan subkategori berdasarkan kategori_id
    public function getSubkategoriByKategoriId($kategoriId)
    {
        try {
            // Mencari subkategori berdasarkan kategori_id
            $subkategori = Subkategori::where('kategori_id', $kategoriId)->get();

            if ($subkategori->isEmpty()) {
                return ResponseFormatter::error(null, 'Tidak ada subkategori untuk kategori ini', 404);
            }

            return ResponseFormatter::success($subkategori, 'Daftar subkategori berhasil diambil');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, 'Terjadi kesalahan saat mengambil data subkategori', 500);
        }
    }
}
