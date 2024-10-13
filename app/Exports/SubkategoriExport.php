<?php

namespace App\Exports;

use App\Models\Subkategori;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubkategoriExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subkategori::all();
    }
}
