<?php

namespace Database\Seeders;

use App\Models\Majors;
use Illuminate\Database\Seeder;

class MajorsSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            [
                'name' => 'Teknik Komputer dan Jaringan',
                'code' => 'TKJ',
                'description' => 'Program keahlian yang mempelajari cara merakit komputer, menginstal sistem operasi, menginstal aplikasi, dan belajar jaringan dasar.',
            ],
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'code' => 'RPL',
                'description' => 'Program keahlian yang mempelajari pemrograman komputer, pengembangan aplikasi, database, dan rekayasa perangkat lunak.',
            ],
            [
                'name' => 'Multimedia',
                'code' => 'MM',
                'description' => 'Program keahlian yang mempelajari desain grafis, animasi, video editing, dan produksi multimedia.',
            ],
            [
                'name' => 'Teknik Kendaraan Ringan',
                'code' => 'TKR',
                'description' => 'Program keahlian yang mempelajari perawatan dan perbaikan kendaraan bermotor roda empat.',
            ],
            [
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'code' => 'AKL',
                'description' => 'Program keahlian yang mempelajari akuntansi, perpajakan, dan administrasi keuangan.',
            ],
            [
                'name' => 'Bisnis Daring dan Pemasaran',
                'code' => 'BDP',
                'description' => 'Program keahlian yang mempelajari pemasaran online, e-commerce, dan strategi bisnis digital.',
            ],
        ];

        foreach ($majors as $major) {
            Majors::create($major);
        }
    }
}
