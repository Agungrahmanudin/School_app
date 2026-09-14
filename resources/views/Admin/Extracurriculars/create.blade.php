@extends('Admin.layout.app')
@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ekstrakurikuler</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                        <li class="breadcrumb-item active">Tambah Ekstrakurikuler</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-trophy me-2"></i>Form Tambah Ekstrakurikuler</h6>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf<div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Nama Ekstrakurikuler <span
                                            class="text-danger">*</span></label><input type="text" name="name"
                                        class="form-control" value="{{ old('name') }}" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Pembina <span
                                            class="text-danger">*</span></label><input type="text" name="coach"
                                        class="form-control" value="{{ old('coach') }}" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Jadwal <span
                                            class="text-danger">*</span></label><input type="text" name="schedule"
                                        class="form-control" value="{{ old('schedule') }}" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label fw-bold">Foto <span
                                            class="text-danger">*</span></label><input type="file" name="image"
                                        class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required></div>
                                <div class="col-12 mb-4"><label class="form-label fw-bold">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <textarea name="description" rows="6" class="form-control" required>{{ old('description') }}</textarea>
                                </div>
                                <div class="col-12 mb-4"><label class="form-label fw-bold">Kegiatan / Program</label>
                                    <textarea name="activities" rows="4" class="form-control" placeholder="Masukkan kegiatan atau program, pisahkan dengan enter (baris baru) untuk setiap item&#10;Contoh:&#10;Latihan Rutin Setiap Minggu&#10;Kompetisi Tingkat Kabupaten">{{ old('activities') }}</textarea>
                                    <small class="text-muted">Pisahkan setiap kegiatan dengan enter (baris baru). Akan ditampilkan sebagai list dengan tanda panah.</small>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-4">Format foto: JPG, JPEG, PNG. Maksimal 5MB.</small>
                            <div class="d-flex justify-content-end gap-2">                              
                                <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Simpan Ekstrakurikuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
