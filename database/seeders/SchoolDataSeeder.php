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
        // 1. Akun Pengguna (Admin)
        $admin = User::firstOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'name' => 'Administrator Sekolah',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Pastikan role admin terisi
        if ($admin->role !== 'admin') {
            $admin->update(['role' => 'admin']);
        }

        // 2. Profil Sekolah
        if (School_profiles::count() === 0) {
            School_profiles::create([
                'school_name' => 'SMKN 1 Talaga',
                'navbar_name' => 'SMKN 1 Talaga',
                'hero_title' => 'Mewujudkan Generasi Vokasi Unggul & Berkarakter',
                'hero_description' => 'Membentuk peserta didik yang religius, terampil, mandiri, dan berdaya saing global melalui pembelajaran kejuruan berbasis industri.',
                'npsn' => '20109988',
                'address' => 'Jl. Jenderal Ahmad Yani No. 12, Talaga, Majalengka, Jawa Barat',
                'phone' => '(0233) 881234',
                'email' => 'info@smkn1talaga.sch.id',
                'website' => 'https://smkn1talaga.sch.id',
                'history' => 'Didirikan dengan dedikasi tinggi untuk memajukan pendidikan kejuruan di wilayah Majalengka dan sekitarnya, SMKN 1 Talaga terus bertransformasi menghasilkan lulusan berkualitas yang terserap di dunia usaha, dunia industri, dan perguruan tinggi terkemuka.',
                'vision' => 'Terwujudnya Peserta Didik yang Religius, Vokasional, Entrepreneurship dan Profesional.',
                'mission' => "1. Menumbuhkan keimanan dan ketakwaan seluruh warga sekolah melalui pembiasaan nilai-nilai religi.\n2. Mengoptimalkan proses pendidikan dan pelatihan vokasi sesuai kebutuhan standar DUDI.\n3. Mengembangkan potensi civitas academica berdasarkan minat, bakat, dan teknologi mutakhir.\n4. Menumbuhkan jiwa technopreneurship dan memperluas kemitraan strategis dengan industri.",
                'principal_name' => 'Drs. H. Bambang Sujatmiko, M.Pd.',
                'logo' => 'landing-page/assets/images/logo.png',
                'school_photo' => 'landing-page/assets/images/slider-dec.png',
                'hero_image' => 'landing-page/assets/images/slider-dec.png',
            ]);
        }

        // 3. Kategori Berita
        $categories = [
            ['name' => 'Prestasi Sekolah', 'slug' => 'prestasi-sekolah'],
            ['name' => 'Kegiatan Sekolah', 'slug' => 'kegiatan-sekolah'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman'],
            ['name' => 'Akademik & Kurikulum', 'slug' => 'akademik-dan-kurikulum'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[$cat['slug']] = Categories::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }

        // 4. Berita & Kegiatan Sekolah
        $newsList = [
            [
                'category_slug' => 'prestasi-sekolah',
                'title' => 'Siswa SMKN 1 Talaga Raih Juara 1 LKS Web Technologies Tingkat Provinsi',
                'slug' => 'siswa-smkn-1-talaga-raih-juara-1-lks-web-technologies-tingkat-provinsi',
                'content' => 'Prestasi membanggakan kembali ditorehkan oleh siswa jurusan Rekayasa Perangkat Lunak SMKN 1 Talaga. Dalam ajang Lomba Kompetensi Siswa (LKS) Tingkat Provinsi Jawa Barat tahun ini, tim sekolah berhasil meraih medali emas pada bidang Web Technologies setelah melalui proses seleksi dan kompetisi yang ketat.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
                'published_at' => now()->subDays(2),
            ],
            [
                'category_slug' => 'kegiatan-sekolah',
                'title' => 'Peringatan Bulan Bahasa dan Gebyar Seni Budaya Nusantara',
                'slug' => 'peringatan-bulan-bahasa-dan-gebyar-seni-budaya-nusantara',
                'content' => 'Seluruh civitas akademika berpartisipasi aktif dalam memeriahkan pagelaran seni tahunan, lomba literasi, cipta baca puisi, serta pertunjukan tari tradisional antarkelas untuk menumbuhkan rasa cinta budaya dan kreativitas siswa.',
                'image' => 'landing-page/assets/images/slider-dec.png',
                'published_at' => now()->subDays(5),
            ],
            [
                'category_slug' => 'akademik-dan-kurikulum',
                'title' => 'Kunjungan Industri & Penandatanganan MoU dengan 10 Mitra Perusahaan',
                'slug' => 'kunjungan-industri-penandatanganan-mou-dengan-10-mitra-perusahaan',
                'content' => 'Memperkuat implementasi program Link and Match antara sekolah kejuruan dan dunia industri, SMKN 1 Talaga resmi menandatangani nota kesepahaman (MoU) untuk penyelarasan kurikulum, magang kerja (PKL), dan rekrutmen lulusan.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
                'published_at' => now()->subDays(8),
            ],
            [
                'category_slug' => 'pengumuman',
                'title' => 'Informasi Jadwal Pelaksanaan Asesmen Sumatif Akhir Semester Genap',
                'slug' => 'informasi-jadwal-pelaksanaan-asesmen-sumatif-akhir-semester-genap',
                'content' => 'Diumumkan kepada seluruh peserta didik kelas X, XI, dan XII bahwa Asesmen Sumatif Akhir Semester akan dilaksanakan mulai pekan depan secara Computer Based Testing (CBT). Harap seluruh siswa mempersiapkan diri dengan baik.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
                'published_at' => now()->subDays(12),
            ],
            [
                'category_slug' => 'prestasi-sekolah',
                'title' => 'Tim Futsal Sekolah Berhasil Membawa Pulang Piala Bergilir Turnamen Antar-SMK',
                'slug' => 'tim-futsal-sekolah-berhasil-membawa-pulang-piala-bergilir-turnamen-antar-smk',
                'content' => 'Melalui pertandingan sengit di partai final, tim futsal SMKN 1 Talaga sukses keluar sebagai kampiun dengan skor 4-2 dan memboyong trofi juara 1 serta gelar pemain terbaik turnamen.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
                'published_at' => now()->subDays(15),
            ],
            [
                'category_slug' => 'kegiatan-sekolah',
                'title' => 'Pelatihan Kewirausahaan & Gelar Karya Produk Kreatif Siswa Vokasi',
                'slug' => 'pelatihan-kewirausahaan-gelar-karya-produk-kreatif-siswa-vokasi',
                'content' => 'Ajang pameran hasil karya inovatif dan produk wirausaha buatan siswa per jurusan, mulai dari produk teknologi perangkat lunak, kerajinan kreatif, hingga olahan kuliner yang diminati masyarakat.',
                'image' => 'landing-page/assets/images/slider-dec.png',
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($newsList as $item) {
            $cat = $categoryModels[$item['category_slug']] ?? null;
            if ($cat) {
                News::firstOrCreate(
                    ['slug' => $item['slug']],
                    [
                        'category_id' => $cat->id,
                        'title' => $item['title'],
                        'content' => $item['content'],
                        'image' => $item['image'],
                        'published_at' => $item['published_at'],
                        'created_by' => $admin->id,
                    ]
                );
            }
        }

        // 5. Tenaga Pendidik (Dewan Guru)
        $teachers = [
            [
                'nip' => '197501102000031001',
                'name' => 'Drs. H. Bambang Sujatmiko, M.Pd.',
                'gender' => 'L',
                'subject' => 'Manajemen Pendidikan',
                'position' => 'Kepala Sekolah',
                'photo' => 'assets_admin/assets/images/avatars/avatar-1.png',
            ],
            [
                'nip' => '198804152012011002',
                'name' => 'Agung Rahmanudin, S.Kom.',
                'gender' => 'L',
                'subject' => 'Rekayasa Perangkat Lunak',
                'position' => 'Kaprog RPL & Waka Kurikulum',
                'photo' => 'assets_admin/assets/images/avatars/avatar-2.png',
            ],
            [
                'nip' => '198607202009021004',
                'name' => 'Budi Santoso, S.T.',
                'gender' => 'L',
                'subject' => 'Teknik Komputer Jaringan',
                'position' => 'Kaprog TKJ',
                'photo' => 'assets_admin/assets/images/avatars/avatar-3.png',
            ],
            [
                'nip' => '199103182015022003',
                'name' => 'Siti Nurhaliza, S.Ds.',
                'gender' => 'P',
                'subject' => 'Desain Komunikasi Visual',
                'position' => 'Kaprog DKV',
                'photo' => 'assets_admin/assets/images/avatars/avatar-4.png',
            ],
            [
                'nip' => '198511252010011006',
                'name' => 'Hendra Gunawan, S.Pd.',
                'gender' => 'L',
                'subject' => 'Teknik Kendaraan Ringan Otomotif',
                'position' => 'Kaprog TKRO',
                'photo' => 'assets_admin/assets/images/avatars/avatar-5.png',
            ],
            [
                'nip' => '197808122003012001',
                'name' => 'Dra. Hj. Ratna Sari, M.Ak.',
                'gender' => 'P',
                'subject' => 'Akuntansi dan Keuangan Lembaga',
                'position' => 'Kaprog AKL',
                'photo' => 'assets_admin/assets/images/avatars/avatar-6.png',
            ],
            [
                'nip' => '198709142011011005',
                'name' => 'Rahmat Hidayat, S.Pd.',
                'gender' => 'L',
                'subject' => 'Pendidikan Jasmani & Olahraga',
                'position' => 'Waka Kesiswaan',
                'photo' => 'assets_admin/assets/images/avatars/avatar-7.png',
            ],
            [
                'nip' => '199205162016022004',
                'name' => 'Dewi Lestari, S.Pd.',
                'gender' => 'P',
                'subject' => 'Bahasa Inggris Komunikatif',
                'position' => 'Guru Pengajar',
                'photo' => 'assets_admin/assets/images/avatars/avatar-8.png',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teachers::firstOrCreate(
                ['nip' => $teacher['nip']],
                $teacher
            );
        }

        // 6. Data Siswa
        $students = [
            [
                'nis' => '20241001',
                'name' => 'Aditya Pratama',
                'gender' => 'L',
                'class' => 'XII RPL 1',
                'major' => 'Rekayasa Perangkat Lunak',
                'photo' => 'assets_admin/assets/images/avatars/avatar-2.png',
            ],
            [
                'nis' => '20241002',
                'name' => 'Anisa Rahmawati',
                'gender' => 'P',
                'class' => 'XII RPL 1',
                'major' => 'Rekayasa Perangkat Lunak',
                'photo' => 'assets_admin/assets/images/avatars/avatar-4.png',
            ],
            [
                'nis' => '20241003',
                'name' => 'Budi Setiawan',
                'gender' => 'L',
                'class' => 'XII TKJ 2',
                'major' => 'Teknik Komputer dan Jaringan',
                'photo' => 'assets_admin/assets/images/avatars/avatar-3.png',
            ],
            [
                'nis' => '20241004',
                'name' => 'Citra Kirana',
                'gender' => 'P',
                'class' => 'XI DKV 1',
                'major' => 'Desain Komunikasi Visual',
                'photo' => 'assets_admin/assets/images/avatars/avatar-6.png',
            ],
            [
                'nis' => '20241005',
                'name' => 'Dimas Anggara',
                'gender' => 'L',
                'class' => 'XI RPL 2',
                'major' => 'Rekayasa Perangkat Lunak',
                'photo' => 'assets_admin/assets/images/avatars/avatar-5.png',
            ],
            [
                'nis' => '20241006',
                'name' => 'Eka Putri Wardani',
                'gender' => 'P',
                'class' => 'X TKJ 1',
                'major' => 'Teknik Komputer dan Jaringan',
                'photo' => 'assets_admin/assets/images/avatars/avatar-8.png',
            ],
            [
                'nis' => '20241007',
                'name' => 'Fajar Maulana',
                'gender' => 'L',
                'class' => 'X TKRO 1',
                'major' => 'Teknik Kendaraan Ringan Otomotif',
                'photo' => 'assets_admin/assets/images/avatars/avatar-7.png',
            ],
            [
                'nis' => '20241008',
                'name' => 'Gita Gutawa',
                'gender' => 'P',
                'class' => 'XII AKL 2',
                'major' => 'Akuntansi dan Keuangan Lembaga',
                'photo' => 'assets_admin/assets/images/avatars/avatar-4.png',
            ],
        ];

        foreach ($students as $student) {
            Students::firstOrCreate(
                ['nis' => $student['nis']],
                $student
            );
        }

        // 7. Ekstrakurikuler
        $extracurriculars = [
            [
                'name' => 'Pramuka (Gudep 05.021)',
                'description' => 'Membentuk karakter disiplin, kemandirian, kecintaan pada alam, serta jiwa kepemimpinan generasi bangsa yang berjiwa Pancasila.',
                'activities' => "Latihan Baris-Berbaris (PBB)\nKemah Bhakti & Survival Alam Bebas\nLomba Tingkat Kwarcab & Nasional",
                'coach' => 'Rahmat Hidayat, S.Pd.',
                'schedule' => 'Jumat, 15:00 - 17:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
            [
                'name' => 'Paskibra (Pasukan Pengibar Bendera)',
                'description' => 'Wadah pembinaan generasi muda dalam kedisiplinan tinggi, ketahanan fisik, mental, dan tata upacara bendera kenegaraan.',
                'activities' => "Pelatihan Formasi Baris Berbaris\nLatihan Disiplin Fisik & Mental\nKompetisi LKBB Tingkat Provinsi",
                'coach' => 'Danang Setiawan, S.Pd.',
                'schedule' => 'Sabtu, 08:00 - 11:00 WIB',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'name' => 'Coding & Robotika Club',
                'description' => 'Mempelajari dan mengembangkan proyek perangkat lunak, sistem cerdas IoT (Internet of Things), serta robotika kompetitif.',
                'activities' => "Bootcamp Web & Mobile Development\nWorkshop Arduino & Sensor IoT\nPersiapan LKS Bidang IT Software",
                'coach' => 'Agung Rahmanudin, S.Kom.',
                'schedule' => 'Sabtu, 09:00 - 12:00 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
            [
                'name' => 'PMR (Palang Merah Remaja)',
                'description' => 'Mendidik relawan muda dalam pertolongan pertama pada kecelakaan (P3K), kesiapsiagaan bencana, dan aksi sosial kemanusiaan.',
                'activities' => "Pelatihan Praktik P3K & Tandu Darurat\nBakti Sosial & Donor Darah Sekolah\nKesiapsiagaan Tanggap Bencana",
                'coach' => 'Dewi Lestari, S.Pd.',
                'schedule' => 'Rabu, 15:30 - 17:00 WIB',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
            ],
            [
                'name' => 'Futsal & Sepak Bola',
                'description' => 'Mengasah bakat ketangkasan fisik, teknik menggiring bola, taktik bertanding, dan sportivitas tinggi dalam tim olahraga.',
                'activities' => "Latihan Fisik & Taktik Pertandingan\nSparing Rutin Antarsekolah\nTurnamen Futsal Cup Tingkat Daerah",
                'coach' => 'Ahmad Fauzi, S.T.',
                'schedule' => 'Selasa & Kamis, 16:00 - 18:00 WIB',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'name' => 'Seni Musik & Band Sekolah',
                'description' => 'Menyalurkan bakat seni musikalitas siswa dalam memainkan instrumen musik akustik, band, vokal, dan aransemen karya lagu.',
                'activities' => "Latihan Harmoni Instrumen Musik\nPenampilan Pensi & Acara Sekolah\nRekaman Lagu Ciptaan Siswa",
                'coach' => 'Siti Nurhaliza, S.Ds.',
                'schedule' => 'Senin, 15:30 - 17:30 WIB',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
        ];

        foreach ($extracurriculars as $extra) {
            Extracurriculars::firstOrCreate(
                ['name' => $extra['name']],
                $extra
            );
        }

        // 8. Galeri Dokumentasi
        $galleries = [
            [
                'title' => 'Upacara Peringatan Hari Kemerdekaan RI ke-81',
                'description' => 'Khidmatnya upacara pengibaran bendera merah putih yang dihadiri oleh seluruh dewan guru, staf tata usaha, dan siswa-siswi.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'title' => 'Praktikum Pemrograman Web di Lab Komputer RPL',
                'description' => 'Suasana pembelajaran interaktif para siswa saat membangun aplikasi website dinamis berbasis framework modern.',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
            [
                'title' => 'Gelar Karya Produk Inovasi Vokasi Siswa',
                'description' => 'Pameran terbuka menampilkan inovasi teknologi, karya desain multimedia, dan prototype otomotif karya peserta didik.',
                'image' => 'landing-page/assets/images/pricing-table-01.png',
            ],
            [
                'title' => 'Latihan Gabungan & Pelantikan Ekstrakurikuler',
                'description' => 'Kegiatan outbond dan latihan kepemimpinan bersama seluruh organisasi kesiswaan dan ekstrakurikuler sekolah.',
                'image' => 'landing-page/assets/images/about-bg.jpg',
            ],
            [
                'title' => 'Kunjungan Industri Siswa ke PT Astra Honda Motor',
                'description' => 'Pengenalan langsung etos kerja industri dan teknologi perakitan otomotif modern kepada para siswa kejuruan.',
                'image' => 'landing-page/assets/images/about-right-dec.png',
            ],
            [
                'title' => 'Donor Darah dan Aksi Sosial Kemanusiaan PMR',
                'description' => 'Kegiatan donor darah sukarela bersama PMI Kabupaten yang melibatkan partisipasi aktif guru, karyawan, dan siswa.',
                'image' => 'landing-page/assets/images/slider-dec.png',
            ],
        ];

        foreach ($galleries as $gal) {
            Galleries::firstOrCreate(
                ['title' => $gal['title']],
                $gal
            );
        }
    }
}
