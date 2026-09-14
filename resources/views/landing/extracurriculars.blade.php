@extends('landing.layout.app')

@section('title', 'Ekstrakurikuler - ' . ($profile->school_name ?? 'SMK'))

@section('content')
  <div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Ekstrakurikuler <em>Pilihan</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Kegiatan penunjang minat, bakat, kepemimpinan, dan kreativitas siswa siswi sekolah.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="services section" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
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
            <div class="service-item {{ $serviceClass }}">
              @if($extraImage)
                <div class="icon" style="background-image: none; width: 80px; height: 80px; border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                  <img src="{{ $extraImage }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                </div>
              @else
                <div class="icon"></div>
              @endif
              <h4>{{ $item->name }}</h4>
              <p>{{ $item->description }}</p>
              @if(!empty($item->activities))
                @php
                  $activities = array_values(array_filter(array_map('trim', explode("\n", $item->activities))));
                @endphp
                @if(count($activities) > 0)
                  <div class="border-top pt-3 mt-3">
                    <small class="d-block fw-bold text-primary mb-2"><i class="fa fa-list-ul me-1"></i> Kegiatan:</small>
                    @foreach(array_slice($activities, 0, 3) as $activity)
                      <small class="d-block text-muted mb-1">→ {{ $activity }}</small>
                    @endforeach
                    @if(count($activities) > 3)
                      <small class="text-muted fst-italic">+ {{ count($activities) - 3 }} kegiatan lainnya</small>
                    @endif
                  </div>
                @endif
              @endif
              <div class="border-top pt-3 mt-3">
                <small class="d-block text-muted"><strong><i class="fa fa-user me-1"></i> Pembina:</strong> {{ $item->coach }}</small>
                <small class="d-block text-primary mt-1"><strong><i class="fa fa-clock me-1"></i> Jadwal:</strong> {{ $item->schedule }}</small>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p>Belum ada data ekstrakurikuler.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>
@endsection