@extends('landing.layout.app')

@section('title', 'Ekstrakurikuler - ' . ($profile->school_name ?? 'SMK'))

@section('content')
  <div class="services section" style="padding-top: 140px; padding-bottom: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center mb-4" style="margin-bottom: 35px !important;">
            <h4>Ekstrakurikuler <em>Pilihan</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
            <p>Kegiatan penunjang minat, bakat, kepemimpinan, dan kreativitas siswa siswi sekolah.</p>
          </div>
        </div>
      </div>

      <div class="row">
        @forelse($extracurriculars as $index => $item)
          @php
            $serviceClass = ['first-service', 'second-service', 'third-service', 'fourth-service'][$index % 4];
            $extraImage = null;
            if (!empty($item->image)) {
              if (str_starts_with($item->image, 'storage/') || str_starts_with($item->image, 'uploads/')) {
                $extraImage = asset($item->image);
              } elseif (file_exists(public_path($item->image))) {
                $extraImage = asset($item->image);
              }
            }
          @endphp
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="school-news-card h-100">
              <div class="news-img-box">
                <img src="{{ $extraImage }}" alt="{{ $item->name }}">
                <span class="news-badge"><i class="fa fa-running me-1"></i> Ekskul</span>
              </div>
              <div class="news-body">
                <div class="news-date">
                  <i class="fa fa-clock text-primary me-1"></i>
                  <span>{{ $item->schedule ?? 'Kegiatan Rutin' }}</span>
                </div>
                <h4 class="news-title">
                  <a href="{{ route('landing.extracurriculars.detail', $item->id) }}">{{ Str::limit($item->name, 45) }}</a>
                </h4>
                <p class="news-excerpt">
                  {{ Str::limit($item->description ?? 'Wadah pengembangan potensi, minat, dan bakat siswa di sekolah.', 90) }}
                </p>
                <div class="news-footer mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                  @if(!empty($item->coach))
                    <small class="text-muted"><i class="fa fa-user-tie text-primary me-1"></i> {{ Str::limit($item->coach, 18) }}</small>
                  @else
                    <small class="text-muted"><i class="fa fa-check-circle text-success me-1"></i> Aktif</small>
                  @endif
                  <a href="{{ route('landing.extracurriculars.detail', $item->id) }}" class="btn-stat-link">
                    Detail Ekskul <i class="fa fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p>Belum ada data ekstrakurikuler.</p>
          </div>
        @endforelse
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $extracurriculars->links() }}
      </div>
    </div>
  </div>
@endsection