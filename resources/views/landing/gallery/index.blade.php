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

<div class="pricing-tables" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
        <div class="row">
            @forelse($galleries as $gal)
                @php
                    $galleryImg = asset('landing-page/assets/images/about-right-dec.png');
                    if (!empty($gal->image)) {
                        if (str_starts_with($gal->image, 'storage/') || str_starts_with($gal->image, 'uploads/')) {
                            $galleryImg = asset($gal->image);
                        } elseif (file_exists(public_path($gal->image))) {
                            $galleryImg = asset($gal->image);
                        }
                    }
                @endphp
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="school-news-card">
                        <div class="news-img-box">
                            <img src="{{ $galleryImg }}" alt="{{ $gal->title }}">
                        </div>
                        <div class="news-body">
                            <div class="news-date">
                                <i class="fa fa-calendar-alt text-primary"></i>
                                <span>{{ $gal->created_at ? $gal->created_at->format('d M Y') : 'Dokumentasi Sekolah' }}</span>
                            </div>
                            <h5 class="news-title">
                                <a href="{{ route('landing.gallery.show', $gal->id) }}">
                                    {{ Str::limit($gal->title, 60) }}
                                </a>
                            </h5>
                            <p class="news-excerpt">
                                {{ Str::limit($gal->description, 100) }}
                            </p>
                            <div class="news-footer mt-auto">
                                <a href="{{ route('landing.gallery.show', $gal->id) }}" class="btn-stat-link">
                                    Lihat Detail <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
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