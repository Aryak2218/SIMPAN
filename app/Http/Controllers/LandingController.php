<?php

namespace App\Http\Controllers;

use App\Models\SPBE;
use App\Models\Artikel;
use App\Models\TagArtikel;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;

class LandingController extends Controller
{
    public function landing()
    {
        // Ambil artikel-artikel terbaru atau yang relevan dengan SPBE
        $artikel = Artikel::with('spbe')->where('status', 'published')->latest()->paginate(10);
        $kategori = KategoriArtikel::all(); // Ambil semua kategori
        $tags = TagArtikel::all(); // Ambil semua tag untuk tipe
        return view('frontend.layout.landing', compact('artikel', 'kategori', 'tags'));
    }
    
    public function contents() {
        return view('frontend.contents.landing-page');
    }
}
