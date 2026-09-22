<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeachersController extends Controller
{
    /* =========================================================
     |  CRUD
     ========================================================= */

    public function index()
    {
        $teachers = Teachers::oldest()->paginate(10);
        return view('Admin.Teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('Admin.Teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateTeacher($request, true);
        $validated['photo'] = $this->storePhoto($request);

        Teachers::create($validated);

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function show($id)
    {
        $teacher = Teachers::findOrFail($id);

        return view('Admin.Teachers.show', [
            'title'     => 'Detail Guru',
            'backRoute' => 'admin.guru',
            'fields'    => [
                'NIP'            => $teacher->nip,
                'Nama'           => $teacher->name,
                'Jenis Kelamin'  => $teacher->gender === 'L' ? 'Laki-laki' : 'Perempuan',
                'Mata Pelajaran' => $teacher->subject,
                'Jabatan'        => $teacher->position,
                'Foto'           => $teacher->photo,
            ],
        ]);
    }

    public function edit($id)
    {
        $teacher = Teachers::findOrFail($id);
        return view('Admin.Teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teachers::findOrFail($id);
        $validated = $this->validateTeacher($request, false);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storePhoto($request);
        }

        $teacher->update($validated);

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Teachers::findOrFail($id)->delete();

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil dihapus.');
    }

    /* =========================================================
     |  Helper
     ========================================================= */

    /**
     * Validasi data guru.
     */
    private function validateTeacher(Request $request, bool $requiredPhoto): array
    {
        return $request->validate([
            'nip'      => 'required|string|max:30',
            'name'     => 'required|string|max:100',
            'gender'   => 'required|in:L,P',
            'subject'  => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo'    => ($requiredPhoto ? 'required|' : 'nullable|') . 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
    }

    /**
     * Simpan file foto ke public/uploads/teachers.
     */
    private function storePhoto(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads/teachers'));

        $file = $request->file('photo');
        $name = 'teacher_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/teachers'), $name);

        return 'uploads/teachers/' . $name;
    }
}