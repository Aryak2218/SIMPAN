<?php

namespace App\Http\Controllers;

use App\Models\SPBE;
use App\Models\Artikel;
use App\Models\TagArtikel;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;

class LandingController extends Controller
{
    public function landing(Request $request)
    {
        // Ambil parameter pencarian dari URL
        $search = $request->get('search');
        $kategoriId = $request->get('kategori'); // Ambil kategori dari dropdown
        $tagId = $request->get('tag'); // Ambil tipe/tag dari dropdown

        // Query artikel berdasarkan pencarian dan kategori/tipe
        $artikel = Artikel::with(['spbe', 'kategori'])
            ->where('status', 'published')
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', "%{$search}%")
                            // Pencarian berdasarkan kategori
                            ->orWhereHas('kategori', function ($query) use ($search) {
                                $query->where('nama_kategori', 'like', "%{$search}%");
                            })
                            // Pencarian berdasarkan SPBE
                            ->orWhereHas('spbe', function ($query) use ($search) {
                                $query->where('judul', 'like', "%{$search}%");
                            });
            })
            ->when($kategoriId, function ($query) use ($kategoriId) {
                return $query->where('kategori_id', $kategoriId);
            })
            ->when($tagId, function ($query) use ($tagId) {
                return $query->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('tag_artikel.id', $tagId);
                });
            })
            ->latest()
            ->paginate(10); // Pagination untuk 10 artikel per halaman

        // Ambil semua kategori dan tag
        $kategori = KategoriArtikel::all();
        $tags = TagArtikel::all();

        // Kirim data ke view
        return view('frontend.layout.landing', compact('artikel', 'kategori', 'tags'));
    }


    
    public function contents() {
        return view('frontend.contents.landing-page');
    }
}
