<?php

namespace App\Http\Controllers;

use App\Models\BannerArtikel;
use App\Models\Artikel;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BannerArtikelController extends Controller
{
    public function banners()
    {
        $banner = BannerArtikel::with('artikel')->latest()->get();
        return view('backend.contents.artikel.banner', compact('banner'));
    }

    public function create_banner()
    {
        $artikel = Artikel::all();
        return view('backend.crud.create_banner', compact('artikel'));
    }

    public function store_banner(Request $request)
    {
        $validated = $request->validate([
            'artikel_id' => 'required|exists:artikel,id',
            'judul_teks' => 'nullable|string|max:255',
            'subjudul_teks' => 'nullable|string|max:255',
            'gambar' => 'required|image|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('banner_artikel', 'public');
        }

        $validated['aktif'] = $request->has('aktif');

        BannerArtikel::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengunggah Banner Artikel',
            'menu' => 'Unggah Banner',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('banner')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit_banner($id)
    {
        $banner = BannerArtikel::findOrFail($id);
        $artikel = Artikel::all();
        return view('backend.crud.edit_banner', compact('banner', 'artikel'));
    }

    public function update_banner(Request $request, $id)
    {
        $banner = BannerArtikel::findOrFail($id);

        $validated = $request->validate([
            'artikel_id' => 'required|exists:artikel,id',
            'judul_teks' => 'nullable|string|max:255',
            'subjudul_teks' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) {
                Storage::disk('public')->delete($banner->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('banner_artikel', 'public');
        }

        $validated['aktif'] = $request->has('aktif');

        $banner->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Banner Artikel',
            'menu' => 'Update Banner',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('banner')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy_banner($id)
    {
        $banner = BannerArtikel::findOrFail($id);

        if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) {
            Storage::disk('public')->delete($banner->gambar);
        }

        $banner->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus Banner Artikel',
            'menu' => 'Delete Banner',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->back()->with('success', 'Banner berhasil dihapus.');
    }

    // public function show($id)
    // {
    //     $banner = BannerArtikel::with('artikel')->findOrFail($id);
    //     return view('backend.crud.show_banner', compact('banner'));
    // }
}
