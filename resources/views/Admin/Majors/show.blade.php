@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $title }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold">{{ $title }}</h6>
                </div>
                <div class="card-body p-4">
                    @foreach($fields as $label => $value)
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">{{ $label }}</label>
                            @if($label === 'Gambar' && !empty($value))
                                <div class="mt-1">
                                    <img src="{{ asset($value) }}" alt="Gambar Jurusan" class="img-fluid rounded" style="max-height: 300px; border: 1px solid #ddd;">
                                </div>
                            @else
                                <p class="form-control-plaintext">{{ $value ?? '-' }}</p>
                            @endif
                        </div>
                    @endforeach
                    <div class="mt-4">
                        <a href="{{ route($backRoute) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
