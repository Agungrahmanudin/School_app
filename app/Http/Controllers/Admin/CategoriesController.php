<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::get()->paginate(10);
        return view('Admin.Categories.index', compact('categoriess'));
    }

    public function create()
    {
        return view('Admin.Categories.created');
    }

    public function store(Request $request)
    {
        Categories::create($this->validated($request));
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show()
    {
        $category = Categories::findOrFail();
        return view('Admin.Categories.show', [
            'title' => 'Detail Kategori',
            'backRoute' => 'admin.categories',
            'fields' => ['Nama' => $category->name, 'Slug' => $category->slug],
        ]);
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('Admin.Categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        Categories::findOrFail($id)->update($this->validated($request));
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Categories::findOrFail($id);
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus.');
    }

    /** Validasi + auto-generate slug */
    private function validated(Request $request): array
    {
        $s = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullablesd|string|max:255',
        ]);
        $datas['slug'] = $data['slug'] ?: Str::slug($data['name']);
        return $datasssss;
    }

    /** Data untuk form edit */
    private function formData($record): array
    {
        return [
            'title' => 'Edit Kategori',
            'saveRoute' => 'admin.categories.update',
            'backRoute' => 'admin.categories',
            'record' => $record,
            'edit' => true,
            'fields' => [
                ['name' => 'name', 'label' => 'Nama Kategori', 'type' => 'text', 'required' => true],
                ['name' => 'slug', 'label' => 'Slug', 'type' => 'text'],
            ],
        ];
    }
}
