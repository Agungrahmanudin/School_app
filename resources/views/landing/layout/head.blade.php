<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website resmi sekolah - Informasi profil, berita, galeri, dan kegiatan sekolah">
    <meta name="author" content="">

    @php
      $appLogo = asset('landing-page/assets/images/logo.png');
      if(!empty($profile->logo)) {
        if(str_starts_with($profile->logo, 'storage/') || str_starts_with($profile->logo, 'uploads/')) {
          $appLogo = asset($profile->logo);
        } elseif(file_exists(public_path($profile->logo))) {
          $appLogo = asset($profile->logo);
        }
      }
    @endphp
    <!-- Favicon / Tab Icon -->
    <link rel="icon" type="image/png" href="{{ $appLogo }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ $appLogo }}?v={{ time() }}">
    <link rel="apple-touch-icon" href="{{ $appLogo }}?v={{ time() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>@yield('title', 'Website Sekolah')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landing-page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('landing-page/assets/css/templatemo-chain-app-dev.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('landing-page/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('landing-page/assets/css/custom.css') }}?v={{ time() }}">

    @yield('additional_css')
</head>