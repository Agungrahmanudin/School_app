@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Guru</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active">Daftar Guru</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"><a href="{{ route('admin.guru.create') }}" class="btn btn-primary"><i
                        class="bi bi-plus-lg me-1"></i>Tambah Guru</a></div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold">Data Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Mata Pelajaran</th>
                                <th>Jabatan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                                @php
                                    $teacherPhoto = asset('assets_admin/assets/images/avatars/avatar-1.png');
                                    if (!empty($teacher->photo)) {
                                        if (
                                            str_starts_with($teacher->photo, 'storage/') ||
                                            str_starts_with($teacher->photo, 'uploads/')
                                        ) {
                                            $teacherPhoto = asset($teacher->photo);
                                        } elseif (file_exists(public_path($teacher->photo))) {
                                            $teacherPhoto = asset($teacher->photo);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td>{{ $teacher->nip }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $teacher->subject }}</td>
                                    <td>{{ $teacher->position }}</td>
                                    <td><img src="{{ $teacherPhoto }}" alt="{{ $teacher->name }}" width="45"
                                            height="45" class="rounded-circle" style="object-fit: cover;"></td>
                                    <td>
                                        <div class="d-inline-flex gap-1"><a
                                                href="{{ route('admin.guru.show', $teacher->id) }}"
                                                class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a
                                                href="{{ route('admin.guru.edit', $teacher->id) }}"
                                                class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.guru.destroy', $teacher->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data guru ini?')">@csrf
                                                @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i
                                                        class="bi bi-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $teachers->firstItem() ?? 0 }}–{{ $teachers->lastItem() ?? 0 }} dari
                            {{ $teachers->total() }} data
                        </small>
                        {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                        {{ $teachers->withQueryString()->links('vendor.pagination.custom') }}
                    </div>
                </div>
    </main>
@endsection
