<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PesertaImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        // Cek apakah ada peserta dengan kode_peserta yang sama (termasuk yang soft deleted)
        $existingPeserta = Peserta::withTrashed()->where('kode_peserta', $row[4])->first();

        if ($existingPeserta) {
            if ($existingPeserta->trashed()) {
                // Jika data sudah soft deleted, restore record-nya
                $existingPeserta->restore();

                // Update data yang di-restore
                $existingPeserta->update([
                    'nama' => $row[0],
                    'merchant' => $row[1],
                    'titik_kumpul' => $row[2],
                    'nomor_bus' => $row[3],
                    'is_valid' => isset($row[5]) ? $row[5] : 0,
                ]);

                return $existingPeserta;
            } else {
                // Jika data sudah ada dan tidak soft deleted, skip (atau Anda bisa memilih untuk update)
                return null;
            }
        }

        // Jika data belum ada, buat peserta baru
        return new Peserta([
            'nama' => $row[0],
            'merchant' => $row[1],
            'titik_kumpul' => $row[2],
            'nomor_bus' => $row[3],
            'kode_peserta' => $row[4],
            'is_valid' => isset($row[5]) ? $row[5] : 0,
        ]);
    }

    // Fungsi untuk validasi sebelum data diimport ke database
    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => [
                'required',
                Rule::unique('pesertas', 'kode_peserta')->whereNull('deleted_at'), // Abaikan yang sudah dihapus
            ],
        ];
    }
}
