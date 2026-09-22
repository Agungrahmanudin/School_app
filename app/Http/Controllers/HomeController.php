<?php

namespace App\Http\Controllers;

use App\Models\Extracurriculars;
use App\Models\Galleries;
use App\Models\News;
use App\Models\Majors;
use App\Models\School_profiles;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalTeachers = Teachers::count();
        $totalStudents = Students::count();
        $totalExtra = Extracurriculars::count();
        $totalGalleries = Galleries::count();
        $majors = Majors::get();

        $news = News::with('category')->latest()->take(3)->get();
        $galleries = Galleries::latest()->take(3)->get();
        $extracurriculars = Extracurriculars::latest()->get();
        $teachers = Teachers::take(4)->get();

        $principal = Teachers::where('position', 'LIKE', '%Kepala Sekolah%')
            ->orWhere('position', 'LIKE', '%Kepsek%')
            ->first();

        return view('landing.index', compact(
            'totalTeachers',
            'totalStudents',
            'totalExtra',
            'totalGalleries',
            'news',
            'galleries',
            'extracurriculars',
            'teachers',
            'majors',
            'principal'
        ));
    }

    // HANYA halaman Profil Sekolah yang menggunakan School_profiles
    public function profile()
    {
        $profile = School_profiles::first();

        $totalTeachers = Teachers::count();
        $totalStudents = Students::count();
        $totalExtra = Extracurriculars::count();
        $teachers = Teachers::latest()->paginate(6);

        $principal = Teachers::where('position', 'LIKE', '%Kepala Sekolah%')
            ->orWhere('position', 'LIKE', '%Kepsek%')
            ->first();

        return view('landing.profile.index', compact(
            'profile',
            'totalTeachers',
            'totalStudents',
            'totalExtra',
            'teachers',
            'principal'
        ));
    }

    public function extracurriculars()
    {
        $extracurriculars = Extracurriculars::latest()->paginate(6);

        return view(
            'landing.extracurriculars.index',
            compact('extracurriculars')
        );
    }

    public function extracurricularDetail($id)
    {
        $extracurricular = Extracurriculars::findOrFail($id);

        $otherExtras = Extracurriculars::where('id', '!=', $id)
            ->latest()
            ->get();

        return view(
            'landing.extracurriculars.show',
            compact('extracurricular', 'otherExtras')
        );
    }

    public function gallery()
    {
        $galleries = Galleries::latest()->paginate(6);

        return view(
            'landing.gallery.index',
            compact('galleries')
        );
    }

    public function galleryShow($id)
    {
        $gallery = Galleries::findOrFail($id);

        $otherGalleries = Galleries::where('id', '!=', $id)
            ->latest()
            ->take(6)
            ->get();

        return view(
            'landing.gallery.show',
            compact('gallery', 'otherGalleries')
        );
    }

    public function news()
    {
        $news = News::with('category')
            ->latest()
            ->paginate(6);

        return view('landing.news.index', compact('news'));
    }

    public function newsDetail($slug)
    {
        $article = News::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $recentNews = News::where('id', '!=', $article->id)
            ->latest()
            ->take(6)
            ->get();

        return view(
            'landing.news.show',
            compact('article', 'recentNews')
        );
    }

    public function majors()
    {
        $majors = Majors::latest()->paginate(6);

        return view(
            'landing.majors.index',
            compact('majors')
        );
    }

    public function majorDetail($id)
    {
        $major = Majors::findOrFail($id);

        $otherMajors = Majors::where('id', '!=', $id)
            ->latest()
            ->get();

        return view(
            'landing.majors.show',
            compact('major', 'otherMajors')
        );
    }
}