<?php

namespace App\Http\Controllers;

use App\Models\SPBE;
use App\Models\User;
use App\Models\Artikel;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SPBEController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('table_search');
        $spbe = SPBE::with(['kategori', 'artikel', 'penulis'])
                ->when($search, function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10); 
        return view('backend.contents.documents.unggah', compact('spbe'));;
    }

    public function create()
    {
         // Generate nomor_id unik (contoh: SPBE-2025-0001)
        $nomorId = 'SPBE-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $kategori = KategoriArtikel::all();
        $artikel = Artikel::all();
        $penulis = User::all();
        return view('backend.crud.create_dokumen', compact('kategori', 'artikel', 'penulis', 'nomorId'));
    }

     public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor_id' => 'required|unique:pengetahuan_spbe',
            'slug' => 'nullable|unique:pengetahuan_spbe,slug',
            'file_path' => 'nullable|file|max:102400', // maks 100MB
        ]);

        // Set slug dan file path
        $slug = $request->slug ?? Str::slug($request->judul);
        $filePath = null;

        // Jika ada file diupload
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('spbe', 'public');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan SPBE
            $spbe = SPBE::create([
                'nomor_id' => $request->nomor_id,
                'judul' => $request->judul,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'excerpt' => $request->excerpt,
                'artikel_id' => $request->artikel_id, // Asosiasikan dengan artikel_id jika ada
                'kategori_id' => $request->kategori_id,
                'penulis_id' => Auth::id(),
                'instansi' => $request->instansi,
                'waktu' => $request->waktu,
                'format' => $request->format,
                'lingkup' => $request->lingkup,
                'label' => $request->label,
                'kontributor' => $request->kontributor,
                'status_publikasi' => $request->status_publikasi,
                'url' => $request->url,
                'file_path' => $filePath,
            ]);

            // Simpan Artikel terkait dengan SPBE
            Artikel::create([
                'judul' => $request->judul,
                'isi' => $request->deskripsi,
                'slug' => Str::slug($request->judul),
                'kategori_id' => $request->kategori_id,
                'user_id' => Auth::id(),
                'spbe_id' => $spbe->id,  // Menyimpan ID SPBE terkait
            ]);

            // Commit jika semua berhasil
            DB::commit();

            // Log aktivitas (optional)
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Mengunggah Dokumen',
                'menu' => 'Unggah Dokumen',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->route('spbe.index')->with('success', 'Data SPBE berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollback();
            throw $e;
        }
    }


    public function edit($id)
    {
        $spbe = SPBE::findOrFail($id);
        $kategori = KategoriArtikel::all();
        $artikel = Artikel::all();
        $penulis = User::all();
        return view('backend.crud.edit_dokumen', compact('spbe', 'kategori', 'artikel', 'penulis'));
    }

    public function update(Request $request, $id)
{
    $spbe = SPBE::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'instansi' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'waktu' => 'nullable|date',
        'format' => 'nullable|string|max:255',
        'lingkup' => 'nullable|string',
        'label' => 'nullable|string',
        'kontributor' => 'nullable|string',
        'status_publikasi' => 'nullable|string',
        'url' => 'nullable|url',
        'file_dokumen' => 'nullable|file|max:102400',
    ]);

    // Menangani field URL jika dikosongkan
    $url = $request->input('url') ? $request->input('url') : null;

    // Mengatur path file jika ada perubahan
    if ($request->hasFile('file_dokumen')) {
        // Hapus file lama jika ada
        if ($spbe->file_path && Storage::disk('public')->exists($spbe->file_path)) {
            Storage::disk('public')->delete($spbe->file_path);
        }
        // Simpan file baru
        $filePath = $request->file('file_dokumen')->store('spbe', 'public');
    } else {
        $filePath = $spbe->file_path; // Jika tidak ada perubahan file, tetap menggunakan yang lama
    }

    // Update data SPBE
    $spbe->update([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'instansi' => $request->instansi,
        'deskripsi' => $request->deskripsi,
        'waktu' => $request->waktu,
        'format' => $request->format,
        'lingkup' => $request->lingkup,
        'label' => $request->label,
        'kontributor' => $request->kontributor,
        'status_publikasi' => $request->status_publikasi,
        'url' => $url,  // Update url menjadi null jika dikosongkan
        'file_path' => $filePath,
    ]);

    ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Dokumen',
            'menu' => 'Update Dokumen',
            'ip_address' => $request->ip(),
        ]);

    return redirect()->route('spbe.index')->with('success', 'Data SPBE berhasil diperbarui.');
}


    public function show($id)
    {
        $artikel = SPBE::with(['penulis', 'kategori'])->findOrFail($id);
        return view('backend.contents.documents.show', compact( 'artikel'));  // Kirim data ke view
    }


    public function destroy($id)
    {
        $spbe = SPBE::findOrFail($id);
        if ($spbe->file_path && Storage::disk('public')->exists($spbe->file_path)) {
            Storage::disk('public')->delete($spbe->file_path);
        }
        $spbe->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Dokumen',
            'menu' => 'Delete Dokumen',
            'ip_address' => request()->ip(),
        ]);
        return redirect()->route('spbe.index')->with('success', 'Data SPBE berhasil dihapus.');
    }
}
