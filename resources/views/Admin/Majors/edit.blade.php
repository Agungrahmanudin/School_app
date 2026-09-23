@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Jurusan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Jurusan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Edit Jurusan</h6>
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

                    <form action="{{ route('admin.majors.update', $major->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-bold">Nama Jurusan <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $major->name) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Kode <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" value="{{ old('code', $major->code) }}" required maxlength="10">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Kepala Program Keahlian (Kaprog / Kaprodi)</label>
                                <input type="text" name="kaprog" class="form-control" value="{{ old('kaprog', $major->kaprog) }}" placeholder="Contoh: Bpk. Ahmad Fauzi, S.Kom." list="teachersList">
                                <datalist id="teachersList">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->name }}">{{ $teacher->position ? $teacher->name . ' (' . $teacher->position . ')' : $teacher->name }}</option>
                                    @endforeach
                                </datalist>
                                <small class="text-muted">Bisa diketik manual atau memilih dari daftar guru yang terdaftar.</small>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $major->description) }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Konsentrasi Keahlian</label>
                                <textarea name="concentrations" rows="4" class="form-control" placeholder="Masukkan konsentrasi keahlian, pisahkan dengan enter (baris baru) untuk setiap item&#10;Contoh:&#10;Teknik Komputer dan Jaringan (TKJ)&#10;Rekayasa Perangkat Lunak (RPL)">{{ old('concentrations', $major->concentrations) }}</textarea>
                                <small class="text-muted">Pisahkan setiap konsentrasi dengan enter (baris baru). Akan ditampilkan sebagai list dengan tanda panah.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Jurusan</label>
                            @php
                                $currentImg = asset('landing-page/assets/images/about-right-dec.png');
                                if (!empty($major->image) && file_exists(public_path($major->image))) {
                                    $currentImg = asset($major->image);
                                }
                            @endphp
                            <div class="mb-2">
                                <p class="mb-1 text-muted" style="font-size: 13px;">Gambar Saat Ini:</p>
                                <img id="imagePreview" src="{{ $currentImg }}" alt="Gambar Jurusan" class="rounded" style="max-height: 180px; border: 1px solid #ddd;">
                            </div>
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" id="imageInput">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, JPEG, PNG. Maksimal ukuran 5MB.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.majors') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Jurusan</button>
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
                document.getElementById('imagePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
