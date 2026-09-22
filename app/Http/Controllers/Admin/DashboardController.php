<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurriculars;
use App\Models\Majors;
use App\Models\Teachers;
use App\Models\Students;
use App\Models\News;
use App\Models\Categories;
use App\Models\Galleries;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents   = Students::count();
        $totalTeachers   = Teachers::count();
        $totalExtra      = Extracurriculars::count();
        $majors          = Majors::count();
        $totalNews       = News::count();
        $totalCategories = Categories::count();
        $totalGalleries  = Galleries::count();
        $totalUsers      = User::count();

        return view('Admin.index', compact(
            'totalTeachers',
            'totalStudents',
            'totalExtra',
            'majors',
            'totalNews',
            'totalCategories',
            'totalGalleries',
            'totalUsers',
        ));
    }
}