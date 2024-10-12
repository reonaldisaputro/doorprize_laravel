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
    // public function undi($subkategoriId)
    // {
    //     try {
    //         // Cek apakah sudah ada undian yang dilakukan untuk subkategori ini
    //         $existingUndian = Undian::where('subkategori_id', $subkategoriId)->exists();

    //         if ($existingUndian) {
    //             // Jika undian sudah pernah dilakukan, return error
    //             return ResponseFormatter::error(null, 'Undian untuk subkategori ini sudah dilakukan', 400);
    //         }

    //         // Cari subkategori berdasarkan ID
    //         $subkategori = Subkategori::findOrFail($subkategoriId);

    //         // Ambil peserta secara acak sebanyak qty yang ada di subkategori
    //         $peserta = Peserta::inRandomOrder()->take($subkategori->qty)->get();

    //         // Jika tidak ada peserta yang cukup untuk diundi
    //         if ($peserta->isEmpty()) {
    //             return ResponseFormatter::error(null, 'Tidak ada peserta yang tersedia untuk undian ini', 404);
    //         }

    //         $winners = [];

    //         foreach ($peserta as $p) {
    //             // Buat entri undian
    //             $undian = Undian::create([
    //                 'subkategori_id' => $subkategoriId,
    //                 'peserta_id' => $p->id,
    //             ]);

    //             $winners[] = [
    //                 'undian' => $undian,
    //                 'subkategori' => $subkategori,
    //                 'peserta' => $p,
    //             ];

    //             // Hapus peserta (gunakan soft delete jika diperlukan)
    //             $p->delete();
    //         }

    //         // Return success response dengan ResponseFormatter
    //         return ResponseFormatter::success($winners, 'Undian berhasil dilakukan');
    //     } catch (\Exception $e) {
    //         // Jika terjadi kesalahan lain, tangkap exception dan kembalikan error
    //         return ResponseFormatter::error(null, 'Terjadi kesalahan: ' . $e->getMessage(), 500);
    //     }
    // }

    // public function undi($subkategoriId)
    // {
    //     try {
    //         // Cek apakah sudah ada undian yang dilakukan untuk subkategori ini
    //         $existingUndian = Undian::where('subkategori_id', $subkategoriId)->exists();

    //         if ($existingUndian) {
    //             return ResponseFormatter::error(null, 'Undian untuk subkategori ini sudah dilakukan', 400);
    //         }

    //         // Cari subkategori berdasarkan ID
    //         $subkategori = Subkategori::findOrFail($subkategoriId);

    //         // Ambil peserta secara acak yang valid sebanyak qty yang ada di subkategori
    //         $peserta = Peserta::where('is_valid', true) // Hanya peserta yang valid
    //             ->inRandomOrder()
    //             ->take($subkategori->qty)
    //             ->get();

    //         if ($peserta->isEmpty()) {
    //             return ResponseFormatter::error(null, 'Tidak ada peserta yang valid untuk undian ini', 404);
    //         }

    //         $winners = [];

    //         foreach ($peserta as $p) {
    //             // Buat entri undian
    //             $undian = Undian::create([
    //                 'subkategori_id' => $subkategoriId,
    //                 'peserta_id' => $p->id,
    //             ]);

    //             $winners[] = [
    //                 'undian' => $undian,
    //                 'subkategori' => $subkategori,
    //                 'peserta' => $p,
    //             ];

    //             // Hapus peserta (gunakan soft delete jika diperlukan)
    //             $p->delete();
    //         }

    //         // Return successs response dengan ResponseFormatter
    //         return ResponseFormatter::success($winners, 'Undian berhasil dilakukan');
    //     } catch (\Exception $e) {
    //         return ResponseFormatter::error(null, 'Terjadi kesalahan: ' . $e->getMessage(), 500);
    //     }
    // }

    // public function undi($subkategoriId)
    // {
    //     try {
    //         // Cek apakah sudah ada undian yang dilakukan untuk subkategori ini
    //         $existingUndian = Undian::where('subkategori_id', $subkategoriId)->exists();

    //         if ($existingUndian) {
    //             return ResponseFormatter::error(null, 'Undian untuk subkategori ini sudah dilakukan', 400);
    //         }

    //         // Cari subkategori berdasarkan ID
    //         $subkategori = Subkategori::findOrFail($subkategoriId);

    //         // Ambil peserta secara acak sebanyak qty yang ada di subkategori
    //         $peserta = Peserta::inRandomOrder()->take($subkategori->qty)->get();

    //         if ($peserta->isEmpty()) {
    //             return ResponseFormatter::error(null, 'Tidak ada peserta yang tersedia untuk undian ini', 404);
    //         }

    //         $winners = [];

    //         foreach ($peserta as $p) {
    //             // Buat entri undian
    //             $undian = Undian::create([
    //                 'subkategori_id' => $subkategoriId,
    //                 'peserta_id' => $p->id,
    //             ]);

    //             $winners[] = [
    //                 'undian' => $undian,
    //                 'subkategori' => $subkategori,
    //                 'peserta' => [
    //                     'nama' => $p->nama,
    //                     'merchant' => $p->merchant,
    //                     'titik_kumpul' => $p->titik_kumpul,
    //                     'nomor_bus' => $p->nomor_bus,
    //                     'kode_peserta' => $p->kode_peserta
    //                 ]
    //             ];

    //             // Hapus peserta (gunakan soft delete jika diperlukan)
    //             $p->delete();
    //         }

    //         // Return success response dengan ResponseFormatter
    //         return ResponseFormatter::success($winners, 'Undian berhasil dilakukan');
    //     } catch (\Exception $e) {
    //         return ResponseFormatter::error(null, 'Terjadi kesalahan: ' . $e->getMessage(), 500);
    //     }
    // }

    public function undi($subkategoriId)
    {
        try {
            // Cari subkategori berdasarkan ID
            $subkategori = Subkategori::findOrFail($subkategoriId);

            // Hitung total peserta yang sudah diundi untuk subkategori ini
            $totalPesertaDiundi = Undian::where('subkategori_id', $subkategoriId)->count();

            // Jika total peserta yang sudah diundi sama dengan qty subkategori, hentikan undian
            if ($totalPesertaDiundi >= $subkategori->qty) {
                $isDone = [
                    'is_done' => true
                ];
                return ResponseFormatter::error($isDone, 'Undian untuk subkategori ini sudah selesai, semua peserta telah diundi', 400);
            }

            // Buat aturan batch otomatis: 20, 20, dan 10 (atau lainnya sesuai dengan qty subkategori)
            $batchSizes = [20, 20, 10];

            // Tentukan batch yang akan dijalankan berdasarkan peserta yang sudah diundi
            $batchIndex = intdiv($totalPesertaDiundi, 20); // Index batch (0, 1, atau 2)

            // Jika batchIndex melebihi jumlah batch (misal undian selesai), hentikan undian
            if ($batchIndex >= count($batchSizes)) {
                $isDone = [
                    'is_done' => true
                ];
                return ResponseFormatter::error($isDone, 'Semua peserta sudah diundi dalam semua batch', 400);
            }

            // Ambil jumlah peserta yang harus diundi dalam batch ini, 
            // pastikan jumlah yang diundi tidak melebihi sisa peserta yang tersedia
            $jumlahPesertaUntukUndian = min($batchSizes[$batchIndex], $subkategori->qty - $totalPesertaDiundi);

            // Ambil peserta secara acak yang belum diundi sebanyak jumlah batch saat ini
            $peserta = Peserta::where('is_drawn', false)
                ->inRandomOrder()
                ->take($jumlahPesertaUntukUndian)
                ->get();

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
                    'is_done' => false,
                    'undian' => $undian,
                    'subkategori' => $subkategori,
                    'peserta' => [
                        'nama' => $p->nama,
                        'merchant' => $p->merchant,
                        'titik_kumpul' => $p->titik_kumpul,
                        'nomor_bus' => $p->nomor_bus,
                        'kode_peserta' => $p->kode_peserta
                    ]
                ];

                // Tandai peserta sudah diundi
                $p->is_drawn = true;
                $p->save();
            }

            // Return success response dengan ResponseFormatter
            return ResponseFormatter::success($winners, 'Undian batch ' . ($batchIndex + 1) . ' berhasil dilakukan');
        } catch (\Exception $e) {
            return ResponseFormatter::error(null, 'Terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }

    public function history()
    {
        try {
            // Mengambil data undian dengan peserta, subkategori, dan kategori
            $undian = Undian::with(['peserta', 'subkategori.kategori'])->get();

            if ($undian->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data subkategori yang ditemukan", 404);
            }

            return ResponseFormatter::success($undian, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }
}
