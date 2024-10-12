<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSubkategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori100 = Kategori::create(['nama' => 'nominal 100 ribu']);

        Subkategori::create([
            'kategori_id' => $kategori100->id,
            'nama' => 'voucher 100 indomaret',
            'qty' => 15,
        ]);

        Subkategori::create([
            'kategori_id' => $kategori100->id,
            'nama' => 'voucher 100 alfamart',
            'qty' => 2,
        ]);

        // Kategori 200 ribu
        $kategori200 = Kategori::create(['nama' => 'nominal 200 ribu']);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'headset xiaomi',
            'qty' => 2,
        ]);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'charger anker',
            'qty' => 2,
        ]);

        // Kategori 300 ribu
        $kategori300 = Kategori::create(['nama' => 'nominal 300 ribu']);

        Subkategori::create([
            'kategori_id' => $kategori300->id,
            'nama' => 'speaker harman',
            'qty' => 2,
        ]);

        Subkategori::create([
            'kategori_id' => $kategori300->id,
            'nama' => 'headset edifier',
            'qty' => 2,
        ]);
    }
}
