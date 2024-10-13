<?php

namespace App\Imports;

use App\Models\Subkategori;
use Maatwebsite\Excel\Concerns\ToModel;

class SubkategoriImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Subkategori([
            'kategori_id' => $row[0],
            'nama' => $row[1],
            'qty' => $row[2],
        ]);
    }
}
