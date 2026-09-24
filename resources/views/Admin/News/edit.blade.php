@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Berita</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Berita</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Edit Berita Kegiatan</h6>
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

                    <form action="{{ route('admin.berita.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Berita <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Berita</label>
                            @php
                                $currentImg = asset('landing-page/assets/images/pricing-table-01.png');
                                if (!empty($news->image)) {
                                    if (str_starts_with($news->image, 'storage/') || str_starts_with($news->image, 'uploads/')) {
                                        $currentImg = asset($news->image);
                                    } elseif (file_exists(public_path($news->image))) {
                                        $currentImg = asset($news->image);
                                    }
                                }
                            @endphp
                            <div class="mb-2">
                                <p class="mb-1 text-muted" style="font-size: 13px;">Foto Saat Ini:</p>
                                <img id="imagePreview" src="{{ $currentImg }}" alt="Foto Berita" class="rounded" style="max-height: 180px; border: 1px solid #ddd;">
                            </div>
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" id="imageInput">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maksimal ukuran 5MB.</small>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Isi Konten Berita <span class="text-danger">*</span></label>
                            <textarea name="content" rows="8" class="form-control" required>{{ old('content', $news->content)}}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.berita') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imagePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

