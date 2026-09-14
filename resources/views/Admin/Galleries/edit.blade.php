@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Galeri</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Galeri</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Edit Galeri</h6>
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

                    <form action="{{ route('admin.galeri.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Galeri <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" rows="7" class="form-control" required>{{ old('description', $gallery->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Galeri</label>
                            @php
                                $currentImg = asset('landing-page/assets/images/about-right-dec.png');
                                if (!empty($gallery->image)) {
                                    if (str_starts_with($gallery->image, 'uploads/') || file_exists(public_path($gallery->image))) {
                                        $currentImg = asset($gallery->image);
                                    }
                                }
                            @endphp
                            <div class="mb-2">
                                <p class="mb-1 text-muted" style="font-size: 13px;">Foto Saat Ini:</p>
                                <img id="imagePreview" src="{{ $currentImg }}" alt="Foto Galeri" class="rounded" style="max-height: 180px; border: 1px solid #ddd;">
                            </div>
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" id="imageInput">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maksimal ukuran 5MB.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.galeri') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Galeri</button>
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
