@extends('landing.layout.app')

@section('title', $major->name . ' - ' . ($profile->school_name ?? 'SMK'))

@section('content')

<div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="section-heading">
          <h4>Detail <em>Jurusan</em></h4>
          <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
          <p>Informasi lengkap program keahlian yang tersedia di sekolah kami.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section" style="padding-top: 0; padding-bottom: 80px;">
  <div class="container">

    <div class="row align-items-start">

      <div class="col-lg-5 mb-4">
        @php
          $majorImage = null;
          if (!empty($major->image)) {
            if (str_starts_with($major->image, 'storage/') || str_starts_with($major->image, 'uploads/')) {
              $majorImage = asset($major->image);
            } elseif (file_exists(public_path($major->image))) {
              $majorImage = asset($major->image);
            }
          }
        @endphp
        @if($majorImage)
          <img src="{{ $majorImage }}" alt="{{ $major->name }}" class="img-fluid rounded-3 w-100" style="max-height: 380px; object-fit: cover; box-shadow: 0 8px 30px rgba(0,0,0,0.12);">
        @else
          <div class="d-flex align-items-center justify-content-center rounded-3 w-100" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <i class="fa fa-graduation-cap" style="font-size: 80px; color: rgba(255,255,255,0.8);"></i>
          </div>
        @endif
      </div>

      <div class="col-lg-7 ps-lg-5">
        <div class="mb-2">
          <span class="text-uppercase text-muted fw-semibold" style="font-size: 12px; letter-spacing: 1.5px;">Program Keahlian</span>
        </div>
        <h2 style="font-size: 32px; font-weight: 800; color: #2a2a2a; line-height: 1.3; margin-bottom: 12px;">{{ $major->name }}</h2>
        <div class="mb-3">
          <span class="badge bg-primary px-3 py-2" style="font-size: 15px; letter-spacing: 1px;">{{ $major->code }}</span>
        </div>
        <div style="width: 60px; height: 4px; background: #0d6efd; border-radius: 2px; margin-bottom: 20px;"></div>

        @if(!empty($major->description))
          <p style="font-size: 15px; color: #555; line-height: 1.8;">{{ $major->description }}</p>
        @endif

        @if(!empty($major->concentrations))
          @php
            $concentrations = array_values(array_filter(array_map('trim', explode("\n", $major->concentrations))));
          @endphp
          @if(count($concentrations) > 0)
            <div class="mt-4 p-4 rounded-3" style="background: #f0f6ff; border-left: 4px solid #0d6efd;">
              <h6 class="fw-bold mb-3" style="color: #0d6efd; letter-spacing: 0.5px; font-size: 13px;">KONSENTRASI KEAHLIAN</h6>
              <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($concentrations as $item)
                  <li class="d-flex align-items-start mb-2">
                    <span style="color: #0d6efd; font-weight: 700; margin-right: 10px; margin-top: 1px;">→</span>
                    <span style="font-size: 15px; color: #2a2a2a;">{{ $item }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        @endif

        <div class="mt-4">
          <a href="{{ route('landing.majors') }}" class="btn btn-outline-primary me-2">
            <i class="fa fa-arrow-left me-1"></i> Semua Jurusan
          </a>
          <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="fa fa-home me-1"></i> Beranda
          </a>
        </div>
      </div>
    </div>

    @if($otherMajors->count() > 0)
      <div class="row mt-5">
        <div class="col-12 mb-4">
          <h5 class="fw-bold" style="color: #2a2a2a;">Jurusan Lainnya</h5>
          <div style="width: 40px; height: 3px; background: #0d6efd; border-radius: 2px;"></div>
        </div>
        @foreach($otherMajors as $other)
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
            <a href="{{ route('landing.majors.detail', $other->id) }}" class="text-decoration-none">
              <div class="d-flex align-items-center gap-3 p-3 rounded-3 h-100" style="background: #f8f9fa; border: 1px solid #e9ecef; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'; this.style.borderColor='#0d6efd';" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#e9ecef';">
                @if($otherImg)
                  <img src="{{ $otherImg }}" alt="{{ $other->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%; flex-shrink: 0;">
                @else
                  <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-graduation-cap" style="color: white; font-size: 22px;"></i>
                  </div>
                @endif
                <div>
                  <span class="badge bg-primary mb-1" style="font-size: 11px;">{{ $other->code }}</span>
                  <p class="mb-0 fw-semibold" style="color: #2a2a2a; font-size: 14px;">{{ $other->name }}</p>
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
