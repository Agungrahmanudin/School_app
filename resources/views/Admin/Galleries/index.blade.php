@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Galeri</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active">Daftar Galeri</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"><a href="{{ route('admin.galeri.create') }}" class="btn btn-primary"><i
                        class="bi bi-plus-lg me-1"></i>Tambah Galeri</a></div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold">Data Galeri</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galleries as $index => $gallery)
                                @php $image = !empty($gallery->image) && (str_starts_with($gallery->image, 'uploads/') || file_exists(public_path($gallery->image))) ? asset($gallery->image) : asset('landing-page/assets/images/about-right-dec.png'); @endphp
                                <tr>
                                    <td>{{ $galleries->firstItem() + $index }}</td>
                                    <td><img src="{{ $image }}" alt="{{ $gallery->title }}" width="75"
                                            height="50" class="rounded" style="object-fit:cover"></td>
                                    <td>{{ $gallery->title }}</td>
                                    <td>{{ Str::limit($gallery->description, 80) }}</td>
                                    <td>{{ $gallery->created_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1"><a
                                                href="{{ route('admin.galeri.show', $gallery->id) }}"
                                                class="btn btn-sm btn-outline-info" title="Lihat"><i
                                                    class="bi bi-eye"></i></a><a
                                                href="{{ route('admin.galeri.edit', $gallery->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit"><i
                                                    class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus galeri ini?')">@csrf
                                                @method('DELETE')<button class="btn btn-sm btn-outline-danger"
                                                    title="Hapus"><i class="bi bi-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data galeri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $galleries->firstItem() ?? 0 }}–{{ $galleries->lastItem() ?? 0 }} dari
                        {{ $galleries->total() }} data
                    </small>
                    {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                    {{ $galleries->withQueryString()->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
@endsection
