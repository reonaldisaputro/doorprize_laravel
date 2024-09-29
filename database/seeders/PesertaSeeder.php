<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peserta = [
            [
                'nama' => 'Andi Saputra',
                'email' => 'andi.saputra@example.com',
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
            ],
            [
                'nama' => 'Citra Melinda',
                'email' => 'citra.melinda@example.com',
            ],
            [
                'nama' => 'Dewi Kartika',
                'email' => 'dewi.kartika@example.com',
            ],
            [
                'nama' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
            ],
            [
                'nama' => 'Fajar Nugraha',
                'email' => 'fajar.nugraha@example.com',
            ],
            [
                'nama' => 'Gita Sari',
                'email' => 'gita.sari@example.com',
            ],
            [
                'nama' => 'Hendra Wijaya',
                'email' => 'hendra.wijaya@example.com',
            ],
            [
                'nama' => 'Ika Rahmawati',
                'email' => 'ika.rahmawati@example.com',
            ],
            [
                'nama' => 'Joko Susilo',
                'email' => 'joko.susilo@example.com',
            ],
            [
                'nama' => 'Kirana Dewi',
                'email' => 'kirana.dewi@example.com',
            ],
            [
                'nama' => 'Lina Permata',
                'email' => 'lina.permata@example.com',
            ],
            [
                'nama' => 'Mira Santika',
                'email' => 'mira.santika@example.com',
            ],
            [
                'nama' => 'Nugroho Aditya',
                'email' => 'nugroho.aditya@example.com',
            ],
            [
                'nama' => 'Oki Setiawan',
                'email' => 'oki.setiawan@example.com',
            ],
            [
                'nama' => 'Pandu Rahayu',
                'email' => 'pandu.rahayu@example.com',
            ],
            [
                'nama' => 'Qori Maulana',
                'email' => 'qori.maulana@example.com',
            ],
            [
                'nama' => 'Rani Susanti',
                'email' => 'rani.susanti@example.com',
            ],
            [
                'nama' => 'Sari Ramadhani',
                'email' => 'sari.ramadhani@example.com',
            ],
            [
                'nama' => 'Teguh Suryanto',
                'email' => 'teguh.suryanto@example.com',
            ],
        ];

        foreach ($peserta as $p) {
            Peserta::create($p);
        }
    }
}
