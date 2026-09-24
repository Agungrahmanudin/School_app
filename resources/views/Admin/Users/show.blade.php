@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route($backRoute) }}">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold">{{ $title }}</h6>
            </div>
            <div class="card-body p-4">
                <dl class="row mb-0">
                    @php
                        $defaultImage = asset('assets_admin/assets/images/avatars/avatar-1.png');
                    @endphp
                    @foreach ($fields as $label => $value)
                        @php
                            $isImage = in_array(strtolower(trim($label)), ['foto', 'gambar', 'image', 'photo', 'foto guru', 'foto siswa', 'foto berita']);
                        @endphp
                        <dt class="col-sm-3 mb-3 fw-bold text-secondary">{{ $label }}</dt>
                        <dd class="col-sm-9 mb-3">
                            @if ($isImage)
                                @php
                                    $imgSrc = !empty($value) ? ((str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) ? $value : asset(ltrim($value, '/'))) : $defaultImage;
                                @endphp
                                <div class="d-inline-block">
                                    <a href="{{ $imgSrc }}" target="_blank" title="Klik untuk melihat foto penuh">
                                        <img src="{{ $imgSrc }}" 
                                             alt="{{ $label }}" 
                                             class="rounded border shadow-sm" 
                                             style="width: 240px; max-width: 100%; aspect-ratio: 4 / 3; object-fit: cover; display: block;" 
                                             onerror="this.onerror=null; this.src='{{ $defaultImage }}';">
                                    </a>
                                    <small class="text-muted mt-1 d-block" style="font-size: 11px;">
                                        <i class="bi bi-arrows-fullscreen me-1"></i>Klik gambar untuk memperbesar
                                    </small>
                                </div>
                            @else
                                <div style="white-space: pre-line;">{{ $value ?: '-' }}</div>
                            @endif
                        </dd>
                    @endforeach
                </dl>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ route($backRoute) }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
