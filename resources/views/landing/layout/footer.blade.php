<footer id="newsletter">
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
              SMK Negeri 1 Talaga berkomitmen mencetak generasi unggul yang berkarakter, berkompeten, dan berdaya saing tinggi di era industri global.
            </p>
            <div class="d-flex gap-3 mt-3">
              <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
              <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
              <a href="https://youtube.com" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>Navigasi</h4>
            <ul>
              <li><a href="{{ route('home') }}"><i class="fa fa-angle-right me-1"></i> Beranda</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> Profil Sekolah</a></li>
              <li><a href="{{ route('landing.extracurriculars') }}"><i class="fa fa-angle-right me-1"></i> Ekstrakurikuler</a></li>
              <li><a href="{{ route('landing.gallery') }}"><i class="fa fa-angle-right me-1"></i> Galeri</a></li>
              <li><a href="{{ route('landing.news') }}"><i class="fa fa-angle-right me-1"></i> Berita Kegiatan</a></li>
            </ul>
          </div>
        </div>

        <!-- Academic & Programs -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>Info</h4>
            <ul>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> Visi &amp; Misi</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> Data Tenaga Pendidik</a></li>
              <li><a href="{{ route('landing.profile') }}"><i class="fa fa-angle-right me-1"></i> Statistik Siswa</a></li>
              <li><a href="{{ route('landing.news') }}"><i class="fa fa-angle-right me-1"></i> Agenda &amp; Pengumuman</a></li>
            </ul>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-widget">
            <h4>Kontak</h4>
            <p class="footer-contact-info"><i class="fa fa-map-marker-alt me-2 text-primary"></i> cimeonggggygsdygsd</p>
            <p class="footer-contact-info"><i class="fa fa-phone me-2 text-primary"></i> 434553</p>
            <p class="footer-contact-info"><i class="fa fa-envelope me-2 text-primary"></i> rapa38040@gmail.com</p>
            <p class="footer-contact-info"><i class="fa fa-globe me-2 text-primary"></i> https://smkn1talaga.sch.id</p>
          </div>
        </div>

        <!-- Copyright -->
        <div class="col-lg-12">
          <div class="copyright-text" style="border-top: 1px solid #dee2e6 !important; padding-top: 25px;">
            <p>dckshfvjcuhdsjrjdshger</p>
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
  <script src="{{ asset('landing-page/assets/js/custom.js') }}?v={{ time() }}"></script>

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