@extends('landing.layout.app')

@section('title', 'Jurusan - ' . ($profile->school_name ?? 'SMK'))

@section('content')
<!-- ***** Program Keahlian / Jurusan ***** -->
<div class="services section" style="padding-top: 140px; padding-bottom: 100px; background: #fff;">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="section-heading text-center mb-5">
          <h4>Program <em>Keahlian</em></h4>
          <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="" class="d-block mx-auto my-2">
          <p>Kelompok Program Keahlian unggulan dengan kompetensi yang dikembangkan terarah.</p>
        </div>
      </div>
    </div>
    
    <div class="row justify-content-center">
      @forelse($majors as $index => $major)
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
        <div class="col-lg-4 col-md-6 mb-4">
          <a href="{{ route('landing.majors.detail', $major->id) }}" class="text-decoration-none">
          <div class="major-card">
            @if($majorImage)
              <div class="major-icon" style="background: transparent; padding: 0;">
                <img src="{{ $majorImage }}" alt="{{ $major->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
              </div>
            @else
              <div class="major-icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
            @endif
            <h5 class="major-title">{{ $major->name }} ({{ $major->code }})</h5>
            <p class="major-desc">{{ Str::limit($major->description ?? 'Kelompok Program Keahlian unggulan dengan kompetensi yang dikembangkan terarah.', 100) }}</p>
            @if(!empty($major->kaprog))
              <div class="major-kaprog mb-3 py-1 px-3 rounded-pill text-center d-inline-block" style="background: rgba(13, 110, 253, 0.08); font-size: 13px; color: #0d6efd; font-weight: 600;">
                <i class="fa fa-user-tie me-1"></i> Kaprog: {{ $major->kaprog }}
              </div>
            @endif
            @if(!empty($major->concentrations))
              @php
                $concentrations = array_filter(array_map('trim', explode("\n", $major->concentrations)));
              @endphp
              @if(count($concentrations) > 0)
                <div class="major-concentration">
                  <p class="concentration-label">KONSENTRASI KEAHLIAN:</p>
                  <ul class="concentration-list">
                    @foreach($concentrations as $concentration)
                      <li>{{ $concentration }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            @endif
          </div>
          </a>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">Belum ada data jurusan yang tersedia.</p>
        </div>
      @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
      {{ $majors->links() }}
    </div>
  </div>
</div>

@endsection

