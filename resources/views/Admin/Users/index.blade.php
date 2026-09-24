@extends('Admin.layout.app')

@section('content')
    <main class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Pengguna</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active">Daftar Pengguna</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"><a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                        class="bi bi-plus-lg me-1"></i>Tambah Pengguna</a></div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold">Data Pengguna / Admin</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span
                                            class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">{{ ucfirst($user->role) }}</span>
                                    </td>
                                    <td>{{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1"><a
                                                href="{{ route('admin.users.show', $user->id) }}"
                                                class="btn btn-sm btn-outline-info" title="Lihat"><i
                                                    class="bi bi-eye"></i></a><a
                                                href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit"><i
                                                    class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus pengguna ini?')">@csrf
                                                @method('DELETE')<button class="btn btn-sm btn-outline-danger"
                                                    title="Hapus"><i class="bi bi-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
               <div class="mt-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} dari
                        {{ $users->total() }} data
                    </small>
                    {{-- withQueryString() agar filter tetap ada saat pindah halaman --}}
                    {{ $users->withQueryString()->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
@endsection
