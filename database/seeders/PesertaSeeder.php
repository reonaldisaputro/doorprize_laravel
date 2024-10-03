<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            Peserta::create([
                'nama' => $faker->name,     // Email acak dan unik
                'merchant' => $faker->company,                 // Merchant acak
                'titik_kumpul' => $faker->city,                // Titik kumpul acak (kota)
                'nomor_bus' => 'Bus ' . $faker->numberBetween(1, 10), // Nomor bus acak (Bus 1-10)
                'kode_peserta' => 'PST-' . str_pad($i, 3, '0', STR_PAD_LEFT), // Kode peserta (PST-001, PST-002, dst.)
            ]);
        }
    }
}
