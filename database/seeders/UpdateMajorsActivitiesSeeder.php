<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Majors;
use App\Models\Extracurriculars;

class UpdateMajorsActivitiesSeeder extends Seeder
{
    public function run(): void
    {
        // Update Majors concentrations
        $majorsData = [
            'TKJ' => "Teknik Komputer\nJaringan Komputer\nAdministrasi Server",
            'RPL' => "Pemrograman Web\nPemrograman Mobile\nDatabase Management",
            'MM' => "Desain Grafis\nAnimasi\nVideo Editing",
            'TKR' => "Mesin Otomotif\nKelistrikan Otomotif\nChasis Otomotif",
            'AKL' => "Akuntansi Keuangan\nPerpajakan\nAuditing",
            'BDP' => "Administrasi Umum\nAdministrasi Kepegawaian\nAdministrasi Keuangan",
        ];

        foreach ($majorsData as $code => $concentrations) {
            Majors::where('code', $code)->update(['concentrations' => $concentrations]);
        }

        // Update Extracurriculars activities
        Extracurriculars::query()->update([
            'activities' => "Latihan Rutin Mingguan\nKompetisi Tingkat Kabupaten\nTurnamen Antar Sekolah"
        ]);

        echo "✓ Updated majors concentrations and extracurriculars activities\n";
    }
}
