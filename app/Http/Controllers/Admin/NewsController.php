<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /* =========================================================
     | CRUD
     ========================================================= */

    public function index()
    {
        $news = News::with('category', 'createdBy')
            ->latest()
            ->paginate(10);

        return view('Admin.News.index', compact('news'));
    }

    public function create()
    {
        $categories = Categories::all();

        return view('Admin.News.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateNews($request, true);

        $validated['image'] = $this->storeImage($request);

        $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        // Ambil ID user yang sedang login
        $validated['created_by'] = Auth::id();

        // Jika tanggal tidak diisi, gunakan waktu sekarang
        $validated['published_at'] = $request->published_at ?? now();

        News::create($validated);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($id)
    {
        $news = News::with('category', 'createdBy')
            ->findOrFail($id);

        return view('Admin.News.show', [
            'title' => 'Detail Berita',
            'backRoute' => 'admin.berita',

            'fields' => [
                'Judul' => $news->title,
                'Kategori' => $news->category->name ?? '-',
                'Penulis' => $news->createdBy->name ?? 'Admin',
                'Tanggal Publikasi' => $news->published_at,
                'Isi Berita' => $news->content,
                'Foto' => $news->image,
            ],
        ]);
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Categories::all();

        return view('Admin.News.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $this->validateNews($request, false);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        // Jika judul berubah, buat slug baru
        if ($request->title !== $news->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        $validated['published_at'] =
            $request->published_at ?? $news->published_at;

        $news->update($validated);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Hapus file gambar jika ada
        if ($news->image && File::exists(public_path($news->image))) {
            File::delete(public_path($news->image));
        }

        $news->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /* =========================================================
     | Helper
     ========================================================= */

    private function validateNews(
        Request $request,
        bool $requiredImage
    ): array {
        return $request->validate([
            'title' => 'required|string|max:255',

            'category_id' => 'required|exists:categories,id',

            'content' => 'required|string',

            'image' => ($requiredImage ? 'required|' : 'nullable|')
                . 'image|mimes:jpeg,png,jpg|max:5120',

            'published_at' => 'nullable|date',
        ]);
    }

    private function storeImage(Request $request): string
    {
        File::ensureDirectoryExists(
            public_path('uploads/news')
        );

        $file = $request->file('image');

        $filename = 'news_'
            . time()
            . '_'
            . Str::slug(
                Str::limit($request->title, 20, '')
            )
            . '.'
            . $file->getClientOriginalExtension();

        $file->move(
            public_path('uploads/news'),
            $filename
        );

        return 'uploads/news/' . $filename;
    }
}