@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekstrakurikuler</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Ekstrakurikuler</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Edit Ekstrakurikuler</h6>
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

                    <form action="{{ route('admin.ekstrakurikuler.update', $extracurricular->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $extracurricular->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Pembina <span class="text-danger">*</span></label>
                                <input type="text" name="coach" class="form-control" value="{{ old('coach', $extracurricular->coach) }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Jadwal <span class="text-danger">*</span></label>
                                <input type="text" name="schedule" class="form-control" value="{{ old('schedule', $extracurricular->schedule) }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="description" rows="6" class="form-control" required>{{ old('description', $extracurricular->description) }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Kegiatan / Program</label>
                                <textarea name="activities" rows="4" class="form-control" placeholder="Masukkan kegiatan atau program, pisahkan dengan enter (baris baru) untuk setiap item&#10;Contoh:&#10;Latihan Rutin Setiap Minggu&#10;Kompetisi Tingkat Kabupaten">{{ old('activities', $extracurricular->activities) }}</textarea>
                                <small class="text-muted">Pisahkan setiap kegiatan dengan enter (baris baru). Akan ditampilkan sebagai list dengan tanda panah.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto</label>
                            @php
                                $currentImg = asset('landing-page/assets/images/about-right-dec.png');
                                if (!empty($extracurricular->image)) {
                                    if (str_starts_with($extracurricular->image, 'storage/') || str_starts_with($extracurricular->image, 'uploads/')) {
                                        $currentImg = asset($extracurricular->image);
                                    } elseif (file_exists(public_path($extracurricular->image))) {
                                        $currentImg = asset($extracurricular->image);
                                    }
                                }
                            @endphp
                            <div class="mb-2">
                                <p class="mb-1 text-muted" style="font-size: 13px;">Foto Saat Ini:</p>
                                <img id="imagePreview" src="{{ $currentImg }}" alt="Foto Ekstrakurikuler" class="rounded" style="max-height: 180px; border: 1px solid #ddd;">
                            </div>
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" id="imageInput">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maksimal ukuran 5MB.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Ekstrakurikuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('imageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('imagePreview');
                preview.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
