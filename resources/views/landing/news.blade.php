@extends('landing.layout.app')

@section('title', 'Berita & Kegiatan - ' . ($profile->school_name ?? 'SMK'))

@section('content')
  <div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Berita &amp; <em>Kegiatan Sekolah</em></h4>
            <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
            <p>Arsip informasi prestasi, pengumuman, dan liputan kegiatan civitas sekolah.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="pricing-tables" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
      <div class="row">
        @forelse($news as $item)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="school-news-card">
              <div class="news-img-box">
                @php
                  $newsThumb = asset('landing-page/assets/images/about-right-dec.png');
                  if(!empty($item->image)) {
                    if(str_starts_with($item->image, 'storage/') || str_starts_with($item->image, 'uploads/')) {
                      $newsThumb = asset($item->image);
                    } elseif(file_exists(public_path($item->image))) {
                      $newsThumb = asset($item->image);
                    }
                  }
                @endphp
                <img src="{{ $newsThumb }}" alt="{{ $item->title }}">
                <span class="news-badge">{{ $item->category->name ?? 'Kegiatan' }}</span>
              </div>
              <div class="news-body">
                <div class="news-date">
                  <i class="fa fa-calendar-alt text-primary"></i>
                  <span>{{ $item->created_at ? $item->created_at->format('d M Y') : 'Terbaru' }}</span>
                </div>
                <h5 class="news-title">
                  <a href="{{ route('landing.news.detail', $item->slug) }}">
                    {{ Str::limit($item->title, 60) }}
                  </a>
                </h5>
                <p class="news-excerpt">
                  {{ Str::limit(strip_tags($item->content), 100) }}
                </p>
                <div class="news-footer mt-auto">
                  <a href="{{ route('landing.news.detail', $item->slug) }}" class="btn-stat-link">
                    Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          
        @empty
          <div class="col-12 text-center py-5">
            <p>Belum ada berita yang dipublikasikan.</p>
          </div>
        @endforelse
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $news->links() }}
      </div>
    </div>
  </div>
@endsection