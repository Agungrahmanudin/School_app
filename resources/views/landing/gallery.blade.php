@extends('landing.layout.app')

@section('title', 'Galeri - ' . ($profile->school_name ?? 'SMK'))

@section('content')
<div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-heading">
                    <h4>Galeri <em>Dokumentasi</em></h4>
                    <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
                    <p>Momen kegiatan belajar mengajar, upacara, praktikum, dan fasilitas sekolah.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="services section" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
        <div class="row">
            @forelse($galleries as $index => $gal)
                @php
                    $serviceClass = ['first-service', 'second-service', 'third-service', 'fourth-service'][$index % 4];
                    $galleryImg = null;
                    if (!empty($gal->image)) {
                        if (str_starts_with($gal->image, 'storage/') || str_starts_with($gal->image, 'uploads/')) {
                            $galleryImg = asset($gal->image);
                        } elseif (file_exists(public_path($gal->image))) {
                            $galleryImg = asset($gal->image);
                        }
                    }
                @endphp
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item {{ $serviceClass }}">
                        @if($galleryImg)
                            <div style="width: 100%; height: 220px; border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <img src="{{ $galleryImg }}" alt="{{ $gal->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                            </div>
                        @else
                            <div class="icon"></div>
                        @endif
                        <h4>{{ $gal->title }}</h4>
                        <p>{{ $gal->description }}</p>
                        <small class="text-muted"><i class="fa fa-calendar me-1"></i> {{ $gal->created_at ? $gal->created_at->format('d M Y') : 'Dokumentasi Sekolah' }}</small>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>Belum ada dokumentasi foto galeri.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection