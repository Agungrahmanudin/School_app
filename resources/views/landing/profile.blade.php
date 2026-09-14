@extends('landing.layout.app')

@section('title', 'Profil Sekolah - ' . ($profile->school_name ?? 'SMK'))

@section('content')
  <!-- Section Title -->
  <div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Profil <em>Lengkap</em> Sekolah</h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Informasi resmi identitas, visi misi, data statistik, serta tabel informasi profil sekolah.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tentang & Sejarah (about-us) -->
  <div class="about-us section" style="padding-top: 0px; padding-bottom: 60px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="section-heading" style="margin-bottom: 25px;">
            <h4>Sejarah &amp; <em>Visi Misi</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>{{ $profile->history ?? 'Membentuk generasi pembelajar yang berkarakter, berdaya saing global, inovatif, dan berakhlak mulia.' }}</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="box-item" style="padding: 20px 30px; margin-bottom: 20px;">
                <h4><a href="#">Visi Sekolah</a></h4>
                <p>{{ $profile->vision ?? '-' }}</p>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="box-item" style="padding: 20px 30px; margin-bottom: 20px;">
                <h4><a href="#">Misi Sekolah</a></h4>
                <p style="white-space: pre-line;">{{ $profile->mission ?? '-' }}</p>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="box-item" style="padding: 20px 30px;">
                <h4><a href="#">Kepala Sekolah</a></h4>
                <p><strong>{{ $profile->principal_name ?? '-' }}</strong></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image text-center">
            @php
              $profilePhoto = asset('landing-page/assets/images/about-right-dec.png');
              if (!empty($profile->school_photo)) {
                if (str_starts_with($profile->school_photo, 'storage/') || str_starts_with($profile->school_photo, 'uploads/')) {
                  $profilePhoto = asset($profile->school_photo);
                } elseif (file_exists(public_path($profile->school_photo))) {
                  $profilePhoto = asset($profile->school_photo);
                }
              }
            @endphp
            <div class="profile-image-wrap">
              <img src="{{ $profilePhoto }}" alt="Foto Sekolah">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- INFORMASI PROFIL SEKOLAH -->
  <div class="services section" style="padding-top: 20px; padding-bottom: 60px; background: #f8fbff;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading" style="margin-bottom: 40px;">
            <h4>Informasi <em>Profil Sekolah</em></h4>
            <span class="visually-hidden">Tabel Informasi Profil Sekolah</span>
            <span class="visually-hidden">Nomor Pokok Sekolah Nasional</span>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Data resmi identitas satuan pendidikan sesuai standar Dapodik / BNSP.</p>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-7">
          <div class="bg-white p-4 shadow-sm h-100" style="border-radius: 18px; border: 1px solid #e8eef7;">
            <div class="d-flex align-items-center mb-4"><span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white me-3" style="width: 46px; height: 46px;"><i class="fa fa-school"></i></span><div><h5 class="mb-1">Identitas Sekolah</h5><small class="text-muted">Informasi satuan pendidikan</small></div></div>
            <div class="row g-3">
              <div class="col-md-6"><small class="text-muted d-block">Nama Sekolah</small><strong>{{ $profile->school_name ?? '-' }}</strong></div>
              <div class="col-md-6"><small class="text-muted d-block">NPSN</small><strong>{{ $profile->npsn ?? '-' }}</strong></div>
              <div class="col-md-6"><small class="text-muted d-block">Kepala Sekolah</small><strong>{{ $profile->principal_name ?? '-' }}</strong></div>
              <div class="col-md-6"><small class="text-muted d-block">Akreditasi</small><span class="badge bg-success">Akreditasi A (Unggul)</span></div>
              <div class="col-12"><small class="text-muted d-block">Alamat Lengkap</small><strong>{{ $profile->address ?? '-' }}</strong></div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="bg-white p-4 shadow-sm h-100" style="border-radius: 18px; border: 1px solid #e8eef7;">
            <div class="d-flex align-items-center mb-4"><span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning text-white me-3" style="width: 46px; height: 46px;"><i class="fa fa-address-book"></i></span><div><h5 class="mb-1">Kontak Resmi</h5><small class="text-muted">Hubungi sekolah</small></div></div>
            <div class="d-grid gap-3">
              <a href="tel:{{ $profile->phone ?? '' }}" class="text-dark text-decoration-none"><i class="fa fa-phone text-primary me-2"></i>{{ $profile->phone ?? '-' }}</a>
              <a href="mailto:{{ $profile->email ?? '' }}" class="text-dark text-decoration-none text-break"><i class="fa fa-envelope text-primary me-2"></i>{{ $profile->email ?? '-' }}</a>
              <a href="{{ $profile->website ?? '#' }}" target="_blank" class="text-dark text-decoration-none text-break"><i class="fa fa-globe text-primary me-2"></i>{{ $profile->website ?? '-' }}</a>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row g-3">
            <div class="col-md-6"><div class="bg-white p-4 shadow-sm h-100" style="border-radius: 18px; border: 1px solid #e8eef7;"><small class="text-muted d-block mb-2"><i class="fa fa-chalkboard-teacher text-primary me-2"></i>Total Dewan Guru</small><strong class="fs-3 text-primary">{{ $totalTeachers }}</strong><span class="text-muted ms-2">Orang Tenaga Pendidik</span></div></div>
            <div class="col-md-6"><div class="bg-white p-4 shadow-sm h-100" style="border-radius: 18px; border: 1px solid #e8eef7;"><small class="text-muted d-block mb-2"><i class="fa fa-users text-success me-2"></i>Total Siswa Terdaftar</small><strong class="fs-3 text-success">{{ $totalStudents }}</strong><span class="text-muted ms-2">Siswa / Siswi Aktif</span></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Dewan Guru -->
  <div class="services section" style="padding-top: 20px; padding-bottom: 80px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading" style="margin-bottom: 50px;">
            <h4>Dewan Guru &amp; <em>Tenaga Pendidik</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Daftar guru pengajar kompeten yang mendampingi proses belajar mengajar.</p>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($teachers as $t)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-item first-service">
              @php
                $teacherPhoto = asset('assets_admin/assets/images/avatars/avatar-1.png');
                if (!empty($t->photo)) {
                  if (str_starts_with($t->photo, 'storage/') || str_starts_with($t->photo, 'uploads/')) {
                    $teacherPhoto = asset($t->photo);
                  } elseif (file_exists(public_path($t->photo))) {
                    $teacherPhoto = asset($t->photo);
                  }
                }
              @endphp
              <div class="icon" style="background-image: none; width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px;">
                <img src="{{ $teacherPhoto }}" alt="{{ $t->name }}" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <h4>{{ $t->name }}</h4>
              <p><strong>Jabatan:</strong> {{ $t->position }}<br><strong>Mapel:</strong> {{ $t->subject }}<br><small class="text-muted">NIP: {{ $t->nip }}</small></p>
            </div>
          </div>
        @endforeach
  </div>
@endsection

<style>
.profile-image-wrap {
  width: 100%;
  height: 420px;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 15px 40px rgba(0,0,0,0.12);
}
.profile-image-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}
@media (max-width: 991px) {
  .profile-image-wrap { height: 340px; margin-top: 20px; }
}
@media (max-width: 576px) {
  .profile-image-wrap { height: 260px; }
}
</style>