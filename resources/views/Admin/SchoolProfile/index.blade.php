@extends('Admin.layout.app')

@push('styles')
    <style>
        .profile-tabs {
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 2rem !important;
            gap: 0.5rem;
        }

        .profile-tabs .nav-link {
            padding: 0.75rem 1.5rem;
            border: none;
            border-bottom: 3px solid transparent;
            background: transparent;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s;
        }

        .profile-tabs .nav-link:hover {
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.05);
        }

        .profile-tabs .nav-link.active {
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.1);
            border-bottom-color: #0d6efd;
        }

        .form-section-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-section-card:last-child {
            margin-bottom: 0;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #dee2e6;
        }

        .form-section-title i {
            color: #0d6efd;
            margin-right: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3 fw-bold">Profil Sekolah</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Kelola Profil &amp; Foto Sekolah</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('landing.profile') }}" target="_blank" class="btn btn-outline-primary px-3 rounded-pill">
                    <i class="bi bi-eye me-1"></i> Lihat Halaman Profil
                </a>
            </div>
        </div>
        <!--end breadcrumb-->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 border-bottom-0">
                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-gear-fill me-2"></i>Pengaturan Profil &amp; Media</h5>
            </div>
            <div class="card-body p-4 pt-0">

                <!-- Navigasi Tab -->
                <ul class="nav nav-pills profile-tabs mb-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="identity-tab" data-bs-toggle="tab" data-bs-target="#identity"
                            type="button" role="tab">
                            <i class="bi bi-building me-2"></i>Data Pokok
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button"
                            role="tab">
                            <i class="bi bi-image me-2"></i>Hero &amp; Media
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision"
                            type="button" role="tab">
                            <i class="bi bi-journal-text me-2"></i>Visi Misi
                        </button>
                    </li>
                </ul>

                <form action="{{ route('admin.profil.sekolah.update') }}" method="POST" enctype="multipart/form-data"
                    id="formProfilSekolah">
                    @csrf

                    <div class="tab-content" id="profileTabsContent">

                        <!-- TAB 1: DATA POKOK -->
                        <div class="tab-pane fade show active" id="identity" role="tabpanel">
                            <div class="form-section-card">
                                <h6 class="form-section-title"><i class="bi bi-info-circle-fill"></i> Data Pokok Sekolah
                                </h6>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="school_name" class="form-control"
                                            value="{{ old('school_name', $profile->school_name ?? '') }}" required
                                            placeholder="Masukkan nama sekolah">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Tampil di Navbar</label>
                                        <input type="text" name="navbar_name" class="form-control"
                                            value="{{ old('navbar_name', $profile->navbar_name ?? '') }}"
                                            placeholder="Kosongkan untuk memakai Nama Sekolah">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NPSN <span class="text-danger">*</span></label>
                                        <input type="text" name="npsn" class="form-control"
                                            value="{{ old('npsn', $profile->npsn ?? '') }}" required
                                            placeholder="Contoh: 12345678">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Kepala Sekolah <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="principal_name" class="form-control"
                                            value="{{ old('principal_name', $profile->principal_name ?? '') }}" required
                                            placeholder="Nama lengkap dan gelar">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Telepon Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $profile->phone ?? '') }}" required
                                            placeholder="(021) 1234567">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Sekolah <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $profile->email ?? '') }}" required
                                            placeholder="info@sekolah.sch.id">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Website Resmi</label>
                                        <input type="url" name="website" class="form-control"
                                            value="{{ old('website', $profile->website ?? '') }}"
                                            placeholder="https://sekolah.sch.id">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea name="address" rows="3" class="form-control" required
                                            placeholder="Alamat lengkap sekolah">{{ old('address', $profile->address ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: HERO & MEDIA -->
                        <div class="tab-pane fade" id="media" role="tabpanel">

                            <div class="row g-4">
                                <!-- Foto Utama Sekolah -->
                                <div class="col-lg-6">
                                    <div class="form-section-card h-100 mb-0">
                                        <h6 class="form-section-title"><i class="bi bi-card-image"></i> Foto Utama Sekolah
                                        </h6>
                                        <small class="text-muted d-block mb-3">Tampil di Beranda, Visi &amp; Misi, serta
                                            Sambutan Kepala Sekolah. Ukuran tampil tetap (460&times;300px).</small>
                                        @php
                                            $schoolPhoto = asset('landing-page/assets/images/about-right-dec.png');
                                            if (!empty($profile->school_photo)) {
                                                if (
                                                    str_starts_with($profile->school_photo, 'storage/') ||
                                                    str_starts_with($profile->school_photo, 'uploads/')
                                                ) {
                                                    $schoolPhoto = asset($profile->school_photo);
                                                } elseif (file_exists(public_path($profile->school_photo))) {
                                                    $schoolPhoto = asset($profile->school_photo);
                                                }
                                            }
                                        @endphp
                                        <div class="image-preview-box">
                                            <img id="previewSchoolPhoto" src="{{ $schoolPhoto }}" alt="Foto Sekolah">
                                        </div>
                                        <input type="file" name="school_photo" id="inputSchoolPhoto"
                                            class="form-control custom-file-input"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                                        <small class="text-muted d-block mt-2">Format: JPG, JPEG, PNG. Maks 5MB. Rasio
                                            disarankan 3:2.</small>
                                        <div class="invalid-feedback-custom text-danger small mt-1" id="errorSchoolPhoto">
                                        </div>
                                    </div>
                                </div>

                                <!-- Logo Sekolah -->
                                <div class="col-lg-6">
                                    <div class="form-section-card h-100 mb-0">
                                        <h6 class="form-section-title"><i class="bi bi-award"></i> Logo Sekolah</h6>
                                        <small class="text-muted d-block mb-3">Tampil di Navbar dan Footer. Disarankan
                                            format PNG transparan.</small>
                                        @php
                                            $logoPhoto = asset('landing-page/assets/images/logo.png');
                                            if (!empty($profile->logo)) {
                                                if (
                                                    str_starts_with($profile->logo, 'storage/') ||
                                                    str_starts_with($profile->logo, 'uploads/')
                                                ) {
                                                    $logoPhoto = asset($profile->logo);
                                                } elseif (file_exists(public_path($profile->logo))) {
                                                    $logoPhoto = asset($profile->logo);
                                                }
                                            }
                                        @endphp
                                        <div class="image-preview-box logo-box">
                                            <img id="previewLogo" src="{{ $logoPhoto }}" alt="Logo Sekolah">
                                        </div>
                                        <input type="file" name="logo" id="inputLogo"
                                            class="form-control custom-file-input"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                                        <small class="text-muted d-block mt-2">Format: PNG transparan atau JPG. Maks
                                            5MB.</small>
                                        <div class="invalid-feedback-custom text-danger small mt-1" id="errorLogo"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hero Beranda -->
                            <div class="form-section-card mt-4">
                                <h6 class="form-section-title"><i class="bi bi-window-desktop"></i> Pengaturan Hero
                                    Beranda</h6>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Judul Hero</label>
                                        <input type="text" name="hero_title" class="form-control"
                                            value="{{ old('hero_title', $profile->hero_title ?? '') }}"
                                            placeholder="Contoh: Selamat Datang di Website Resmi">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Deskripsi Singkat Hero</label>
                                        <textarea name="hero_description" rows="3" class="form-control" maxlength="1000"
                                            placeholder="Deskripsi singkat...">{{ old('hero_description', $profile->hero_description ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Gambar Hero (Landscape)</label>
                                        @php
                                            $heroPhoto = asset('landing-page/assets/images/slider-dec.png');
                                            if (!empty($profile->hero_image)) {
                                                if (
                                                    str_starts_with($profile->hero_image, 'storage/') ||
                                                    str_starts_with($profile->hero_image, 'uploads/')
                                                ) {
                                                    $heroPhoto = asset($profile->hero_image);
                                                } elseif (file_exists(public_path($profile->hero_image))) {
                                                    $heroPhoto = asset($profile->hero_image);
                                                }
                                            }
                                        @endphp
                                        <div class="image-preview-box hero-preview-box">
                                            <img id="previewHeroImage" src="{{ $heroPhoto }}" alt="Hero Beranda">
                                        </div>
                                        <input type="file" name="hero_image" id="inputHeroImage"
                                            class="form-control custom-file-input"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                                        <small class="text-muted d-block mt-2">Gambar latar belakang Hero. Disarankan rasio
                                            landscape lebar (misal 16:9).</small>
                                        <div class="invalid-feedback-custom text-danger small mt-1" id="errorHeroImage">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: VISI MISI -->
                        <div class="tab-pane fade" id="vision" role="tabpanel">
                            <div class="form-section-card">
                                <h6 class="form-section-title"><i class="bi bi-journal-text"></i> Visi, Misi &amp; Sejarah
                                    Sekolah</h6>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Visi Sekolah</label>
                                        <textarea name="vision" rows="6" class="form-control" placeholder="Tuliskan Visi Sekolah...">{{ old('vision', $profile->vision ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Misi Sekolah</label>
                                        <textarea name="mission" rows="6" class="form-control" placeholder="Tuliskan Misi Sekolah...">{{ old('mission', $profile->mission ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Sejarah / Profil Singkat</label>
                                        <textarea name="history" rows="4" class="form-control" placeholder="Ceritakan sejarah singkat sekolah...">{{ old('history', $profile->history ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>

                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end align-items-center mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-save-sticky" id="btnSubmitProfil">
                            <i class="bi bi-save me-2"></i> Simpan Perubahan Profil &amp; Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
