<?php

namespace App\Http\Controllers\API;

use App\Models\Undian;
use App\Models\Peserta;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class UndianController extends Controller
{
    public function undi($subkategoriId)
    {
        try {
            // Cek apakah sudah ada undian yang dilakukan untuk subkategori ini
            $existingUndian = Undian::where('subkategori_id', $subkategoriId)->exists();

            if ($existingUndian) {
                // Jika undian sudah pernah dilakukan, return error
                return ResponseFormatter::error(null, 'Undian untuk subkategori ini sudah dilakukan', 400);
            }

            // Cari subkategori berdasarkan ID
            $subkategori = Subkategori::findOrFail($subkategoriId);

            // Ambil peserta secara acak sebanyak qty yang ada di subkategori
            $peserta = Peserta::inRandomOrder()->take($subkategori->qty)->get();

            // Jika tidak ada peserta yang cukup untuk diundi
            if ($peserta->isEmpty()) {
                return ResponseFormatter::error(null, 'Tidak ada peserta yang tersedia untuk undian ini', 404);
            }

            $winners = [];

            foreach ($peserta as $p) {
                // Buat entri undian
                $undian = Undian::create([
                    'subkategori_id' => $subkategoriId,
                    'peserta_id' => $p->id,
                ]);

                $winners[] = [
                    'undian' => $undian,
                    'subkategori' => $subkategori,
                    'peserta' => $p,
                ];

                // Hapus peserta (gunakan soft delete jika diperlukan)
                $p->delete();
            }

            // Return success response dengan ResponseFormatter
            return ResponseFormatter::success($winners, 'Undian berhasil dilakukan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan lain, tangkap exception dan kembalikan error
            return ResponseFormatter::error(null, 'Terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }


    public function history()
    {
        try {
            $undian = Undian::with(['peserta', 'subkategori'])->get();
            if ($undian->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data subkategori yang ditemukan", 404);
            }
            return ResponseFormatter::success($undian, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }
}
