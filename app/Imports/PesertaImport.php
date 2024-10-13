<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class PesertaImport implements ToModel, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Peserta([
            'nama' => $row[0],
            'merchant' => $row[1],
            'titik_kumpul' => $row[2],
            'nomor_bus' => $row[3],
            'kode_peserta' => $row[4],
            // Set default value untuk is_valid menjadi 0 jika tidak di-set di Excel
            'is_valid' => isset($row[5]) ? $row[5] : 0,
        ]);
    }

    // Fungsi untuk validasi sebelum data diimport ke database
    public function rules(): array
    {
        return [
            '0' => 'required|string',                  // Validasi nama harus ada dan berupa string
            '1' => 'required|string',                  // Validasi merchant harus ada dan berupa string
            '2' => 'required|string',                  // Validasi titik kumpul harus ada dan berupa string
            '3' => 'nullable|string',                  // Nomor bus tidak wajib, tapi harus berupa string
            '4' => 'required|unique:pesertas,kode_peserta', // Validasi kode peserta harus unik
        ];
    }
}
