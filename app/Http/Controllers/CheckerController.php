<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class CheckerController extends Controller
{
    public function showScanner()
    {
        return view('checker.barcode'); // Mengarahkan ke view barcode scanner
    }

    /**
     * Validasi peserta berdasarkan barcode (kode peserta).
     */
    public function validateByCode($kode_peserta)
    {
        // Cari peserta berdasarkan kode peserta
        $peserta = Peserta::where('kode_peserta', $kode_peserta)->first();

        if (!$peserta) {
            return ResponseFormatter::error(null, 'Peserta tidak ditemukan', 404);
        }

        // Tandai peserta sebagai valid
        $peserta->is_valid = true;
        $peserta->save();

        return ResponseFormatter::success($peserta, 'Peserta berhasil divalidasi');
    }
}
