@extends('landing.layout.app')

@section('title', ($profile->school_name ?? 'SMK Negeri 1 Indonesia') . ' - Beranda')

@section('content')
  @php
    $heroImage = asset('landing-page/assets/images/slider-dec.png');
    if (!empty($profile->hero_image)) {
      if (str_starts_with($profile->hero_image, 'storage/') || str_starts_with($profile->hero_image, 'uploads/')) {
        $heroImage = asset($profile->hero_image);
      } elseif (file_exists(public_path($profile->hero_image))) {
        $heroImage = asset($profile->hero_image);
      }
    }
  @endphp
  <!-- ***** Main Banner Start ***** -->
  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>{{ $profile->hero_title ?? $profile->school_name ?? 'SMK Negeri 1 Indonesia Berprestasi' }}</h2>
                    <p>{{ $profile->hero_description ?? $profile->history ?? 'Membentuk generasi unggul, berkarakter, mandiri, dan berdaya saing global melalui pembelajaran terpadu.' }}</p>
                  </div>
                  <div class="col-lg-12">
                    <div class="white-button first-button">
                      <a href="{{ route('landing.profile') }}">Profil Lengkap <i class="fa fa-arrow-right"></i></a>
                    </div>
                    <div class="white-button">
                      <a href="{{ route('landing.news') }}">Berita Kegiatan <i class="fa fa-newspaper"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="hero-image-wrap">
                  <img src="{{ $heroImage }}" alt="{{ $profile->hero_title ?? $profile->school_name ?? 'School Banner' }}">

                  <!-- Kartu kanan atas: rating/pencapaian -->
                  <div class="hero-float-card top-right">
                    <div>
                      <div class="stars">
                        @for($i = 0; $i < 5; $i++)
                          <i class="fa fa-star"></i>
                        @endfor
                      </div>
                      <h6>{{ $profile->achievement_rate ?? '85%+' }} Terserap</h6>
                      <small>{{ $profile->achievement_label ?? 'Kerja & Kuliah' }}</small>
                    </div>
                  </div>

                  <!-- Kartu kiri bawah: status PPDB -->
                  <div class="hero-float-card bottom-left">
                    <div class="hero-float-icon green">
                      <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                      <h6>PPDB Online</h6>
                      <small>{{ $profile->ppdb_status ?? 'Pendaftaran Ditutup' }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Informasi Jumlah Guru dan Siswa (Poin 3) via Template .services ***** -->
  <div id="services" class="services section services-section-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Statistik &amp; <em>Informasi Sekolah</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Data terverifikasi jumlah tenaga pendidik guru, siswa aktif, ekstrakurikuler, dan kegiatan sekolah.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="school-stat-card">
            <div>
              <div class="stat-icon-wrapper stat-icon-blue">
                <i class="fa fa-chalkboard-teacher"></i>
              </div>
              <h3>{{ $totalTeachers }}</h3>
              <h5>Guru Pengajar</h5>
              <p>Tenaga pendidik profesional, berdedikasi dan bersertifikasi di bidangnya.</p>
            </div>
            <div>
              <a href="{{ route('landing.profile') }}" class="btn-stat-link">
                Lihat Profil Guru <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="school-stat-card">
            <div>
              <div class="stat-icon-wrapper stat-icon-green">
                <i class="fa fa-user-graduate"></i>
              </div>
              <h3>{{ $totalStudents }}</h3>
              <h5>Siswa Aktif</h5>
              <p>Peserta didik berprestasi dari berbagai konsentrasi keahlian.</p>
            </div>
            <div>
              <a href="{{ route('landing.profile') }}" class="btn-stat-link">
                Data Kesiswaan <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="school-stat-card">
            <div>
              <div class="stat-icon-wrapper stat-icon-orange">
                <i class="fa fa-trophy"></i>
              </div>
              <h3>{{ $totalExtra }}</h3>
              <h5>Ekstrakurikuler</h5>
              <p>Wadah pengembangan minat, bakat, olahraga, seni dan teknologi.</p>
            </div>
            <div>
              <a href="{{ route('landing.extracurriculars') }}" class="btn-stat-link">
                Pilihan Ekskul <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="school-stat-card">
            <div>
              <div class="stat-icon-wrapper stat-icon-purple">
                <i class="fa fa-images"></i>
              </div>
              <h3>{{ $totalGalleries }}</h3>
              <h5>Dokumentasi</h5>
              <p>Dokumentasi momen berharga dan prestasi aktivitas civitas sekolah.</p>
            </div>
            <div>
              <a href="{{ route('landing.gallery') }}" class="btn-stat-link">
                Buka Galeri Foto <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Seksi Sambutan Kepala Sekolah, Visi & Misi (Referensi: SMKN 1 Talaga) ***** -->
  <div id="about" class="about-us section" style="padding-top: 80px; padding-bottom: 80px; background: #f8f9fa !important;">
    <div class="container">
      <!-- Section Title -->
      <div class="row mb-4">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="section-heading">
            <h4>Sambutan &amp; <em>Visi Misi</em> Sekolah</h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Membentuk generasi unggul berlandaskan nilai religi, kecakapan vokasi, entrepreneurship, dan profesionalisme.</p>
          </div>
        </div>
      </div>

      <!-- Sambutan Kepala Sekolah Card -->
      <div class="row mb-5">
        <div class="col-lg-12">
          <div class="speech-box">
            <div class="row align-items-center">
              <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="speech-title">
                  <i class="fa fa-quote-left text-primary me-2"></i> Sambutan Kepala Sekolah
                </div>
                <div class="speech-content">
                  "Selamat datang di website resmi {{ $profile->school_name ?? '' }}. Lembaga pendidikan kejuruan kami berkomitmen membekali peserta didik dengan karakter yang kuat, kompetensi vokasional yang relevan dengan kebutuhan dunia usaha dan dunia industri (DUDI), serta jiwa kewirausahaan yang tangguh. Melalui sinergi bersama para pendidik, tenaga kependidikan, orang tua, dan mitra industri, kami optimis mengantarkan siswa-siswi meraih masa depan gemilang."
                </div>
                <div class="principal-badge">
                  @php
                    $principalAvatar = asset('assets_admin/assets/images/avatars/avatar-1.png');
                    $principalName = $profile->principal_name ?? 'Muchamad Eki S.A., S.Kom.';
                    
                    // Gunakan data dari tabel teachers jika ada
                    if(isset($principal) && $principal) {
                      if (!empty($principal->photo)) {
                        if (str_starts_with($principal->photo, 'storage/') || str_starts_with($principal->photo, 'uploads/')) {
                          $principalAvatar = asset($principal->photo);
                        } elseif (file_exists(public_path($principal->photo))) {
                          $principalAvatar = asset($principal->photo);
                        }
                      }
                      $principalName = $principal->name;
                    }
                  @endphp
                  <img src="{{ $principalAvatar }}" alt="Kepala Sekolah">
                  <div>
                    <h6>{{ $principalName }}</h6>
                    <small>Kepala Sekolah {{ $profile->school_name ?? 'SMKN 1 Talaga' }}</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 text-center school-profile-photo-wrap">
                @php
                  $photoSekolah = asset('landing-page/assets/images/about-right-dec.png');
                  if(!empty($profile->school_photo) && file_exists(public_path($profile->school_photo))) {
                    $photoSekolah = asset($profile->school_photo);
                  }
                @endphp
                <img src="{{ $photoSekolah }}" alt="Foto Sekolah" class="img-fluid rounded-4 shadow-sm school-profile-photo">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Visi & Misi Cards side by side -->
      <div class="row">
        <!-- Visi -->
        <div class="col-lg-5 mb-4">
          <div class="vm-container">
            <div class="vm-header">
              <div class="vm-icon">
                <i class="fa fa-compass"></i>
              </div>
              <div>
                <h5>Visi Sekolah</h5>
                <small class="text-muted">Arah &amp; Cita-cita Utama</small>
              </div>
            </div>
            <div class="vm-body">
              <div class="p-3 bg-light rounded-3 border-start border-4 border-secondary mb-3">
                <em class="fw-bold text-dark vision-quote-text">
                  "{{ $profile->vision ?? 'Terwujudnya Peserta Didik yang Religius, Vokasional, Entrepreneurship dan Profesional.' }}"
                </em>
              </div>
            </div>
          </div>
        </div>

        <!-- Misi -->
        <div class="col-lg-7 mb-4">
          <div class="vm-container">
            <div class="vm-header">
              <div class="vm-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <i class="fa fa-bullseye"></i>
              </div>
              <div>
                <h5>Misi Sekolah</h5>
                <small class="text-muted">Langkah Nyata Pencapaian Visi</small>
              </div>
            </div>
            <div class="vm-body">
              @php
                $missions = [];
                if(!empty($profile->mission)) {
                  $missions = array_filter(array_map('trim', explode("\n", $profile->mission)));
                }
              @endphp

              @if(count($missions) > 0)
                <ul class="vm-list">
                  @foreach($missions as $misi)
                    @php
                      // Strip number prefix if present like "1. " or "1) "
                      $cleanMisi = preg_replace('/^[0-9]+[\.\)]\s*/', '', $misi);
                    @endphp
                    <li>{{ $cleanMisi }}</li>
                  @endforeach
                </ul>
              @else
                <ul class="vm-list">
                  <li>Menumbuhkan keimanan dan ketakwaan seluruh warga sekolah melalui pembiasaan beribadah.</li>
                  <li>Mengoptimalkan proses pendidikan dan pelatihan vokasi sesuai kebutuhan DUDI.</li>
                  <li>Mengembangkan kompetensi civitas academica berdasarkan potensi, minat, dan bakat.</li>
                  <li>Menumbuhkan jiwa entrepreneurship dan memperluas kemitraan strategis.</li>
                </ul>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Badges: NPSN, Akreditasi, Info Button -->
      <div class="row mt-3">
        <div class="col-12 text-center">
          <div class="d-inline-flex flex-wrap gap-3 align-items-center justify-content-center p-2 px-4 bg-white rounded-pill shadow-sm border">
            <span class="text-dark fw-bold"><i class="fa fa-id-card text-primary me-1"></i> NPSN: {{ $profile->npsn ?? '20109988' }}</span>
            <span class="text-muted">|</span>
            <span class="text-dark fw-bold"><i class="fa fa-certificate text-warning me-1"></i> Akreditasi: Terakreditasi A</span>
            <span class="text-muted">|</span>
            <a href="{{ route('landing.profile') }}" class="text-primary fw-bold text-decoration-none">
              Selengkapnya di Profil Sekolah <i class="fa fa-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ***** Program Keahlian / Jurusan ***** -->
  <div class="services section section-odd-white" style="padding-top: 80px; padding-bottom: 80px; background: #ffffff;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center mb-5">
            <h4>Program <em>Keahlian</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Kelompok Program Keahlian unggulan dengan kompetensi yang dikembangkan terarah.</p>
          </div>
        </div>
      </div>
      
      <div class="row justify-content-center">
        @forelse($majors as $index => $major)
          @php
            $majorImage = null;
            if (!empty($major->image)) {
              if (str_starts_with($major->image, 'storage/') || str_starts_with($major->image, 'uploads/')) {
                $majorImage = asset($major->image);
              } elseif (file_exists(public_path($major->image))) {
                $majorImage = asset($major->image);
              }
            }
          @endphp
          <div class="col-lg-4 col-md-6 mb-4">
            <a href="{{ route('landing.majors.detail', $major->id) }}" class="text-decoration-none">
            <div class="major-card">
              @if($majorImage)
                <div class="major-icon" style="background: transparent; padding: 0;">
                  <img src="{{ $majorImage }}" alt="{{ $major->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
              @else
                <div class="major-icon">
                  <i class="fa fa-graduation-cap"></i>
                </div>
              @endif
              <h5 class="major-title">{{ $major->name }} ({{ $major->code }})</h5>
              <p class="major-desc">{{ Str::limit($major->description ?? 'Kelompok Program Keahlian unggulan dengan kompetensi yang dikembangkan terarah.', 100) }}</p>
              @if(!empty($major->kaprog))
                <div class="major-kaprog mb-3 py-1 px-3 rounded-pill text-center d-inline-block" style="background: rgba(13, 110, 253, 0.08); font-size: 13px; color: #0d6efd; font-weight: 600;">
                  <i class="fa fa-user-tie me-1"></i> Kaprog: {{ $major->kaprog }}
                </div>
              @endif
              @if(!empty($major->concentrations))
                @php
                  $concentrations = array_filter(array_map('trim', explode("\n", $major->concentrations)));
                @endphp
                @if(count($concentrations) > 0)
                  <div class="major-concentration">
                    <p class="concentration-label">KONSENTRASI KEAHLIAN:</p>
                    <ul class="concentration-list">
                      @foreach($concentrations as $concentration)
                        <li>{{ $concentration }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              @endif
            </div>
            </a>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada data jurusan yang tersedia.</p>
          </div>
        @endforelse
      </div>

      <div class="row mt-4">
        <div class="col-12 text-center">
          <div class="white-button">
            <a href="{{ route('landing.majors') }}" style="background: #4b8ef1; color: #fff !important; padding: 12px 35px !important; border-radius: 25px; box-shadow: 0 4px 15px rgba(75,142,241,0.3);">
              Lihat Semua Jurusan <i class="fa fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Ekstrakurikuler ***** -->
  <div class="services section section-even-gray" style="padding-top: 80px; padding-bottom: 80px; background: #f8f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center mb-4" style="margin-bottom: 35px !important;">
            <h4>Kegiatan <em>Ekstrakurikuler</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Wadah pengembangan minat, bakat, dan soft skills melalui berbagai kegiatan di luar pembelajaran formal.</p>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        @forelse($extracurriculars as $index => $extra)
          @php
            $extraImage = asset('landing-page/assets/images/about-right-dec.png');
            if (!empty($extra->image)) {
              if (str_starts_with($extra->image, 'storage/') || str_starts_with($extra->image, 'uploads/')) {
                $extraImage = asset($extra->image);
              } elseif (file_exists(public_path($extra->image))) {
                $extraImage = asset($extra->image);
              }
            }
          @endphp
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="school-news-card h-100">
              <div class="news-img-box">
                <img src="{{ $extraImage }}" alt="{{ $extra->name }}">
                <span class="news-badge"><i class="fa fa-running me-1"></i> Ekskul</span>
              </div>
              <div class="news-body">
                <div class="news-date">
                  <i class="fa fa-clock text-primary me-1"></i>
                  <span>{{ $extra->schedule ?? 'Kegiatan Rutin' }}</span>
                </div>
                <h4 class="news-title">
                  <a href="{{ route('landing.extracurriculars.detail', $extra->id) }}">{{ Str::limit($extra->name, 45) }}</a>
                </h4>
                <p class="news-excerpt">
                  {{ Str::limit($extra->description ?? 'Wadah pengembangan potensi, minat, dan bakat siswa di sekolah.', 90) }}
                </p>
                <div class="news-footer mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                  @if(!empty($extra->coach))
                    <small class="text-muted"><i class="fa fa-user-tie text-primary me-1"></i> {{ Str::limit($extra->coach, 18) }}</small>
                  @else
                    <small class="text-muted"><i class="fa fa-check-circle text-success me-1"></i> Aktif</small>
                  @endif
                  <a href="{{ route('landing.extracurriculars.detail', $extra->id) }}" class="btn-stat-link">
                    Detail Ekskul <i class="fa fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada data ekstrakurikuler yang tersedia.</p>
          </div>
        @endforelse
      </div>

      <div class="row mt-4">
        <div class="col-12 text-center">
          <div class="white-button">
            <a href="{{ route('landing.extracurriculars') }}" style="background: #4b8ef1; color: #fff !important; padding: 12px 35px !important; border-radius: 25px; box-shadow: 0 4px 15px rgba(75,142,241,0.3);">
              Lihat Semua Ekstrakurikuler <i class="fa fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Berita Kegiatan Sekolah via Modern Cards ***** -->
  <div id="pricing" class="pricing-tables section-odd-white" style="padding-top: 80px; padding-bottom: 80px; background: #ffffff !important;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center mb-5">
            <h4>Berita &amp; <em>Kegiatan Sekolah</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Ikuti rangkaian kabar terbaru seputar kegiatan, agenda edukasi, dan prestasi peserta didik kami.</p>
          </div>
        </div>
      </div>
      
      <div class="row">
        @forelse($news as $item)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="school-news-card">
              <div class="news-img-box">
                @php
                  $newsImage = asset('landing-page/assets/images/pricing-table-01.png');
                  if (!empty($item->image)) {
                    if (str_starts_with($item->image, 'storage/') || str_starts_with($item->image, 'uploads/')) {
                      $newsImage = asset($item->image);
                    } elseif (file_exists(public_path($item->image))) {
                      $newsImage = asset($item->image);
                    }
                  }
                @endphp
                <img src="{{ $newsImage }}" alt="{{ $item->title }}">
                <span class="news-badge"><i class="fa fa-tag me-1"></i> {{ $item->category->name ?? 'Berita' }}</span>
              </div>
              <div class="news-body">
                <div class="news-date">
                  <i class="fa fa-calendar-alt text-primary"></i>
                  {{ $item->created_at ? $item->created_at->format('d M Y') : 'Terbaru' }}
                </div>
                <h4 class="news-title">
                  <a href="{{ route('landing.news.detail', $item->slug) }}">{{ Str::limit($item->title, 50) }}</a>
                </h4>
                <p class="news-excerpt">
                  {{ Str::limit(strip_tags($item->content), 90) }}
                </p>
                <div class="news-footer mt-auto">
                  <a href="{{ route('landing.news.detail', $item->slug) }}" class="btn-stat-link">
                    Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada berita kegiatan saat ini.</p>
          </div>
        @endforelse
      </div>

      <div class="row mt-4">
        <div class="col-12 text-center">
          <div class="white-button">
            <a href="{{ route('landing.news') }}" style="background: #4b8ef1; color: #fff !important; padding: 12px 35px !important; border-radius: 25px; box-shadow: 0 4px 15px rgba(75,142,241,0.3);">
              Lihat Semua Berita <i class="fa fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- ***** Galeri Terbaru ***** -->
  <div class="services section section-even-gray" style="padding-top: 80px; padding-bottom: 80px; background: #f8f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center mb-5">
            <h4>Galeri <em>Terbaru</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Dokumentasi terbaru kegiatan dan momen berharga di sekolah.</p>
          </div>
        </div>
      </div>

      <div class="row">
        @forelse($galleries as $gallery)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="school-news-card h-100">
              <div class="news-img-box">
                @php
                  $galleryImage = asset('landing-page/assets/images/about-right-dec.png');
                  if (!empty($gallery->image)) {
                    if (str_starts_with($gallery->image, 'storage/') || str_starts_with($gallery->image, 'uploads/')) {
                      $galleryImage = asset($gallery->image);
                    } elseif (file_exists(public_path($gallery->image))) {
                      $galleryImage = asset($gallery->image);
                    }
                  }
                @endphp
                <img src="{{ $galleryImage }}" alt="{{ $gallery->title }}">
              </div>
              <div class="news-body">
                <div class="news-date">
                  <i class="fa fa-calendar-alt text-primary"></i>
                  <span>{{ $gallery->created_at ? $gallery->created_at->format('d M Y') : 'Dokumentasi' }}</span>
                </div>
                <h5 class="news-title">
                  <a href="{{ route('landing.gallery.show', $gallery->id) }}">
                    {{ Str::limit($gallery->title, 50) }}
                  </a>
                </h5>
                <p class="news-excerpt">{{ Str::limit($gallery->description, 90) }}</p>
                <div class="news-footer mt-auto">
                  <a href="{{ route('landing.gallery.show', $gallery->id) }}" class="btn-stat-link">
                    Lihat Detail <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5"><p class="text-muted">Belum ada galeri terbaru.</p></div>
        @endforelse
      </div>

      <div class="row mt-4">
        <div class="col-12 text-center">
          <div class="white-button"><a href="{{ route('landing.gallery') }}" style="background: #4b8ef1; color: #fff !important; padding: 12px 35px !important; border-radius: 25px; box-shadow: 0 4px 15px rgba(75,142,241,0.3);">Lihat Semua Galeri <i class="fa fa-arrow-right ms-2"></i></a></div>
        </div>
      </div>
    </div>
  </div>
@endsection