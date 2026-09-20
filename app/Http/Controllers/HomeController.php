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
        $profile = School_profiles::first();
        $totalTeachers = Teachers::count();
        $totalStudents = Students::count();
        $totalExtra = Extracurriculars::count();
        $totalGalleries = Galleries::count();
        $majors = Majors::all();
        
        $news = News::with('category')->latest()->take(3)->get();
        $galleries = Galleries::latest()->take(3)->get();
        $extracurriculars = Extracurriculars::latest()->get();
        $teachers = Teachers::take(4)->get();
        
        // Ambil data kepala sekolah dari tabel teachers berdasarkan position
        $principal = Teachers::where('position', 'LIKE', '%Kepala Sekolah%')
            ->orWhere('position', 'LIKE', '%kepala sekolah%')
            ->orWhere('position', 'LIKE', '%Kepsek%')
            ->first();

        return view('landing.index', compact(
            'profile',
            'totalTeachers',
            'totalStudents',
            'totalExtra',
            'totalGalleries',
            'news',
            'galleries',
            'extracurriculars',
            'teachers',
            'majors',
            'principal',
        ));
    }

    public function profile()
    {
        $profile = School_profiles::first();
        $totalTeachers = Teachers::count();
        $totalStudents = Students::count();
        $totalExtra = Extracurriculars::count();
        $teachers = Teachers::latest()->get();
        
        // Ambil data kepala sekolah dari tabel teachers
        $principal = Teachers::where('position', 'LIKE', '%Kepala Sekolah%')
            ->orWhere('position', 'LIKE', '%kepala sekolah%')
            ->orWhere('position', 'LIKE', '%Kepsek%')
            ->first();
            
        return view('landing.profile.index', compact('profile', 'totalTeachers', 'totalStudents', 'totalExtra', 'teachers', 'principal'));
    }

    public function extracurriculars()
    {
        $profile = School_profiles::first();
        $extracurriculars = Extracurriculars::latest()->get();
        return view('landing.extracurriculars.index', compact('profile', 'extracurriculars'));
    }

    public function extracurricularDetail($id)
    {
        $profile = School_profiles::first();
        $extracurricular = Extracurriculars::findOrFail($id);
        $otherExtras = Extracurriculars::where('id', '!=', $id)->get();
        return view('landing.extracurriculars.show', compact('profile', 'extracurricular', 'otherExtras'));
    }

    public function gallery()
    {
        $profile = School_profiles::first();
        $galleries = Galleries::latest()->get();
        return view('landing.gallery.index', compact('profile', 'galleries'));
    }

    public function galleryShow($id)
    {
        $profile = School_profiles::first();
        $gallery = Galleries::findOrFail($id);
        $otherGalleries = Galleries::where('id', '!=', $id)->latest()->take(6)->get();
        return view('landing.gallery.show', compact('profile', 'gallery', 'otherGalleries'));
    }

    public function news()
    {
        $profile = School_profiles::first();
        $news = News::with('category')->latest()->paginate(6);
        return view('landing.news.index', compact('profile', 'news'));
    }

    public function newsDetail($slug)
    {
        $profile = School_profiles::first();
        $article = News::with('category')->where('slug', $slug)->firstOrFail();
        $recentNews = News::where('id', '!=', $article->id)->latest()->take(4)->get();
        return view('landing.news.show', compact('profile', 'article', 'recentNews'));
    }

    public function majors()
    {
        $profile = School_profiles::first();
        $majors = Majors::latest()->get();
        return view('landing.majors.index', compact('profile', 'majors'));
    }

    public function majorDetail($id)
    {
        $profile = School_profiles::first();
        $major = Majors::findOrFail($id);
        $otherMajors = Majors::where('id', '!=', $id)->get();
        return view('landing.majors.show', compact('profile', 'major', 'otherMajors'));
    }
}
