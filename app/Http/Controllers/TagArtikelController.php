<?php

namespace App\Http\Controllers;

use App\Models\TagArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagArtikelController extends Controller
{
    public function index_tag()
    {
        $tags = TagArtikel::latest()->paginate(10); 
        return view('backend.contents.artikel.tag', compact('tags'));
    }

    public function create_tag()
    {
        return view('backend.crud.create_tag');
    }

     public function store_tag(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:255|unique:tag_artikel,nama_tag',
        ]);

        TagArtikel::create([
            'nama_tag' => $request->nama_tag,
            'slug' => Str::slug($request->nama_tag),
        ]);

        return redirect()->route('tag')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit_tag($id)
    {
        $tag = TagArtikel::findOrFail($id);
        return view('backend.crud.edit_tag', compact('tag'));
    }

    public function update_tag(Request $request, $id)
    {
        $tag = TagArtikel::findOrFail($id);

        $request->validate([
            'nama_tag' => 'required|string|max:255|unique:tag_artikel,nama_tag,' . $tag->id,
        ]);

        $tag->update([
            'nama_tag' => $request->nama_tag,
            'slug' => Str::slug($request->nama_tag),
        ]);

        return redirect()->route('tag')->with('success', 'Tag berhasil diperbarui.');
    }

    public function show_tag($id) {

        
    }

    public function destroy_tag($id)
    {
        $tag = TagArtikel::findOrFail($id);
        $tag->delete();

        return redirect()->route('tag')->with('success', 'Tag berhasil dihapus.');
    }
}
