<?php

namespace App\Http\Controllers\API;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ValidationController extends Controller
{
    public function validatePeserta($id, Request $request)
    {
        // Cari peserta berdasarkan ID
        $peserta = Peserta::find($id);

        // Jika peserta tidak ditemukan
        if (!$peserta) {
            return ResponseFormatter::error(null, 'Peserta tidak ditemukan', 404);
        }

        // Update status validasi peserta
        $peserta->is_valid = $request->is_valid;
        $peserta->save();

        $message = $peserta->is_valid ? 'Peserta berhasil divalidasi' : 'Peserta ditandai sebagai tidak valid';

        // Return response dengan status validasi
        return ResponseFormatter::success($peserta, $message);
    }
}
