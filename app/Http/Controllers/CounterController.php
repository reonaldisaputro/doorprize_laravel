<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class CounterController extends Controller
{
    public function incrementCounter()
    {
        try {
            // Ambil jumlah total subkategori
            $jumlahSubkategori = Subkategori::count();

            // Ambil data counter pertama (hanya ada 1 record di tabel ini)
            $counter = Counter::first();

            // Variabel untuk menyimpan pesan
            $message = "";
            $is_last = false; // Variabel untuk menandai apakah ini subkategori terakhir

            // Jika tidak ada counter, buat satu dengan nilai awal 1
            if (!$counter) {
                $counter = Counter::create(['count' => 1]); // Counter dimulai dari 1
                $message = "Nilai counter dimulai dari 1.";
            } else {
                // Kurangi jumlah subkategori dengan 1 agar batas maksimal tepat
                $maxValue = $jumlahSubkategori;

                // Jika nilai counter belum mencapai jumlah subkategori, tambahkan 1
                if ($counter->count < $maxValue) {
                    $counter->increment('count');
                    $message = "Nilai counter bertambah.";
                } else {
                    $message = "Nilai counter telah mencapai maksimum.";
                }

                // Cek apakah ini subkategori terakhir
                if ($counter->count == $jumlahSubkategori) {
                    $is_last = true;  // Tandai ini sebagai subkategori terakhir
                    $message = "Ini merupakan subkategori terakhir.";
                }
            }

            // Kembalikan nilai counter, is_last, dan pesan dalam objek data
            return response()->json([
                'code' => 200,
                'data' => [
                    'count' => $counter->count,
                    'is_last' => $is_last,
                    'message' => $message,
                ]
            ], 200);
        } catch (\Exception $e) {
            // Mengembalikan error dalam format JSON standar
            return response()->json([
                'code' => '404',
                'data' => [
                    'message' => 'Terjadi kesalahan saat memperbarui counter: ' . $e->getMessage(),
                ]
            ], 500);
        }
    }
}
