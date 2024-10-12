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
            'is_valid' => $row[5],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string', // Validasi nama
            '1' => 'required|email',  // Validasi email
            '5' => 'required|unique:pesertas,kode_peserta', // Validasi kode peserta unik
        ];
    }
}
