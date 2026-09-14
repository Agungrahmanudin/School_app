@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Galeri</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active">Tambah Galeri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-images me-2"></i>Form Tambah Galeri</h6>
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
                        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="mb-3"><label class="form-label fw-bold">Judul Galeri <span
                                        class="text-danger">*</span></label><input type="text" name="title"
                                    class="form-control" value="{{ old('title') }}" required></div>
                            <div class="mb-3"><label class="form-label fw-bold">Foto Galeri <span
                                        class="text-danger">*</span></label><input type="file" name="image"
                                    class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required>
                                <small class="text-muted d-block mb-4">Format foto: JPG, JPEG, PNG. Maksimal 5MB.</small>
                            </div>

                            <div class="mb-4"><label class="form-label fw-bold">Deskripsi <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" rows="7" class="form-control" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2"><a href="{{ route('admin.galeri') }}"
                                    class="btn btn-secondary px-4">Batal</a><button type="submit"
                                    class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Simpan Galeri</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
