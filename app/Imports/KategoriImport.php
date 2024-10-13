<?php

namespace App\Imports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;


class KategoriImport implements ToModel, WithValidation, WithStartRow
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
        return new Kategori([
            'nama' => $row[0],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
        ];
    }
}
