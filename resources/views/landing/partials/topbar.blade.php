<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav d-flex align-items-center justify-content-between">
          <!-- ***** Logo Start ***** -->
          <a href="{{ route('home') }}" class="logo d-flex align-items-center text-decoration-none">
            @php
              $topbarLogo = asset('landing-page/assets/images/logo.png');
              if(!empty($profile->logo)) {
                if(str_starts_with($profile->logo, 'storage/') || str_starts_with($profile->logo, 'uploads/')) {
                  $topbarLogo = asset($profile->logo);
                } elseif(file_exists(public_path($profile->logo))) {
                  $topbarLogo = asset($profile->logo);
                }
              }
            @endphp
            <img src="{{ $topbarLogo }}" alt="{{ $profile->school_name ?? 'Logo Sekolah' }}" class="topbar-school-logo">
            <span class="topbar-school-name">
              {{ $profile->navbar_name ?? $profile->school_name ?? 'SMKN 1 Indonesia' }}
            </span>
          </a>
          <!-- ***** Logo End ***** -->

          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li class="scroll-to-section">
              <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.profile') }}" class="{{ request()->routeIs('landing.profile') ? 'active' : '' }}">Profil Sekolah</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.news') }}" class="{{ request()->routeIs('landing.news*') ? 'active' : '' }}">Berita</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.extracurriculars') }}" class="{{ request()->routeIs('landing.extracurriculars*') ? 'active' : '' }}">Ekstrakurikuler</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.majors') }}" class="{{ request()->routeIs('landing.majors*') ? 'active' : '' }}">Jurusan</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.gallery') }}" class="{{ request()->routeIs('landing.gallery*') ? 'active' : '' }}">Galeri</a>
            </li>
            <li class="nav-cta">
              <a href="{{ route('admin.dashboard') }}" class="btn-nav-cta"><i class="fa fa-sign-in-alt me-2"></i>Masuk Admin</a>
            </li>
          </ul>
          <!-- ***** Menu End ***** -->

          <a class='menu-trigger' href="javascript:void(0);" role="button" aria-label="Menu">
            <span></span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->