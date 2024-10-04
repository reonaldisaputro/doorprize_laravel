<?php

namespace App\Http\Controllers\API;

use App\Models\Undian;
use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ValidationController extends Controller
{
    public function validatePeserta($pesertaId, Request $request)
    {
        // Cari data undian berdasarkan peserta_id dari tabel undian (history)
        $undian = Undian::where('peserta_id', $pesertaId)->with('peserta')->first();

        // Jika tidak ada undian terkait peserta tersebut (belum pernah diundi)
        if (!$undian) {
            return ResponseFormatter::error(null, 'Peserta belum diundi atau tidak ditemukan', 404);
        }

        // Ambil data peserta yang terkait dengan undian tersebut
        $peserta = $undian->peserta;

        // Jika peserta tidak ditemukan (meskipun seharusnya ada)
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
