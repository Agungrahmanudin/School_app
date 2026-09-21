<!-- Start Sidebar -->

<style>
.textmenu .tab-content {
    padding-top: 0 !important;
    margin-top: 0 !important;
}
.textmenu .list-group-flush {
    margin-top: 0 !important;
}
.textmenu .list-group-item:first-child {
    padding-top: 0.5rem !important;
    margin-top: 0 !important;
    border-top: none !important;
}
.textmenu {
    padding-top: 0.5rem !important;
}
</style>

<aside class="sidebar-wrapper">

    <!-- =====================================================
         ICON SIDEBAR
    ====================================================== -->
    <div class="iconmenu">

        <!-- Tombol Toggle -->
        <div class="nav-toggle-box">
            <div class="nav-toggle-icon">
                <i class="bi bi-list"></i>
            </div>
        </div>

        <ul class="nav nav-pills flex-column">

            <!-- ================= DASHBOARD ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-icon' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                </a>
            </li>


            <!-- ================= PROFIL SEKOLAH ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Profil Sekolah">

                <a href="{{ route('admin.profil.sekolah') }}"
                    class="nav-link {{ request()->routeIs('admin.profilsekolah*') ? 'active-icon' : '' }}">
                    <i class="bi bi-building"></i>
                </a>
            </li>


            <!-- ================= BERITA ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Berita">

                <a href="{{ route('admin.berita') }}"
                    class="nav-link {{ request()->routeIs('admin.berita*') ? 'active-icon' : '' }}">
                    <i class="bi bi-newspaper"></i>
                </a>
            </li>


            <!-- ================= KATEGORI ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Kategori Berita">

                <a href="{{ route('admin.categories') }}"
                    class="nav-link {{ request()->routeIs('admin.categories*') ? 'active-icon' : '' }}">
                    <i class="bi bi-tags-fill"></i>
                </a>
            </li>


            <!-- ================= GALERI ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Galeri">

                <a href="{{ route('admin.galeri') }}"
                    class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active-icon' : '' }}">
                    <i class="bi bi-images"></i>
                </a>
            </li>


            <!-- ================= EKSTRAKURIKULER ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Ekstrakurikuler">

                <a href="{{ route('admin.ekstrakurikuler') }}"
                    class="nav-link {{ request()->routeIs('admin.ekstrakurikuler*') ? 'active-icon' : '' }}">
                    <i class="bi bi-star-fill"></i>
                </a>
            </li>


            <!-- ================= GURU ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Data Guru">

                <a href="{{ route('admin.guru') }}"
                    class="nav-link {{ request()->routeIs('admin.guru*') ? 'active-icon' : '' }}">
                    <i class="bi bi-person-badge-fill"></i>
                </a>
            </li>


            <!-- ================= SISWA ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Data Siswa">

                <a href="{{ route('admin.siswa') }}"
                    class="nav-link {{ request()->routeIs('admin.siswa*') ? 'active-icon' : '' }}">
                    <i class="bi bi-people-fill"></i>
                </a>
            </li>


            <!-- ================= JURUSAN ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Data Jurusan">

                <a href="{{ route('admin.majors') }}"
                    class="nav-link {{ request()->routeIs('admin.majors*') ? 'active-icon' : '' }}">
                    <i class="bi bi-book-fill"></i>
                </a>
            </li>


            <!-- ================= USERS ================= -->
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pengguna">

                <a href="{{ route('admin.users') }}"
                    class="nav-link {{ request()->routeIs('admin.users*') ? 'active-icon' : '' }}">
                    <i class="bi bi-person-circle"></i>
                </a>
            </li>

        </ul>

    </div>


    <!-- =====================================================
         TEXT SIDEBAR
    ====================================================== -->
    <div class="textmenu">

        <div class="tab-content">

            <!-- =================================================
                 IDENTITAS WEBSITE
            ================================================== -->

            <div class="list-group list-group-flush">

                <div class="list-group-item">

                    <h5 class="mb-1">
                        Website Sekolah
                    </h5>

                    <small>
                        Panel Administrasi
                    </small>

                </div>


                <!-- DASHBOARD -->
                <a href="{{ route('admin.dashboard') }}"
                    class="list-group-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill me-2"></i>
                    Dashboard
                </a>

            </div>


            <!-- =================================================
                 KELOLA WEBSITE
            ================================================== -->

            <div class="list-group list-group-flush mt-2">

                <div class="list-group-item">
                    <h5 class="mb-1">Kelola Website</h5>
                    <small>Data website sekolah</small>
                </div>


                <!-- PROFIL SEKOLAH -->
                <a href="{{ route('admin.profil.sekolah') }}"
                    class="list-group-item {{ request()->routeIs('admin.profil.sekolah*') ? 'active' : '' }}">
                    <i class="bi bi-building me-2"></i>
                    Profil Sekolah
                </a>


                <!-- BERITA -->
                <a href="{{ route('admin.berita') }}"
                    class="list-group-item {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper me-2"></i>
                    Berita
                </a>


                <!-- KATEGORI -->
                <a href="{{ route('admin.categories') }}"
                    class="list-group-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="bi bi-tags-fill me-2"></i>
                    Kategori Berita
                </a>


                <!-- GALERI -->
                <a href="{{ route('admin.galeri') }}"
                    class="list-group-item {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                    <i class="bi bi-images me-2"></i>
                    Galeri
                </a>


                <!-- EKSTRAKURIKULER -->
                <a href="{{ route('admin.ekstrakurikuler') }}"
                    class="list-group-item {{ request()->routeIs('admin.ekstrakurikuler*') ? 'active' : '' }}">
                    <i class="bi bi-star-fill me-2"></i>
                    Ekstrakurikuler
                </a>


                <!-- GURU -->
                <a href="{{ route('admin.guru') }}"
                    class="list-group-item {{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Data Guru
                </a>


                <!-- SISWA -->
                <a href="{{ route('admin.siswa') }}"
                    class="list-group-item {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill me-2"></i>
                    Data Siswa
                </a>

                <!-- JURUSAN -->
                <a href="{{ route('admin.majors') }}"
                    class="list-group-item {{ request()->routeIs('admin.majors*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill me-2"></i>
                    Data Jurusan
                </a>

            </div>


            <!-- =================================================
                 PENGATURAN
            ================================================== -->

            <div class="list-group list-group-flush mt-3">

                <div class="list-group-item">
                    <h5 class="mb-1">Pengaturan</h5>
                    <small>Pengelolaan sistem</small>
                </div>


                <!-- USERS -->
                <a href="{{ route('admin.users') }}"
                    class="list-group-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="bi bi-person-circle me-2"></i>
                    Pengguna / Admin
                </a>

            </div>

        </div>

    </div>

</aside>

<!-- End Sidebar -->
