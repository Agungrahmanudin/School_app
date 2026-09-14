<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Extracurriculars;
use App\Models\Galleries;
use App\Models\News;
use App\Models\School_profiles;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'name' => 'Administrator Sekolah',
                'password' => Hash::make('admin123'),
            ]
        );

        if (School_profiles::count() === 0) {
            School_profiles::create([
                'school_name' => 'SMK Negeri 1 Indonesia Berprestasi',
                'npsn' => '20109988',
                'address' => 'Jl. Pendidikan No. 45, Kebayoran Baru, Jakarta Selatan',
                'phone' => '(021) 7890-1234',
                'email' => 'info@smkn1indonesia.sch.id',
                'website' => 'https://smkn1indonesia.sch.id',
                'history' => 'Didirikan pada tahun 1985, SMK Negeri 1 Indonesia Berprestasi terus berkomitmen mencetak generasi unggul, berkarakter, dan siap bersaing pada industri global.',
                'vision' => 'Menjadi institusi pendidikan kejuruan rujukan bergengsi, unggul dalam teknologi, berkarakter mulia, dan berjiwa wirausaha.',
                'mission' => "1. Menyelenggarakan pembelajaran berbasis industri dan teknologi terkini.\n2. Menumbuhkan nilai-nilai integritas dan disiplin.\n3. Membangun kemitraan erat dengan dunia usaha dan industri.\n4. Mengembangkan potensi siswa dalam inovasi teknopreneurship.",
                'principal_name' => 'Drs. H. Bambang Sujatmiko, M.Pd.',
                'logo' => 'landing-page/assets/images/logo.png',
                'school_photo' => 'landing-page/assets/images/slider-dec.png',
            ]);
        }

        $cat1 = Categories::firstOrCreate(
            ['name' => 'Prestasi Sekolah'],
            ['slug' => 'prestasi-sekolah']
        );
        $cat2 = Categories::firstOrCreate(
            ['name' => 'Kegiatan Sekolah'],
            ['slug' => 'kegiatan-sekolah']
        );
        $cat3 = Categories::firstOrCreate(
            ['name' => 'Pengumuman'],
            ['slug' => 'pengumuman']
        );

        if (News::count() === 0) {
            News::create([
                'category_id' => $cat1->id,
                'title' => 'Siswa Juara 1 Lomba Web Technologies Tingkat Nasional',
                'slug' => Str::slug('Siswa Juara 1 Lomba Web Technologies Tingkat Nasional'),
                'content' => 'Tim siswa kejuruan Rekayasa Perangkat Lunak berhasil meraih medali emas pada ajang LKS Nasional bidang Web Technologies tahun inid',
                'image' => 'landing-page/assets/images/about-right-dec.png',
                'published_at' => now()->subDays(2),
                'created_by' => $admin->id,
            ]);
            News::create([
                'category_id' => $cat2->id,
                'title' => 'Peringatan Bulan Bahasa dan Gebyar Seni Budaya 2026',
                'slug' => Str::slug('Peringatan Bulan Bahasa dan Gebyar Seni Budaya 2026'),
                'content' => 'Seluruh civitas akademika berpartisipasi aktif dalam memeriahkan pagelaran seni tahunan, lomba literasi, puisi, serta pertunjukan tari tradisional.',
                'image' => 'landing-page/assets/images/slider-dec.png',
                'published_at' => now()->subDays(5),
                'created_by' => $admin->id,
            ]);
            News::create([
                'category_id' => $cat2->id,
                'title' => 'Kunjungan Industri & Kerja Sama MoU dengan Dunia Usaha Industri',
               'slug' => Str::slug('Kunjungan Industri dan Kerja Sama MoU'),
               'content' => 'Memperkuat program link and match antara kurikulum kejuruan dengan standar kebutuhan industri modern agar lulusan langsung siap kerja.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
                'published_at' => now()->subDays(9),
                'created_by' => $admin->id,
            ]);
        }

        if (Teachers::count() === 0) {
            Teachers::create(['nip' => '197501102000031001', 'name' => 'Drs. H. Bambang Sujatmiko, M.Pd.', 'gender' => 'L', 'subject' => 'Manajemen Pendidikan', 'position' => 'Kepala Sekolah', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Teachers::create(['nip' => '198203152005012003', 'name' => 'Siti Aminah, S.Kom., M.T.', 'gender' => 'P', 'subject' => 'Rekayasa Perangkat Lunak', 'position' => 'Waka Kurikulum', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Teachers::create(['nip' => '198607202009021004', 'name' => 'Rahmat Hidayat, S.Pd.', 'gender' => 'L', 'subject' => 'Teknik Komputer Jaringan', 'position' => 'Waka Kesiswaan', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Teachers::create(['nip' => '199011052014032002', 'name' => 'Dewi Lestari, S.Pd.', 'gender' => 'P', 'subject' => 'Bahasa Inggris Komunikatif', 'position' => 'Guru Pengajar', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Teachers::create(['nip' => '198812122012011005', 'name' => 'Ahmad Fauzi, S.T.', 'gender' => 'L', 'subject' => 'Multimedia & Desain Grafis', 'position' => 'Kepala Bengkel', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Teachers::create(['nip' => '199204182016022001', 'name' => 'Nurul Aini, M.Pd.', 'gender' => 'P', 'subject' => 'Matematika Terapan', 'position' => 'Guru Pengajar', 'photo' => 'landing-page/assets/images/client-image.jpg']);
        }

        if (Students::count() === 0) {
            Students::create(['nis' => '20241001', 'name' => 'Aditya Pratama', 'gender' => 'L', 'class' => 'XII RPL 1', 'major' => 'Rekayasa Perangkat Lunak', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241002', 'name' => 'Anisa Rahmawati', 'gender' => 'P', 'class' => 'XII RPL 1', 'major' => 'Rekayasa Perangkat Lunak', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241003', 'name' => 'Budi Santoso', 'gender' => 'L', 'class' => 'XII TKJ 2', 'major' => 'Teknik Komputer Jaringan', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241004', 'name' => 'Citra Kirana', 'gender' => 'P', 'class' => 'XI MM 1', 'major' => 'Multimedia', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241005', 'name' => 'Dimas Anggara', 'gender' => 'L', 'class' => 'XI RPL 2', 'major' => 'Rekayasa Perangkat Lunak', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241006', 'name' => 'Eka Putri Wardani', 'gender' => 'P', 'class' => 'X TKJ 1', 'major' => 'Teknik Komputer Jaringan', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241007', 'name' => 'Fajar Maulana', 'gender' => 'L', 'class' => 'X DKV 1', 'major' => 'Desain Komunikasi Visual', 'photo' => 'landing-page/assets/images/client-image.jpg']);
            Students::create(['nis' => '20241008', 'name' => 'Gita Gutawa', 'gender' => 'P', 'class' => 'XII MM 2', 'major' => 'Multimedia', 'photo' => 'landing-page/assets/images/client-image.jpg']);
        }

        if (Extracurriculars::count() === 0) {
            Extracurriculars::create([
                'name' => 'Pramuka (Praja Muda Karana)',
                'description' => 'Membentuk kemandirian, kedisiplinan, kecintaan alam, dan jiwa kepemimpinan generasi tangguh.',
                'coach' => 'Rahmat Hidayat, S.Pd.',
                'schedule' => 'Jumat, 15:00 - 17:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
            Extracurriculars::create([
                'name' => 'Coding & Robotika Club',
                'description' => 'Mempelajari pengembangan aplikasi website, IoT, kecerdasan buatan, dan robotika kompetitif.',
                'coach' => 'Siti Aminah, M.T.',
                'schedule' => 'Sabtu, 09:00 - 12:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
            Extracurriculars::create([
                'name' => 'PMR (Palang Merah Remaja)',
                'description' => 'Pelatihan pertolongan pertama pada kecelakaan (P3K), kesiapsiagaan bencana, dan aksi sosial.',
                'coach' => 'Nurul Aini, M.Pd.',
                'schedule' => 'Rabu, 15:30 - 17:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
            Extracurriculars::create([
                'name' => 'Futsal & Bola Basket',
                'description' => 'Mengasah ketangkasan fisik, stamina, strategi pertandingan olahraga, dan kekompakan tim.',
                'coach' => 'Coach Danang Setiawan',
                'schedule' => 'Selasa & Kamis, 16:00 - 18:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
            Extracurriculars::create([
                'name' => 'Seni Musik & Tari Tradisional',
                'description' => 'Mengembangkan bakat musikalitas band sekolah, vokal, dan kreasi tari tradisional nusantara.',
                'coach' => 'Dewi Lestari, S.Pd.',
                'schedule' => 'Senin, 15:30 - 17:30 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
        }

        if (Galleries::count() === 0) {
            Galleries::create([
                'title' => 'Upacara Peringatan Hari Kemerdekaan',
                'description' => 'Khidmatnya upacara bendera yang dihadiri dewan guru, staf, dan seluruh siswa siswi.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ]);
            Galleries::create([
                'title' => 'Praktikum Pemrograman di Lab Komputer',
                'description' => 'Aktivitas pembelajaran interaktif pembuatan aplikasi sistem web terkini.',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ]);
            Galleries::create([
                'title' => 'Gelar Karya & Inovasi Teknologi Siswa',
                'description' => 'Pameran hasil karya inovatif siswa kepada mitra industri dan wali murid.',
                'image' => 'landing-page/assets/images/heading-line-dec.png',
            ]);
            Galleries::create([
                'title' => 'Latihan Gabungan Ekstrakurikuler',
                'description' => 'Kegiatan latihan bersama meningkatkan kebersamaan dan sportivitas antar anggota.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
            ]);
        }
    }
}
