<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ArtikelVerifikasiController extends Controller
{
    // Menampilkan artikel draft untuk verifikasi
    public function verifikasiArtikel()
    {
        $artikel = Artikel::where('status', 'archived')->latest()->paginate(10);
        return view('backend.contents.artikel.verifikasi', compact('artikel'));
    }

    // Update artikel menjadi published setelah verifikasi
    public function publishArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'status' => 'published',  // Ubah status menjadi published
        ]);

        // Log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Artikel diterbitkan',
            'menu' => 'Artikel',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('artikel.verifikasi')->with('success', 'Artikel berhasil diterbitkan');
    }
}
