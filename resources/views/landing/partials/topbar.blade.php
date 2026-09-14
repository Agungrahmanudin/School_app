<style>
.header-area {
  background: #fff;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.header-area .main-nav {
  display: flex;
  align-items: center;
  padding: 15px 0;
  gap: 30px;
}
.header-area .main-nav .logo {
  flex-shrink: 0;
}
.header-area .main-nav .logo img {
  max-height: 50px;
}
.header-area .main-nav .nav {
  display: flex;
  align-items: center;
  justify-content: flex-start !important;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 5px;
  flex: 1;
}
.header-area .main-nav .nav li {
  display: flex !important;
  align-items: center !important;
  margin: 0;
  padding: 0;
}
.header-area .main-nav .nav li a,
.header-area .main-nav .nav li.scroll-to-section a,
.header-area .main-nav ul.nav li a {
  display: flex !important;
  align-items: center !important;
  padding: 5px 18px !important;
  font-size: 15px !important;
  font-weight: 500 !important;
  color: #2a2a2a !important;
  text-decoration: none !important;
  border-radius: 6px !important;
  transition: all 0.2s !important;
  white-space: nowrap !important;
  background: transparent !important;
  position: relative !important;
  opacity: 1 !important;
  visibility: visible !important;
}
.header-area .main-nav .nav li a:hover,
.header-area .main-nav .nav li.scroll-to-section a:hover,
.header-area .main-nav ul.nav li a:hover {
  background: transparent !important;
  color: #2a2a2a !important;
  opacity: 1 !important;
}
.header-area .main-nav .nav li a.active,
.header-area .main-nav .nav li.scroll-to-section a.active,
.header-area .main-nav ul.nav li a.active {
  color: #0d6efd !important;
  font-weight: 600 !important;
  background: transparent !important;
  opacity: 1 !important;
}
.header-area .main-nav .nav li a.active::after {
  content: '' !important;
  position: absolute !important;
  bottom: 6px !important;
  left: 18px !important;
  right: 18px !important;
  height: 2px !important;
  background: #0d6efd !important;
  border-radius: 2px !important;
}
.header-area .main-nav .nav li.nav-cta {
  margin-left: auto !important;
}
.header-area .main-nav .nav li.nav-cta a {
  background: linear-gradient(105deg, #6a11cb 0%, #2575fc 100%) !important;
  color: #fff !important;
  padding: 10px 24px;
  border-radius: 25px;
  font-weight: 600;
  font-size: 14px;
  box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
}
.header-area .main-nav .nav li.nav-cta a:hover {
  background: linear-gradient(105deg, #2575fc 0%, #6a11cb 100%) !important;
  box-shadow: 0 6px 20px rgba(37, 117, 252, 0.5);
  transform: translateY(-2px);
}
.header-area .main-nav .menu-trigger {
  display: none;
}
@media (max-width: 1200px) {
  .header-area .main-nav {
    flex-wrap: wrap;
  }
  .header-area .main-nav .nav {
    flex-basis: 100%;
    flex-wrap: wrap;
    gap: 8px;
  }
  .header-area .main-nav .nav li.nav-cta {
    margin-left: 0 !important;
  }
}
</style>

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
            <img src="{{ $topbarLogo }}" alt="{{ $profile->school_name ?? 'Logo Sekolah' }}" style="max-height: 44px; margin-right: 12px;">
            <span style="font-size: 20px; font-weight: 700; color: #1e3a8a; letter-spacing: 0.5px; white-space: nowrap; max-width: 260px; overflow: hidden; text-overflow: ellipsis;">
              {{ $profile->navbar_name ?? $profile->school_name ?? 'SMKN 1 Indonesia' }}
            </span>
          </a>
          <!-- ***** Logo End ***** -->

          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li class="scroll-to-section">
              <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}" style="color: #2a2a2a !important;">Beranda</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.profile') }}" class="{{ request()->routeIs('landing.profile') ? 'active' : '' }}" style="color: #2a2a2a !important;">Profil Sekolah</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.news') }}" class="{{ request()->routeIs('landing.news*') ? 'active' : '' }}" style="color: #2a2a2a !important;">Berita</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.extracurriculars') }}" class="{{ request()->routeIs('landing.extracurriculars') ? 'active' : '' }}" style="color: #2a2a2a !important;">Ekstrakurikuler</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.majors') }}" class="{{ request()->routeIs('landing.majors') ? 'active' : '' }}" style="color: #2a2a2a !important;">Jurusan</a>
            </li>
            <li class="scroll-to-section">
              <a href="{{ route('landing.gallery') }}" class="{{ request()->routeIs('landing.gallery') ? 'active' : '' }}" style="color: #2a2a2a !important;">Galeri</a>
            </li>
            <li class="nav-cta">
              <a href="{{ route('admin.dashboard') }}" class="btn-nav-cta"><i class="fa fa-sign-in-alt"></i> Masuk Admin</a>
            </li>
          </ul>
          <!-- ***** Menu End ***** -->

          <a class='menu-trigger'>
            <span>Menu</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->