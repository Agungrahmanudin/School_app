@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Siswa</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.siswa') }}">Siswa</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Siswa</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="bi bi-person-plus me-2"></i>Form Tambah Siswa
                    </h6>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    NIS <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Nama Siswa <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select name="gender" class="form-select" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" @selected(old('gender') === 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('gender') === 'P')>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Kelas <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="class" class="form-control" value="{{ old('class') }}" placeholder="Contoh: XII RPL 1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Jurusan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="major" class="form-control" value="{{ old('major') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Foto Siswa <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required>
                            </div>
                        </div>
                        <small class="text-muted d-block mb-4">Format foto: JPG, JPEG, PNG. Maksimal 5MB.</small>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.siswa') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i>Simpan Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
