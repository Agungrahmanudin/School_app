@extends('Admin.layout.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Berita Sekolah</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Daftar Berita</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-1"></i> Tambah Berita</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Semua Berita &amp; Artikel Sekolah</h6>
            <span class="badge bg-primary">{{ $news->total() }} Total Berita</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th width="120">Foto</th>
                            <th>Judul Berita</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal Rilis</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $index => $item)
                            @php
                                $imgSrc = asset('landing-page/assets/images/pricing-table-01.png');
                                if (!empty($item->image)) {
                                    if (str_starts_with($item->image, 'storage/') || str_starts_with($item->image, 'uploads/')) {
                                        $imgSrc = asset($item->image);
                                    } elseif (file_exists(public_path($item->image))) {
                                        $imgSrc = asset($item->image);
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ $news->firstItem() + $index }}</td>
                                <td>
                                    <img src="{{ $imgSrc }}" alt="{{ $item->title }}" class="rounded" width="90" height="60" style="object-fit: cover; border: 1px solid #e2e8f0;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ Str::limit($item->title, 55) }}</div>
                                    <small class="text-muted">{{ Str::limit(strip_tags($item->content), 70) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light-primary text-primary">{{ $item->category->name ?? 'Umum' }}</span>
                                </td>
                                <td>{{ $item->createdBy->name ?? 'Admin' }}</td>
                                <td>
                                    <small>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d/m/Y H:i') : '-' }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.berita.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data berita. Silakan klik tombol "Tambah Berita" di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
           <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $news->firstItem() ?? 0 }}–{{ $news->lastItem() ?? 0 }} dari
                        {{ $news->total() }} data
                    </small>
                    {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                    {{ $news->withQueryString()->links('vendor.pagination.custom') }}
                </div>
        </div>
    </div>
</main>
@endsection

