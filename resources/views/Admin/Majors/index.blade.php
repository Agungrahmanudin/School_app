@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Jurusan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active">Daftar Jurusan</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Jurusan
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold">Data Jurusan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Kode</th>
                            <th>Nama Jurusan</th>
                            <th>Deskripsi</th>
                            <th>Konsentrasi Keahlian</th>
                            <th width="100" class="text-center">Gambar</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($majors as $index => $major)
                            @php
                                $defaultImg = asset('landing-page/assets/images/about-right-dec.png');
                                $majorImg = $defaultImg;
                                if (!empty($major->image) && file_exists(public_path($major->image))) {
                                    $majorImg = asset($major->image);
                                }
                            @endphp
                            <tr>
                                <td>{{ $majors->firstItem() + $index }}</td>
                                <td><span class="badge bg-primary">{{ $major->code }}</span></td>
                                <td class="fw-semibold">{{ $major->name }}</td>
                                <td>{{ Str::limit($major->description, 80) }}</td>
                                <td>
                                    @if(!empty($major->concentrations))
                                        @php
                                            $items = array_values(array_filter(array_map('trim', explode("\n", $major->concentrations))));
                                        @endphp
                                        @foreach($items as $item)
                                            <span class="badge bg-light text-dark border me-1 mb-1" style="font-size: 12px;">→ {{ $item }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <img src="{{ $majorImg }}" alt="{{ $major->name }}" width="60" height="40" class="rounded" style="object-fit: cover;">
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.majors.show', $major->id) }}" class="btn btn-sm btn-outline-info" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.majors.edit', $major->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" onsubmit="return confirm('Hapus jurusan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data jurusan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $majors->firstItem() ?? 0 }}–{{ $majors->lastItem() ?? 0 }} dari
                        {{ $majors->total() }} data
                    </small>
                    {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                    {{ $majors->withQueryString()->links('vendor.pagination.custom') }}
                </div>
        </div>
    </div>
</main>
@endsection
