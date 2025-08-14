<?php

namespace App\Http\Controllers;

use App\Models\SPBE;
use App\Models\Artikel;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function artikels()
    {
        $artikel = Artikel::with('kategori', 'user', 'spbe')->latest()->paginate(10);
        return view('backend.contents.artikel.artikel', compact('artikel'));
    }

    public function create_artikel()
    {
        $kategori = KategoriArtikel::all();
        $spbes = SPBE::all();
        return view('backend.crud.create_artikel', compact('kategori', 'spbes'));
    }

    public function store_artikel(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori_artikel,id',
            'spbe_id' => 'nullable|exists:pengetahuan_spbe,id',
            'excerpt' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/artikel'), $filename);
            $validated['thumbnail'] = 'uploads/artikel/' . $filename;
        }

        $artikel = Artikel::create([
            ...$validated,
            'slug' => Str::slug($request->judul),
            'user_id' => Auth::id(),
            'status' => $request->status ?? 'draft',
            'spbe_id' => $request->spbe_id,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengunggah Artikel',
            'menu' => 'Unggah Artikel',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('artikels')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit_artikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        $spbes = SPBE::all();
        $kategori = KategoriArtikel::all();

        return view('backend.crud.edit_artikel', compact('artikel', 'spbes', 'kategori'));
    }

    public function update_artikel(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori_artikel,id',
            'spbe_id' => 'nullable|exists:pengetahuan_spbe,id',
            'excerpt' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $artikel = Artikel::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/artikel'), $filename);
            $validated['thumbnail'] = 'uploads/artikel/' . $filename;
        }

        $artikel->update([
            ...$validated,
            'slug' => Str::slug($request->judul),
            'spbe_id' => $request->spbe_id,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Meng-update Artikel',
            'menu' => 'Update Artikel',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('artikels')->with('success', 'Artikel diperbarui');
    }

    public function show($id)
    {
        $artikel = Artikel::with(['spbe', 'kategori'])->findOrFail($id);
        session(['last_read_at_' . $id => now()]);
        return view('frontend.artikel.show', compact('artikel'));
    }


    public function destroy_artikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus Artikel',
            'menu' => 'Delete Artikel',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Artikel dihapus');
    }
}
