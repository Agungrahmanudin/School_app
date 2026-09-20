@extends('landing.layout.app')

@section('title', $gallery->title . ' - ' . ($profile->school_name ?? 'SMK'))

@section('content')

<div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="section-heading">
          <h4>Detail <em>Galeri</em></h4>
          <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
          <p>Dokumentasi foto kegiatan sekolah.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section" style="padding-top: 0; padding-bottom: 80px;">
  <div class="container">

    <div class="row align-items-start">

      <div class="col-lg-7 mb-4">
        @php
          $galleryImage = null;
          if (!empty($gallery->image)) {
            if (str_starts_with($gallery->image, 'storage/') || str_starts_with($gallery->image, 'uploads/')) {
              $galleryImage = asset($gallery->image);
            } elseif (file_exists(public_path($gallery->image))) {
              $galleryImage = asset($gallery->image);
            }
          }
        @endphp
        @if($galleryImage)
          <img src="{{ $galleryImage }}" alt="{{ $gallery->title }}" class="img-fluid rounded-3 w-100" style="max-height: 480px; object-fit: cover; box-shadow: 0 8px 30px rgba(0,0,0,0.12);">
        @else
          <div class="d-flex align-items-center justify-content-center rounded-3 w-100" style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <i class="fa fa-image" style="font-size: 80px; color: rgba(255,255,255,0.8);"></i>
          </div>
        @endif
      </div>

      <div class="col-lg-5 ps-lg-4">
        <div class="mb-2">
          <span class="text-uppercase text-muted fw-semibold" style="font-size: 12px; letter-spacing: 1.5px;">Dokumentasi Sekolah</span>
        </div>
        <h2 style="font-size: 32px; font-weight: 800; color: #2a2a2a; line-height: 1.3; margin-bottom: 20px;">{{ $gallery->title }}</h2>
        <div style="width: 60px; height: 4px; background: #0d6efd; border-radius: 2px; margin-bottom: 20px;"></div>

        @if(!empty($gallery->description))
          <p style="font-size: 15px; color: #555; line-height: 1.8;">{{ $gallery->description }}</p>
        @endif

        <div class="mt-4 p-3 rounded-3" style="background: #f0f6ff; border-left: 4px solid #0d6efd;">
          <p class="mb-1"><i class="fa fa-calendar text-primary me-2"></i> <strong>Tanggal:</strong></p>
          <p class="mb-0 text-muted">{{ $gallery->created_at ? $gallery->created_at->format('d F Y') : 'Dokumentasi Sekolah' }}</p>
        </div>

        <div class="mt-4">
          <a href="{{ route('landing.gallery') }}" class="btn btn-outline-primary me-2">
            <i class="fa fa-arrow-left me-1"></i> Semua Galeri
          </a>
          <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="fa fa-home me-1"></i> Beranda
          </a>
        </div>
      </div>
    </div>

    @if($otherGalleries->count() > 0)
      <div class="row mt-5">
        <div class="col-12 mb-4">
          <h5 class="fw-bold" style="color: #2a2a2a;">Galeri Lainnya</h5>
          <div style="width: 40px; height: 3px; background: #0d6efd; border-radius: 2px;"></div>
        </div>
        @foreach($otherGalleries as $other)
          @php
            $otherImg = null;
            if (!empty($other->image)) {
              if (str_starts_with($other->image, 'storage/') || str_starts_with($other->image, 'uploads/')) {
                $otherImg = asset($other->image);
              } elseif (file_exists(public_path($other->image))) {
                $otherImg = asset($other->image);
              }
            }
          @endphp
          <div class="col-lg-4 col-md-6 mb-3">
            <a href="{{ route('landing.gallery.show', $other->id) }}" class="text-decoration-none">
              <div class="rounded-3 overflow-hidden" style="height: 200px; position: relative; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                @if($otherImg)
                  <img src="{{ $otherImg }}" alt="{{ $other->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-image" style="color: white; font-size: 40px;"></i>
                  </div>
                @endif
                <div class="position-absolute bottom-0 start-0 end-0 p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                  <p class="mb-0 fw-semibold text-white" style="font-size: 14px;">{{ $other->title }}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif

  </div>
</div>

@endsection
