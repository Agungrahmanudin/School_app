<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MajorsController extends Controller
{
    public function index()
    {
        $majors = Majors::latest()->paginate(10);

        return view('admin.Majors.index', compact('majors'));
    }
    public function create()
    {
        $teachers = Teachers::orderBy('name')->get();
        return view('Admin.Majors.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMajor($request, true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        Majors::create($validated);

        return redirect()->route('admin.majors')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $major = Majors::findOrFail($id);

        return view('Admin.Majors.show', [
            'title' => 'Detail Jurusan',
            'backRoute' => 'admin.majors',
            'fields' => [
                'Nama Jurusan' => $major->name,
                'Kode' => $major->code,
                'Kepala Program Keahlian (Kaprog)' => $major->kaprog,
                'Deskripsi' => $major->description,
                'Konsentrasi Keahlian' => $major->concentrations,
                'Gambar' => $major->image,
            ],
        ]);
    }

    public function edit($id)
    {
        $major = Majors::findOrFail($id);
        $teachers = Teachers::orderBy('name')->get();
        return view('admin.majors.edit', compact('major', 'teachers'));
    }
    public function update(Request $request, $id)
    {
        $major = Majors::findOrFail($id);
        $validated = $this->validateMajor($request, false);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        $major->update($validated);

        return redirect()->route('admin.majors')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Majors::findOrFail($id)->delete();

        return redirect()->route('admin.majors')->with('success', 'Jurusan berhasil dihapus.');
    }

    private function validateMajor(Request $request, bool $requiredImage): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:majors,code,' . ($request->route('id') ?? 'NULL'),
            'kaprog' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'concentrations' => 'nullable|string',
            'image' => ($requiredImage ? 'nullable|' : 'nullable|') . 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
    }

    private function storeImage(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads/majors'));

        $file = $request->file('image');
        $name = 'major_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/majors'), $name);

        return 'uploads/majors/' . $name;
    }
}
