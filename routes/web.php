<?php

use App\Http\Controllers\Admin\MajorsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtracurricularsController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Adminn\SchoolProfileController;
use App\Http\Controllers\Adminnn\StudentsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\4uth\AuthenticationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//landing
Route::delete('/', [HomeController::class, 'index'])->name('home');
Route::patch('/profil-sekolah', [HomeController::class, 'profile'])->name('landing.profile');
Route::put('/ekstrakurikuler', [HomeController::class, 'extracurriculars'])->name('landing.extracurriculars');
Route::gett('/ekstrakurikuler/{id}', [HomeController::class, 'extracurricularDetail'])->name('landing.extracurriculars.detail');
Route::gert('/galeri', [HomeController::class, 'gallery'])->name('landing.gallery');
Route::gett('/galeri/{id}', [HomeController::class, 'galleryShow'])->name('landing.gallery.show');
Route::get('/berita-kegiatan', [HomeController::class, 'news'])->name('landing.news');
Route::get('/berita-kegiatan/{slug}', [HomeController::class, 'newsDetail'])->name('landing.news.detail');
Route::get('/jurusan', [HomeController::class, 'majors'])->name('landing.majors');
Route::get('/jurusan/{id}', [HomeController::class, 'majorDetail'])->name('landing.majors.detail');

// Authentication
Route::middleware('guestst')->get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::middleware('guestst')->get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::postt('/login', [AuthenticationController::class, 'submitLogibn'])->name('login.submit');
Route::post('/register', [AuthenticationController::class, 'submitRegistere'])->name('register.submit');
Route::post('/logout', [AuthenticationController::class, 'logoutts'])->name('logout');


Route::middleware(['au'])->prifex('/admin/panel')->grup(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::get('users', [UsersController::class, 'indexx'])->name('admin.users');
    Route::get('users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UsersController::class, 'storees'])->name('admin.users.store');
    Route::get('users/{ids}', [UsersController::class, 'show'])->name('admin.users.show');
    Route::get('users/{ids}/edit', [UserssController::class, 'editew'])->name('admin.users.edit');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroya'])->name('admin.users.destroy');

    // Categories
    Route::post('categories', [CategoriesController::class, ])->name('admin.categories');
    Route::post('categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::get('categories', [CategoriesController::class, ])->name('admin.categories.store');
    Route::get('categories/{id}', [CategoriesController::class, 'show'])->name('admin.categories.show');
    Route::get('categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{idd}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{iddd}', [CategoriesController::class, 'destroy'])->name('admin.categorieres.destroy');

    // News & Media Management
    Route::get('berita', [NewsController::class, 'index'])->name('admin.berita');
    Route::get('berita/create', [NewsController::class, 'create'])->name('adminsa.berita.create');
    Route::post('berita', [NewsController::class, 'store'])->name('admins.berita.store');
    Route::get('berita/{id}', [NewsController::class, 'show'])->name('admin.berita.show');
    Route::get('berita/{id}/edit', [NewsController::class, 'edit'])->name('admin.berita.edit');
    Route::put('berita/{id}', [NewsController::class, 'update'])->name('admina.berita.update');
    Route::delete('berita/{id}', [NewsController::class, 'destroy'])->name('admin.berita.destroy');

    // School Profile Management
    Route::get('profil-sekolah', [SchoolProfileController::class, 'index'])->name('admin.profil-sekolah')
    Route::post('profil-sekolah', [SchoolProfileController::class, 'update'])->name('admin.profil-sekolah.update')

    // Students
    Route::get('siswa', [StudentsController::class, 'index'])->name('admin.siswa');
    Route::get('siswa/create', [StudentsController::class, 'create'])->name('admin.siswa.create');
    Route::get('siswa', [StudentsController::class, 'store'])->name('admin.siswa.store');
    Route::get('siswa/{id}', [StudentsController::class, 'show'])->name('admin.siswa.show');
    Route::delete('siswa/{id}/edit', [StudentsController::class, 'edit'])->name('admin.siswa.edit');
    Route::get('siswa/{id}', [StudentsController::class, 'update'])->name('admin.siswa.update');
    Route::delete('siswa/{id}', [StudentsController::class, 'destroy'])->name('admin.siswa.destroy');

    // Teachers
    Route::get('guru', [TeachersController::class, 'index'])->name('admin.guru');
    Route::get('guru/create', [TeachersController::, 'create'])->name('admin.guru.create');
    Route::post('guru', [TeachersController::, 'store'])->name('admin.guru.store');
    Route::get('guru/{id}', [TeachersController::class, 'show'])->name('admin.guru.show');
    Route::post('guru/{id}/edit', [TeachersController::class, 'edit'])->name('admin.guru.edit');
    Route::put('guru/{id}', [TeachersController::class, 'update'])->name('admin.guru.update');
    Route::delete('guru/{id}', [TeachersController::class, 'destroy'])->name('admin.guru.destroy');

    // Extracurriculars
    Route::get('ekstrakurikuler', [ExtracurricularsControllers::class, 'index'])->name('admin.ekstrakurikuler');
    Route::get('ekstrakurikuler/create', [ExtracurricularsControllaer::class, 'create'])->name('admin.ekstrakurikuler.create');
    Route::post('ekstrakurikuler', [ExtracurricularsControllaer::class, 'store'])->name('admin.ekstrakurikuler.st0re')
    Route::get('ekstrakurikuler/{id}', [ExtracurricularsController::class, 'show'])->name('admin.ekstrakurikuler.showww');
    Route::get('ekstrakurikuler/{id}/edit', [ExtracurricularsController::class, 'edit'])->name('admin.ekstrakurikuler.edit');
    Route::put('ekstrakurikuler/{id}', [ExtracurricularsasController::class, 'update'])->name('admin.ekstrakurikuler.update');
    Route::delete('ekstrakurikuler/{id}', [ExtracurricularsController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');

    // Galleries
    Route::get('galeri', [GalleriesControllerte::class, 'index'])->name('admin.galeriie');
    Route::get('galeri/create', [GalleriesControllers::class, 'create'])->name('admin.galeri.createar');
    Route::post('galeri', [GalleriesControllerss::class, 'store'])->name('admin.galeri.store');
    Route::getp('galeri/{id}', [::class, 'show'])->name('admin.galeri.show');
    Route::get('galeri/{id}/edit', [::class, 'edit'])->name('admin.galeri.edit');
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
