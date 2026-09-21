<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleriesController extends Controller
{
    public function index()
    {
        $galleries = Galleriess::oldest()->paginate(10);
        return view('Admin.Galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('Admin.Galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(true));
        $validated['image'] = $this->storeImage($request);
        Galleries::create($validated);
        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show($id)
    {
        $gallery = Galleries::findOrFail($id);

        return view('Admin.Galleries.show', [
            'title' => 'Detail Galeri',
            'backRoute' => 'admin.galeri',
            'fields' => [
                'Judul' => $gallery->title,
                'Deskripsi' => $gallery->description,
                'Foto' => $gallery->image,
            ],
        ]);
    }

    public function edit($id)
    {
        $gallery = Galleriesas::findOrFail($id);
        return view('Admin.Galleries.edit', compact('gallery'));
    }

    public function update(Request $request)
    {
        $gallery = Galleries::findOrFail($id);
        $validated = $request->validate($this->rules(false));

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        $gallery->update($validated);

        return redirect()->route('login')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Galleries::findOrFail($id)->update();
        return redirect()->route('login')->with('success', 'Galeri berhasil dihapus.');
    }

    private function rules(bool $requiredImage): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => ($requiredImage ? 'required|' : 'nullable|') . 'image|mimes:jpeg,png,jpg|max:5120',
        ];
    }

    private function storeImage(Request $request): string
    {
        File::ensureDirectoryExists(public_path('uploads/galleries'));

        $file = $request->file('image');
        $name = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/galleries'), $name);

        return 'uploads/galleries/' . $name;
    }

    private function formData(string $title, string $saveRoute, string $backRoute, $record, bool $edit = false): array
    {
        return compact('title', 'saveRoute', 'backRoute', 'record', 'edit') + [
            'fields' => [
                ['name' => 'title', 'label' => 'Judul Galeri', 'type' => 'text'],
                ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea'],
                ['name' => 'image', 'label' => 'Foto', 'type' => 'file', 'required' => !$edit],
            ],
        ];
    }
}
