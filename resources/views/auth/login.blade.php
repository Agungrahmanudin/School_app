@extends('layout.master')
@section('content')
    <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets_admin/assets/images/error/login-img.jpg') }}" class="img-fluid"
                                alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Sign In</h5>
                                <p class="card-text mb-5">Halaman Login Smkn 1 Talaga</p>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @php
                                    $secondsRemaining = session('lockout_seconds') ?? ($lockoutSeconds ?? 0);
                                @endphp

                                <div id="lockout-alert" class="alert alert-danger {{ $secondsRemaining > 0 ? '' : 'd-none' }}" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-lock-fill fs-4 me-2"></i>
                                        <div>
                                            <strong>Akses Login Anda Di kunci</strong><br>
                                            <span id="lockout-message">Salah memasukkan email/password 3 kali. Tombol login dinonaktifkan selama <span id="countdown-text" class="fw-bold">{{ $secondsRemaining }}</span> detik.</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->any() && $secondsRemaining <= 0)
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form-body" method="POST" action="{{ route('login.submit') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                        class="bi bi-envelope-fill"></i></div>
                                                <input type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                    id="inputEmailAddress" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                                    required>
                                            </div>
                                            @error('email')
                                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                        class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                                    id="inputChoosePassword" name="password" placeholder="Enter Password"
                                                    required>
                                            </div>
                                            @error('password')
                                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" id="btn-login" class="btn btn-primary radius-30" {{ $secondsRemaining > 0 ? 'disabled' : '' }}>
                                                    <span id="btn-login-text">{{ $secondsRemaining > 0 ? "Terkunci ({$secondsRemaining}s)" : 'Sign In' }}</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0">Don't have an account yet? <a
                                                    href="{{ route('register') }}">Sign up here</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let seconds = {{ $secondsRemaining }};
            const loginBtn = document.getElementById('btn-login');
            const loginBtnText = document.getElementById('btn-login-text');
            const lockoutAlert = document.getElementById('lockout-alert');
            const countdownText = document.getElementById('countdown-text');
            const form = document.querySelector('form.form-body');

            if (form) {
                form.addEventListener('submit', function (e) {
                    if (loginBtn && loginBtn.disabled) {
                        e.preventDefault();
                        return false;
                    }
                });
            }

            if (seconds > 0 && loginBtn) {
                loginBtn.disabled = true;

                const timer = setInterval(function () {
                    seconds--;

                    if (countdownText) {
                        countdownText.innerText = seconds;
                    }

                    if (loginBtnText) {
                        loginBtnText.innerText = `Terkunci (${seconds}s)`;
                    }

                    if (seconds <= 0) {
                        clearInterval(timer);
                        loginBtn.disabled = false;
                        if (loginBtnText) {
                            loginBtnText.innerText = 'Sign In';
                        }
                        if (lockoutAlert) {
                            lockoutAlert.className = 'alert alert-success';
                            lockoutAlert.innerHTML = '<div class="d-flex align-items-center"><i class="bi bi-check-circle-fill fs-4 me-2"></i><div><strong>Waktu tunggu selesai!</strong><br>Silakan coba login kembali.</div></div>';
                        }
                    }
                }, 1000);
            }
        });
    </script>
@endsection
