<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
      $appLogo = asset('assets_admin/assets/images/favicon-32x32.png');
      if(!empty($profile->logo)) {
        if(str_starts_with($profile->logo, 'storage/') || str_starts_with($profile->logo, 'uploads/')) {
          $appLogo = asset($profile->logo);
        } elseif(file_exists(public_path($profile->logo))) {
          $appLogo = asset($profile->logo);
        }
      }
    @endphp
    <link rel="icon" href="{{ $appLogo }}?v={{ time() }}" type="image/png" />
    <link rel="shortcut icon" href="{{ $appLogo }}?v={{ time() }}" />
    <link rel="apple-touch-icon" href="{{ $appLogo }}?v={{ time() }}" />
    
    <!-- Plugins -->
    <link href="{{ asset('assets_admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets_admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Loader -->
    <link href="{{ asset('assets_admin/assets/css/pace.min.css') }}" rel="stylesheet" />

    <!-- Theme Styles -->
    <link href="{{ asset('assets_admin/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/assets/css/header-colors.css') }}" rel="stylesheet" />
    @stack('styles')

    <title>@yield('title', 'Admin Panel - ' . config('app.name', 'School App'))</title>
</head>