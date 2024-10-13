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

            // Tambahkan APP_URL ke setiap URL gambar
            $subkategori->transform(function ($item) {
                $item->image_url = $item->image ? config('app.url') . '/storage/' . $item->image : null;
                return $item;
            });

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
                return ResponseFormatter::error([
                    'message' => 'Subkategori tidak ditemukan'
                ], 'Subkategori tidak ditemukan', 404);
            }

            // Jika subkategori memiliki gambar, buat URL lengkap
            if ($subkategori->image) {
                $subkategori->image_url = config('app.url') . '/storage/' . $subkategori->image;
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

            $subkategori->transform(function ($item) {
                $item->image_url = $item->image ? config('app.url') . '/storage/' . $item->image : null;
                return $item;
            });

            if ($subkategori->isEmpty()) {
                return ResponseFormatter::error(null, 'Tidak ada subkategori untuk kategori ini', 404);
            }

            return ResponseFormatter::success($subkategori, 'Daftar subkategori berhasil diambil');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, 'Terjadi kesalahan saat mengambil data subkategori', 500);
        }
    }

    public function countAllSubkategori()
    {
        try {
            // Hitung total subkategori
            $jumlahSubkategori = Subkategori::count();

            // Return response dengan jumlah subkategori
            return ResponseFormatter::success($jumlahSubkategori, "Total jumlah subkategori berhasil dihitung");
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat menghitung subkategori', $e->getMessage(), 500);
        }
    }
}
