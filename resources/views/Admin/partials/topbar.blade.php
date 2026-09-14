<header class="top-header">
    <nav class="navbar navbar-expand">
        {{-- Mobile menu toggle (kiri) --}}
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
        </div>

        {{-- Search icon (mobile) --}}
        <div class="search-toggle-icon d-xl-none">
            <i class="bi bi-search"></i>
        </div>

        {{-- User dropdown — DORONG KE KANAN pakai ms-auto --}}
        <div class="top-navbar-right ms-auto">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-1">
                            <img src="{{ asset('assets_admin/assets/images/avatars/avatar-1.png') }}" class="user-img"
                                alt="">
                            <div class="user-name d-none d-sm-block">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets_admin/assets/images/avatars/avatar-1.png') }}"
                                        alt="" class="rounded-circle" width="60" height="60">
                                    <div class="ms-3">
                                        <h6 class="mb-0 dropdown-user-name">{{ Auth::user()->name ?? 'Admin' }}</h6>
                                        <small
                                            class="mb-0 dropdown-user-designation text-secondary">{{ Auth::user()->email ?? 'admin@sekolah.sch.id' }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}" target="_blank">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-globe"></i></div>
                                    <div class="setting-text ms-3"><span>Lihat Website</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                                    <div class="setting-text ms-3"><span>Dashboard</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="admin-logout-form" >
                                @csrf
                                <button type="submit"
                                    class="dropdown-item d-flex align-items-center w-100 text-danger border-0 bg-transparent py-2">
                                    <div class="setting-icon text-danger"><i class="bi bi-box-arrow-right"></i></div>
                                    <div class="setting-text ms-3 fw-bold"><span >Keluar / Logout</span></div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
