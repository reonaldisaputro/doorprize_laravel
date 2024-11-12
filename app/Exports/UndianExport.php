<?php

namespace App\Exports;

use App\Models\Undian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class UndianExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Undian::with(['subkategori', 'peserta'])
            ->get()
            ->map(function ($undian) {
                return [
                    'ID' => $undian->id,
                    'Subkategori' => $undian->subkategori->nama,  // Mengambil nama subkategori
                    'Peserta' => $undian->peserta->nama,  // Mengambil nama peserta
                    'Merchant' => $undian->peserta->merchant,  // Mengambil merchant dari peserta
                    'Kode Peserta' => $undian->peserta->kode_peserta,  // Mengambil kode peserta
                    'Status Valid' => $undian->peserta->is_valid ? 'Valid' : 'Tidak Valid',  // Status validasi peserta
                    'Tanggal Undian' => $undian->created_at->format('Y-m-d H:i:s'),  // Tanggal undian
                ];
            });
    }

    /**
     * Menentukan heading untuk data
     */
    public function headings(): array
    {
        return [
            'ID',
            'Subkategori',
            'Peserta',
            'Merchant',
            'Kode Peserta',
            'Status Valid',  // Tambahkan heading untuk is_valid
            'Tanggal Undian'
        ];
    }

    /**
     * Menentukan sel awal data (misalnya mulai dari sel A4)
     */
    public function startCell(): string
    {
        return 'A4'; // Data akan dimulai dari sel A4
    }

    /**
     * Menambahkan heading atau informasi di atas data
     */
    public function styles(Worksheet $sheet)
    {
        // Dapatkan waktu saat ini dengan zona waktu Asia/Jakarta (WIB)
        $currentDateTimeWIB = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        // Menambahkan teks heading di atas data
        $sheet->setCellValue('A1', 'Laporan Undian');
        $sheet->setCellValue('A2', 'Tanggal Export (WIB): ' . $currentDateTimeWIB);

        // Memberikan gaya untuk heading
        return [
            // Gaya untuk heading utama
            1    => ['font' => ['bold' => true, 'size' => 16]], // Baris 1
            2    => ['font' => ['italic' => true, 'size' => 12]], // Baris 2 (Tanggal WIB)
            4    => ['font' => ['bold' => true]], // Baris heading tabel
        ];
    }
}
