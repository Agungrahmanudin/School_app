@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Siswa</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active">Daftar Siswa</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Siswa
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
                <h6 class="mb-0 fw-bold">Data Siswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th width="60" class="text-center">Foto</th>
                                <th width="110" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                @php
                                    $defaultAvatar = asset('assets_admin/assets/images/avatars/avatar-1.png');
                                    $studentPhoto = $defaultAvatar;
                                    if (!empty($student->photo)) {
                                        $candidate = public_path($student->photo);
                                        if (file_exists($candidate)) {
                                            $studentPhoto = asset($student->photo);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $students->firstItem() + $index }}</td>
                                    <td>{{ $student->nis }}</td>
                                    <td class="fw-semibold">{{ $student->name }}</td>
                                    <td>{{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $student->class }}</td>
                                    <td>{{ $student->major }}</td>
                                    <td class="text-center">
                                        <img src="{{ $studentPhoto }}" alt="{{ $student->name }}" width="40"
                                            height="40"
                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb; display: inline-block;"
                                            onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';">
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.siswa.show', $student->id) }}"
                                                class="btn btn-sm btn-outline-info"
                                                style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                                title="Lihat">
                                                <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <a href="{{ route('admin.siswa.edit', $student->id) }}"
                                                class="btn btn-sm btn-outline-warning"
                                                style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                                title="Edit">
                                                <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data siswa ini?')"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                    style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                                    title="Hapus">
                                                    <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $students->firstItem() ?? 0 }}–{{ $students->lastItem() ?? 0 }} dari
                        {{ $students->total() }} data
                    </small>
                    {{ $students->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
@endsection
