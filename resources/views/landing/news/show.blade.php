@extends('landing.layout.app')

@section('title', $article->title . ' - ' . ($profile->school_name ?? 'SMK'))

@section('content')
  <div class="services section" style="padding-top: 140px; padding-bottom: 20px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Detail <em>Berita Sekolah</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="about-us section" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="service-item" style="padding: 40px; border-radius: 20px; overflow: hidden;">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3" style="width: fit-content; display: inline-block;">
              {{ $article->category->name ?? 'Kegiatan' }}
            </span>
            <h3 class="mb-3" style="font-weight: 700; color: #2a2a2a;">{{ $article->title }}</h3>
            <p class="text-muted small mb-4">
              <i class="fa fa-calendar me-1"></i> {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y') : ($article->created_at ? $article->created_at->translatedFormat('d F Y') : '-') }} &bull; 
              <i class="fa fa-user me-1"></i> {{ $article->createdBy->name ?? 'Admin Sekolah' }}
            </p>

            <div style="height: 380px; overflow: hidden; border-radius: 15px; margin-bottom: 30px;">
              @php
                $detailImg = asset('landing-page/assets/images/about-right-dec.png');
                if(!empty($article->image)) {
                  if(str_starts_with($article->image, 'storage/') || str_starts_with($article->image, 'uploads/')) {
                    $detailImg = asset($article->image);
                  } elseif(file_exists(public_path($article->image))) {
                    $detailImg = asset($article->image);
                  }
                }
              @endphp
              <img src="{{ $detailImg }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div style="font-size: 16px; line-height: 1.9; color: #444; white-space: pre-line; word-wrap: break-word; overflow-wrap: break-word; max-width: 100%;">
              {{ $article->content }}
            </div>

            <div class="border-top pt-4 mt-5 d-flex justify-content-between align-items-center">
              <div class="white-button">
                <a href="{{ route('landing.news') }}"><i class="fa fa-arrow-left"></i> Kembali ke Berita</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="service-item" style="padding: 30px; border-radius: 20px; margin-bottom: 30px;">
            <h4 style="margin-bottom: 20px; font-size: 18px;">Berita Lainnya</h4>
            @foreach($recentNews as $recent)
              <div class="border-bottom pb-3 mb-3">
                <h6 style="font-size: 14px; font-weight: 600;">
                  <a href="{{ route('landing.news.detail', $recent->slug) }}" style="color: #2a2a2a;">
                    {{ Str::limit($recent->title, 50) }}
                  </a>
                </h6>
                <small class="text-muted"><i class="fa fa-calendar me-1"></i> {{ $recent->created_at ? $recent->created_at->format('d M Y') : '-' }}</small>
              </div>
            @endforeach
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection