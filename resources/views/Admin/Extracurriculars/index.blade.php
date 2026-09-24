@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    {{-- Breadcrumb --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ekstrakurikuler</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active">Daftar Ekstrakurikuler</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Ekstrakurikuler
            </a>
        </div>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Card --}}
    <div class="card">
        <div class="card-header py-3">
            <h6 class="mb-0 fw-bold">Data Ekstrakurikuler</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Kegiatan/Program</th>
                            <th>Jadwal</th>
                            <th>Pembina</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($extracurriculars as $index => $item)
                            @php
                                $extraImage = asset('landing-page/assets/images/about-right-dec.png');

                                if (!empty($item->image)) {
                                    if (
                                        str_starts_with($item->image, 'storage/') ||
                                        str_starts_with($item->image, 'uploads/')
                                    ) {
                                        $extraImage = asset($item->image);
                                    } elseif (file_exists(public_path($item->image))) {
                                        $extraImage = asset($item->image);
                                    }
                                }
                            @endphp

                            <tr>
                                <td>{{ $extracurriculars->firstItem() + $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{Str::limit($item->description, 80)}}</td>

                                <td>
                                    @if (!empty($item->activities))
                                        @php
                                            $activities = array_values(
                                                array_filter(
                                                    array_map('trim', explode("\n", $item->activities))
                                                )
                                            );
                                        @endphp

                                        @foreach ($activities as $activity)
                                            <span class="badge bg-light text-dark border me-1 mb-1" style="font-size: 12px;">
                                                → {{ $activity }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $item->schedule }}</td>
                                <td>{{ $item->coach }}</td>

                                <td>
                                    <img src="{{ $extraImage }}"
                                         alt="{{ $item->name }}"
                                         width="70"
                                         height="45"
                                         class="rounded"
                                         style="object-fit: cover;">
                                </td>

                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.ekstrakurikuler.show', $item->id) }}"
                                           class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.ekstrakurikuler.edit', $item->id) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.ekstrakurikuler.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Belum ada data ekstrakurikuler.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $extracurriculars->firstItem() ?? 0 }}–{{ $extracurriculars->lastItem() ?? 0 }} dari
                        {{ $extracurriculars->total() }} data
                    </small>
                    {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                    {{ $extracurriculars->withQueryString()->links('vendor.pagination.custom') }}
                </div>
        </div>
    </div>
</main>
@endsection