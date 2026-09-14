<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurriculars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExtracurricularsController extends Controller
{
    /* =========================================================
     |  CRUD
     ========================================================= */

    public function index()
    {
        $extracurriculars = Extracurriculars::oldest()->paginate(10);
        return view('Admin.Extracurriculars.index', compact('extracurriculars'));
    }

    public function create()
    {
        return view('Admin.Extracurriculars.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateExtra($request, true);
        $validated['image'] = $this->storeImage($request);

        Extracurriculars::create($validated);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = Extracurriculars::findOrFail($id);

        return view('Admin.Extracurriculars.show', [
            'title'     => 'Detail Ekstrakurikuler',
            'backRoute' => 'admin.ekstrakurikuler',
            'fields'    => [
                'Nama'      => $item->name,
                'Deskripsi' => $item->description,
                'Jadwal'    => $item->schedule,
                'Pembina'   => $item->coach,
                'Foto'      => $item->image,
            ],
        ]);
    }

    public function edit($id)
    {
        $extracurricular = Extracurriculars::findOrFail($id);
        return view('Admin.Extracurriculars.edit', compact('extracurricular'));
    }

    public function update(Request $request, $id)
    {
        $item = Extracurriculars::findOrFail($id);
        $validated = $this->validateExtra($request, false);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        $item->update($validated);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Extracurriculars::findOrFail($id)->delete();

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    /* =========================================================
     |  Helper
     ========================================================= */

    /**
     * Validasi data ekstrakurikuler.
     */
    private function validateExtra(Request $request, bool $requiredImage): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'activities'  => 'nullable|string',
            'schedule'    => 'required|string|max:255',
            'coach'       => 'required|string|max:255',
            'image'       => ($requiredImage ? 'required|' : 'nullable|')
                             . 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
    }

    /**
     * Simpan file gambar ke public/uploads/extracurriculars.
     */
    private function storeImage(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads/extracurriculars'));

        $file = $request->file('image');
        $name = 'extra_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/extracurriculars'), $name);

        return 'uploads/extracurriculars/' . $name;
    }

    /**
     * Data untuk form create/edit.
     */
    private function formData(
        string $title,
        string $saveRoute,
        string $backRoute,
        $record,
        bool $edit = false
    ): array {
        return compact('title', 'saveRoute', 'backRoute', 'record', 'edit') + [
            'fields' => [
                ['name' => 'name',        'label' => 'Nama',      'type' => 'text',     'required' => true],
                ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => true],
                ['name' => 'schedule',    'label' => 'Jadwal',    'type' => 'text',     'required' => true],
                ['name' => 'coach',       'label' => 'Pembina',   'type' => 'text',     'required' => true],
                ['name' => 'image',       'label' => 'Foto',      'type' => 'file',     'required' => !$edit],
            ],
        ];
    }
}