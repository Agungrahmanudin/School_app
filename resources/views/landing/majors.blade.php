@extends('landing.layout.app')

@section('title', 'Jurusan - ' . ($profile->school_name ?? 'SMK'))

@section('content')
<div class="services section" style="padding-top: 140px; padding-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-heading">
                    <h4>Program <em>Keahlian</em></h4>
                    <img src="{{ asset('landing-page/assets/images/heading-line-dec.png') }}" alt="">
                    <p>Jurusan yang tersedia di sekolah kami untuk mengembangkan potensi dan keahlian siswa.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="services section" style="padding-top: 0px; padding-bottom: 100px;">
    <div class="container">
        <div class="row">
            @forelse($majors as $index => $major)
                @php
                    $serviceClass = ['first-service', 'second-service', 'third-service', 'fourth-service'][$index % 4];
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
                    <div class="service-item {{ $serviceClass }}">
                        @if($majorImage)
                            <div class="icon" style="background-image: none; width: 80px; height: 80px; border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <img src="{{ $majorImage }}" alt="{{ $major->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                            </div>
                        @else
                            <div class="icon"></div>
                        @endif
                        <h4>{{ $major->name }}</h4>
                        <div class="mb-3">
                            <span class="badge bg-primary text-white px-3 py-2" style="font-size: 14px;">{{ $major->code }}</span>
                        </div>
                        <p>{{ $major->description ?? 'Program keahlian yang menjadi pilihan terbaik untuk masa depan siswa.' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>Belum ada data jurusan yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
