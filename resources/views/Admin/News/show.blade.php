@extends('Admin.layout.app')
@section('content')
    <main class="page-content">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ $title }}</h6>
            </div>
            <div class="card-body">
                <dl class="row">
                    @foreach ($fields as $label => $value)
                        <dt class="col-sm-3">{{ $label }}</dt>
                        <dd class="col-sm-9" style="white-space: pre-line;">{{ $value ?: '-' }}</dd>
                    @endforeach
                </dl><a href="{{ route($backRoute) }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </main>
@endsection
