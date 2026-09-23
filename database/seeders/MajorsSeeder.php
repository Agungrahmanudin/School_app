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
                'name' => 'Rekayasa Perangkat Lunak',
                'code' => 'RPL',
                'kaprog' => 'Agung Rahmanudin, S.Kom.',
                'concentrations' => "Pengembangan Web Modern\nPemrograman Aplikasi Mobile (Android & iOS)\nBasis Data & Cloud Computing",
                'description' => 'Program keahlian yang fokus pada kompetensi pembuatan software, website, aplikasi mobile, pengelolaan basis data, dan algoritma pemrograman.',
                'image' => 'uploads/majors/major_1790050514_6ab200d2d8b57.jpg',
            ],
            [
                'name' => 'Teknik Komputer dan Jaringan',
                'code' => 'TKJ',
                'kaprog' => 'Budi Santoso, S.T.',
                'concentrations' => "Administrasi Server & Linux\nInfrastruktur Jaringan & Fiber Optik\nKeamanan Jaringan & Cyber Security",
                'description' => 'Membekali siswa dengan keahlian perakitan komputer, instalasi jaringan LAN/WAN, routing, konfigurasi mikrotik, dan pengelolaan server jaringan.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'name' => 'Desain Komunikasi Visual',
                'code' => 'DKV',
                'kaprog' => 'Siti Nurhaliza, S.Ds.',
                'concentrations' => "Desain Grafis & Branding\nFotografi & Sinematografi\nAnimasi 2D & 3D",
                'description' => 'Mengembangkan kreativitas visual dalam pembuatan desain grafis, media promosi, fotografi komersial, motion graphics, dan produksi konten multimedia.',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
            [
                'name' => 'Teknik Kendaraan Ringan Otomotif',
                'code' => 'TKRO',
                'kaprog' => 'Hendra Gunawan, S.Pd.',
                'concentrations' => "Pemeliharaan Mesin Kendaraan Ringan\nSistem Kelistrikan Otomotif Modern\nChasis & Sistem Pemindah Tenaga",
                'description' => 'Menghasilkan teknisi otomotif andal yang terampil dalam perawatan mesin mobil, sistem kelistrikan EFI, engine management, dan keselamatan berkendara.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'code' => 'AKL',
                'kaprog' => 'Dra. Hj. Ratna Sari, M.Ak.',
                'concentrations' => "Komputer Akuntansi (MYOB & Accurate)\nPerpajakan Badan & Pribadi\nPerbankan Syariah & Lembaga Keuangan",
                'description' => 'Mendidik tenaga ahli akuntansi yang kompeten dalam pencatatan laporan keuangan, audit, analisis transaksi bisnis, dan pengelolaan pajak.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
            ],
            [
                'name' => 'Manajemen Perkantoran & Bisnis',
                'code' => 'MPLB',
                'kaprog' => 'Rina Marlina, S.Pd.',
                'concentrations' => "Otomatisasi Tata Kelola Perkantoran\nKearsipan Digital & Logistik\nKomunikasi Bisnis & Public Relations",
                'description' => 'Membekali keahlian administrasi perkantoran modern, korespondensi bahasa Inggris, pengarsipan berbasis cloud, dan pelayanan prima kepada pelanggan.',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
        ];

        foreach ($majors as $major) {
            Majors::updateOrCreate(
                ['code' => $major['code']],
                $major
            );
        }
    }
}
