<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurriculars;
use App\Models\Majors;
use App\Models\Teachers;
use App\Models\Students;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Students::count();
        $totalTeachers = Teachers::count();
        $totalExtra = Extracurriculars::count();
        $majors     = Majors::count();
        return view('Admin.index', compact(
            'totalTeachers',
            'totalStudents',
            'totalExtra',
            'majors',
        ));
    }
}