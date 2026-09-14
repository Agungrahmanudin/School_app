@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Siswa</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Edit Siswa</h6>
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

                    <form action="{{ route('admin.siswa.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis" class="form-control" value="{{ old('nis', $student->nis) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="class" class="form-control" value="{{ old('class', $student->class) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jurusan <span class="text-danger">*</span></label>
                                <input type="text" name="major" class="form-control" value="{{ old('major', $student->major) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Siswa</label>
                            @php
                                $currentPhoto = asset('assets_admin/assets/images/avatars/avatar-1.png');
                                if (!empty($student->photo) && file_exists(public_path($student->photo))) {
                                    $currentPhoto = asset($student->photo);
                                }
                            @endphp
                            <div class="mb-2">
                                <p class="mb-1 text-muted" style="font-size: 13px;">Foto Saat Ini:</p>
                                <img id="imagePreview" src="{{ $currentPhoto }}" alt="Foto Siswa" class="rounded" style="max-height: 180px; border: 1px solid #ddd;">
                            </div>
                            <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" id="imageInput">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maksimal ukuran 5MB.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.siswa') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Siswa</button>
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
