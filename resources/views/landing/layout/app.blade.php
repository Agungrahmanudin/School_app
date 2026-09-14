<!DOCTYPE html>
<html lang="en">

  @include('landing.layout.head')

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  @include('landing.partials.topbar')

  @yield('content')

  @include('landing.layout.footer')

</body>
</html>