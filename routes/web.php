<?php

use App\Http\Controllers\Admin\MajorsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtracurricularsController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\auth\AuthenticationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//landing
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profilsekolah', [HomeController::class, 'profile'])->name('landing.profile');
Route::get('/ekstrakurikuler', [HomeController::class, 'extracurriculars'])->name('landing.extracurriculars');
Route::get('/ekstrakurikuler/{id}', [HomeController::class, 'extracurricularDetail'])->name('landing.extracurriculars.detail');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('landing.gallery');
Route::get('/galeri/{id}', [HomeController::class, 'galleryShow'])->name('landing.gallery.show');
Route::get('/berita-kegiatan', [HomeController::class, 'news'])->name('landing.news');
Route::get('/berita-kegiatan/{slug}', [HomeController::class, 'newsDetail'])->name('landing.news.detail');
Route::get('/jurusan', [HomeController::class, 'majors'])->name('landing.majors');
Route::get('/jurusan/{id}', [HomeController::class, 'majorDetail'])->name('landing.majors.detail');

// Authentication
Route::middleware('guest')->get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::middleware('guest')->get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'submitLogin'])->name('login.submit');
Route::post('/register', [AuthenticationController::class, 'submitRegister'])->name('register.submit');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->prefix('/admin/panel')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::get('users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('users/{id}', [UsersController::class, 'show'])->name('admin.users.show');
    Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // Categories
    Route::get('categories', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::get('categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{id}', [CategoriesController::class, 'show'])->name('admin.categories.show');
    Route::get('categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    // News & Media Management
    Route::get('berita', [NewsController::class, 'index'])->name('admin.berita');
    Route::get('berita/create', [NewsController::class, 'create'])->name('admin.berita.create');
    Route::post('berita', [NewsController::class, 'store'])->name('admin.berita.store');
    Route::get('berita/{id}', [NewsController::class, 'show'])->name('admin.berita.show');
    Route::get('berita/{id}/edit', [NewsController::class, 'edit'])->name('admin.berita.edit');
    Route::put('berita/{id}', [NewsController::class, 'update'])->name('admin.berita.update');
    Route::delete('berita/{id}', [NewsController::class, 'destroy'])->name('admin.berita.destroy');

    // School Profile Management
    Route::get('profilsekolah', [SchoolProfileController::class, 'index'])->name('admin.profil.sekolah');
    Route::post('profilsekolah', [SchoolProfileController::class, 'update'])->name('admin.profil.sekolah.update');

    // Students
    Route::get('siswa', [StudentsController::class, 'index'])->name('admin.siswa');
    Route::get('siswa/create', [StudentsController::class, 'create'])->name('admin.siswa.create');
    Route::post('siswa', [StudentsController::class, 'store'])->name('admin.siswa.store');
    Route::get('siswa/{id}', [StudentsController::class, 'show'])->name('admin.siswa.show');
    Route::get('siswa/{id}/edit', [StudentsController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('siswa/{id}', [StudentsController::class, 'update'])->name('admin.siswa.update');
    Route::delete('siswa/{id}', [StudentsController::class, 'destroy'])->name('admin.siswa.destroy');

    // Teachers
    Route::get('guru', [TeachersController::class, 'index'])->name('admin.guru');
    Route::get('guru/create', [TeachersController::class, 'create'])->name('admin.guru.create');
    Route::post('guru', [TeachersController::class, 'store'])->name('admin.guru.store');
    Route::get('guru/{id}', [TeachersController::class, 'show'])->name('admin.guru.show');
    Route::get('guru/{id}/edit', [TeachersController::class, 'edit'])->name('admin.guru.edit');
    Route::put('guru/{id}', [TeachersController::class, 'update'])->name('admin.guru.update');
    Route::delete('guru/{id}', [TeachersController::class, 'destroy'])->name('admin.guru.destroy');

    // Extracurriculars
    Route::get('ekstrakurikuler', [ExtracurricularsController::class, 'index'])->name('admin.ekstrakurikuler');
    Route::get('ekstrakurikuler/create', [ExtracurricularsController::class, 'create'])->name('admin.ekstrakurikuler.create');
    Route::post('ekstrakurikuler', [ExtracurricularsController::class, 'store'])->name('admin.ekstrakurikuler.store');
    Route::get('ekstrakurikuler/{id}', [ExtracurricularsController::class, 'show'])->name('admin.ekstrakurikuler.show');
    Route::get('ekstrakurikuler/{id}/edit', [ExtracurricularsController::class, 'edit'])->name('admin.ekstrakurikuler.edit');
    Route::put('ekstrakurikuler/{id}', [ExtracurricularsController::class, 'update'])->name('admin.ekstrakurikuler.update');
    Route::delete('ekstrakurikuler/{id}', [ExtracurricularsController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');

    // Galleries
    Route::get('galeri', [GalleriesController::class, 'index'])->name('admin.galeri');
    Route::get('galeri/create', [GalleriesController::class, 'create'])->name('admin.galeri.create');
    Route::post('galeri', [GalleriesController::class, 'store'])->name('admin.galeri.store');
    Route::get('galeri/{id}', [GalleriesController::class, 'show'])->name('admin.galeri.show');
    Route::get('galeri/{id}/edit', [GalleriesController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('galeri/{id}', [GalleriesController::class, 'update'])->name('admin.galeri.update');
    Route::delete('galeri/{id}', [GalleriesController::class, 'destroy'])->name('admin.galeri.destroy');

    // Majors
    Route::get('majors', [MajorsController::class, 'index'])->name('admin.majors');
    Route::get('majors/create', [MajorsController::class, 'create'])->name('admin.majors.create');
    Route::post('majors', [MajorsController::class, 'store'])->name('admin.majors.store');
    Route::get('majors/{id}', [MajorsController::class, 'show'])->name('admin.majors.show');
    Route::get('majors/{id}/edit', [MajorsController::class, 'edit'])->name('admin.majors.edit');
    Route::put('majors/{id}', [MajorsController::class, 'update'])->name('admin.majors.update');
    Route::delete('majors/{id}', [MajorsController::class, 'destroy'])->name('admin.majors.destroy');
});