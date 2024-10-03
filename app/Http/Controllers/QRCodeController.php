<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    // Fungsi untuk men-generate QR Code
    public function generateQRCode($kodePeserta)
    {
        // Cari peserta berdasarkan kode peserta
        $peserta = Peserta::where('kode_peserta', $kodePeserta)->first();

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        // Menghasilkan QR Code dengan data kode peserta
        $qrCode = QrCode::size(300)->generate($peserta->kode_peserta);

        // Mengembalikan QR Code ke view
        return view('qrcode.show', compact('qrCode', 'peserta'));
    }
}
