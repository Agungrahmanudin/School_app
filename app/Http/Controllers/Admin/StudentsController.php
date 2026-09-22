<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentsController extends Controller
{
    /* =========================================================
     |  CRUD
     ========================================================= */

    public function index()
    {
        $students = Students::oldest()->paginate(10);

        return view('Admin.Students.index', compact('students'));
    }

    public function create()
    {
        return view('Admin.Students.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateStudent($request, true);
        $validated['photo'] = $this->storePhoto($request);

        Students::create($validated);

        return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $student = Students::findOrFail($id);

        return view('Admin.Students.show', [
            'title'     => 'Detail Siswa',
            'backRoute' => 'admin.siswa',
            'fields'    => [
                'NIS'           => $student->nis,
                'Nama'          => $student->name,
                'Jenis Kelamin' => $student->gender === 'L' ? 'Laki-laki' : 'Perempuan',
                'Kelas'         => $student->class,
                'Jurusan'       => $student->major,
                'Foto'          => $student->photo,
            ],
        ]);
    }

    public function edit($id)
    {
        $student = Students::findOrFail($id);
        return view('Admin.Students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Students::findOrFail($id);
        $validated = $this->validateStudent($request, false);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storePhoto($request);
        }

        $student->update($validated);

        return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Students::findOrFail($id)->delete();

        return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    /* =========================================================
     |  Helper
     ========================================================= */

    /**
     * Validasi data siswa.
     */
    private function validateStudent(Request $request, bool $requiredPhoto): array
    {
        return $request->validate([
            'nis'    => 'required|string|max:30',
            'name'   => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'class'  => 'required|string|max:255',
            'major'  => 'required|string|max:255',
            'photo'  => ($requiredPhoto ? 'required|' : 'nullable|')
                . 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
    }

    /**
     * Simpan file foto ke public/uploads/students.
     */
    private function storePhoto(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads/students'));

        $file = $request->file('photo');
        $name = 'student_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/students'), $name);

        return 'uploads/students/' . $name;
    }
}
