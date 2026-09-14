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
        ));
    }

    public function profile()
    {
        $profile = School_profiles::first();
        $totalTeachers = Teachers::count();
        $totalStudents = Students::count();
        $totalExtra = Extracurriculars::count();
        $teachers = Teachers::latest()->get();
        return view('landing.profile', compact('profile', 'totalTeachers', 'totalStudents', 'totalExtra', 'teachers'));
    }

    public function extracurriculars()
    {
        $profile = School_profiles::first();
        $extracurriculars = Extracurriculars::latest()->get();
        return view('landing.extracurriculars', compact('profile', 'extracurriculars'));
    }

    public function extracurricularDetail($id)
    {
        $profile = School_profiles::first();
        $extracurricular = Extracurriculars::findOrFail($id);
        $otherExtras = Extracurriculars::where('id', '!=', $id)->get();
        return view('landing.extracurricular_detail', compact('profile', 'extracurricular', 'otherExtras'));
    }

    public function gallery()
    {
        $profile = School_profiles::first();
        $galleries = Galleries::latest()->get();
        return view('landing.gallery', compact('profile', 'galleries'));
    }

    public function news()
    {
        $profile = School_profiles::first();
        $news = News::with('category')->latest()->paginate(6);
        return view('landing.news', compact('profile', 'news'));
    }

    public function newsDetail($slug)
    {
        $profile = School_profiles::first();
        $article = News::with('category')->where('slug', $slug)->firstOrFail();
        $recentNews = News::where('id', '!=', $article->id)->latest()->take(4)->get();
        return view('landing.news_detail', compact('profile', 'article', 'recentNews'));
    }

    public function majors()
    {
        $profile = School_profiles::first();
        $majors = Majors::latest()->get();
        return view('landing.majors', compact('profile', 'majors'));
    }

    public function majorDetail($id)
    {
        $profile = School_profiles::first();
        $major = Majors::findOrFail($id);
        $otherMajors = Majors::where('id', '!=', $id)->get();
        return view('landing.major_detail', compact('profile', 'major', 'otherMajors'));
    }
}
