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
        $categories = Categories::latest()->paginate(10);
        return view('Admin.Categories.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Categories.create');
    }

    public function store(Request $request)
    {
        Categories::create($this->validated($request));
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);
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
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus.');
    }

    /** Validasi + auto-generate slug */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        return $data;
    }
}
