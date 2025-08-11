<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KategoriArtikelController extends Controller
{
    public function category()
    {
        $kategori = KategoriArtikel::latest()->paginate(10);
        return view('backend.contents.artikel.kategori', compact('kategori'));
    }

    public function create_kategori()
    {
        return view('backend.crud.create_kategori_artikel');
    }

    public function store_kategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriArtikel::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambahkan Kategori Artikel ' . $kategori->nama_kategori,
            'menu' => 'Kategori Artikel',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit_kategori($id)
    {
        $kategori = KategoriArtikel::findOrFail($id);
        return view('backend.crud.edit_kategori_artikel', compact('kategori'));
    }

    public function update_kategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriArtikel::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengubah Kategori Artikel ' . $kategori->nama_kategori,
            'menu' => 'Kategori Artikel',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui');
    }

    // public function show_kategori($id)
    // {
    //     $kategori = KategoriArtikel::findOrFail($id);
    //     $artikels = $kategori->artikel;
    //     return view('backend.crud.show_kategori_artikel', compact('kategori'));
    // }

    public function destroy_kategori($id)
    {
        $kategori = KategoriArtikel::findOrFail($id);
        $kategori->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus Kategori Artikel ' . $kategori->nama_kategori,
            'menu' => 'Kategori Artikel',
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
