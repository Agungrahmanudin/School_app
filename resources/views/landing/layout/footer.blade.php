<footer id="newsletter" style="margin-top: 0 !important; padding-top: 80px !important; background-color: #f8f9fa !important;">
    <div class="container-fluid">
      <div class="row">
        <!-- School Info & Logo -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>Tentang Sekolah</h4>
            <div class="logo footer-school-logo mb-3">
              @php
                $footerLogo = asset('landing-page/assets/images/white-logo.png');
                if (!empty($profile->logo)) {
                  if (str_starts_with($profile->logo, 'storage/') || str_starts_with($profile->logo, 'uploads/')) {
                    $footerLogo = asset($profile->logo);
                  } elseif (file_exists(public_path($profile->logo))) {
                    $footerLogo = asset($profile->logo);
                  }
                }
              @endphp
              <img src="{{ $footerLogo }}" alt="Logo Sekolah">
            </div>
            <p class="footer-description-text">
              {{ $profile->footer_description ?? (($profile->school_name ?? 'Sekolah') . ' berkomitmen mencetak generasi unggul yang berkarakter, berkompeten, dan berdaya saing tinggi di era industri global.') }}
            </p>
            @if($profile?->facebook_url || $profile?->instagram_url || $profile?->youtube_url)
              <div class="d-flex gap-3 mt-3">
                @if($profile?->facebook_url)<a href="{{ $profile->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook fa-lg"></i></a>@endif
                @if($profile?->instagram_url)<a href="{{ $profile->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>@endif
                @if($profile?->youtube_url)<a href="{{ $profile->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>@endif
              </div>
            @endif
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>{{ $profile->footer_nav_title ?? 'Navigasi' }}</h4>
            <ul>
              <li><a href="{{ route('home') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_nav_home ?? 'Beranda' }}</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_nav_profile ?? 'Profil Sekolah' }}</a></li>
              <li><a href="{{ route('landing.extracurriculars') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_nav_extracurricular ?? 'Ekstrakurikuler' }}</a></li>
              <li><a href="{{ route('landing.gallery') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_nav_gallery ?? 'Galeri' }}</a></li>
              <li><a href="{{ route('landing.news') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_nav_news ?? 'Berita Kegiatan' }}</a></li>
            </ul>
          </div>
        </div>

        <!-- Academic & Programs -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>{{ $profile->footer_info_title ?? 'Informasi' }}</h4>
            <ul>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_info_vision ?? 'Visi & Misi' }}</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_info_teachers ?? 'Data Tenaga Pendidik' }}</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_info_students ?? 'Statistik Siswa' }}</a></li>
              <li><a href="{{ route('landing.news') }}"><i class="fa fa-angle-right me-1"></i> {{ $profile->footer_info_news ?? 'Agenda & Pengumuman' }}</a></li>
            </ul>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>{{ $profile->footer_contact_title ?? 'Kontak Kami' }}</h4>
            
            @php
              $contactMenus = [
                $profile->footer_contact_menu_1 ?? null,
                $profile->footer_contact_menu_2 ?? null,
                $profile->footer_contact_menu_3 ?? null,
                $profile->footer_contact_menu_4 ?? null,
                $profile->footer_contact_menu_5 ?? null,
              ];
              $contactMenus = array_filter($contactMenus);
            @endphp
            
            @if(count($contactMenus) > 0)
              <ul class="mb-3">
                @foreach($contactMenus as $menu)
                  <li><a href="#"><i class="fa fa-angle-right me-1"></i> {{ $menu }}</a></li>
                @endforeach
              </ul>
              <hr class="footer-contact-hr">
            @endif
            
            <p class="footer-contact-info"><i class="fa fa-map-marker-alt me-2 text-primary"></i> {{ $profile->address ?? 'Jl. Pendidikan No. 45, Jakarta' }}</p>
            <p class="footer-contact-info"><i class="fa fa-phone me-2 text-primary"></i> {{ $profile->phone ?? '(021) 7890-1234' }}</p>
            <p class="footer-contact-info"><i class="fa fa-envelope me-2 text-primary"></i> {{ $profile->email ?? 'info@sekolah.sch.id' }}</p>
            <p class="footer-contact-info"><i class="fa fa-globe me-2 text-primary"></i> {{ $profile->website ?? 'https://smkn1indonesia.sch.id' }}</p>
          </div>
        </div>

        <!-- Copyright -->
        <div class="col-lg-12">
          <div class="copyright-text" style="border-top: 1px solid #dee2e6 !important; padding-top: 25px;">
            <p>{{ $profile->footer_copyright ?? ('© ' . date('Y') . ' ' . ($profile->school_name ?? 'Sekolah') . '. Hak Cipta Dilindungi Undang-Undang.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- Back to Top Button -->
  <button id="backToTop" title="Kembali ke Atas">
    <i class="fa fa-arrow-up"></i>
  </button>

  <!-- Scripts -->
  <script src="{{ asset('landing-page/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/animation.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/imagesloaded.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/popup.js') }}"></script>
  <script src="{{ asset('landing-page/assets/js/custom.js') }}"></script>

  <!-- Back to Top Script -->
  <script>
    $(document).ready(function() {
      var backToTopBtn = $('#backToTop');
      
      // Show button when scroll down 300px
      $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
          backToTopBtn.addClass('show');
        } else {
          backToTopBtn.removeClass('show');
        }
      });
      
      // Smooth scroll to top
      backToTopBtn.click(function() {
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
      });
    });
  </script>

  @yield('scripts')