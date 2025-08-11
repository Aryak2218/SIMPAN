<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;
use App\Models\ActivityLog;


class DokumenController extends Controller
{
    
    public function home()
    {
         $dokumen = Dokumen::all();
        return view('backend.contents.documents.unggah', compact('dokumen'));
    }

    public function create_dokumen()
    {
        return view('backend.crud.create_dokumen');
    }

     public function store_dokumen(Request $request)
    {
         $request->validate([
            'jenis_dokumen' => 'required',
            'topik' => 'required',
            'fungsi' => 'required',
            'tanggal_periode' => 'required|date',
            'nama_file' => 'required',
            'kategori' => 'required',
            'status_dokumen' => 'required',
        ]);

        Dokumen::create($request->all());

        // Proses penyimpanan dokumen di sini...
        $userId = Auth::id();
        ActivityLog::create([
            'user_id' => $userId,
            'action' => 'Mengunggah Dokumen',
            'menu' => 'Unggah Dokumen',
            'ip_address' => $request->ip(),
        ]);

    return redirect()->route('unggah')->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('backend.contents.documents.show', compact('dokumen'));
    }

    public function edit_dokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('backend.crud.edit_dokumen', compact('dokumen'));
    }

     public function update_dokumen(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'jenis_dokumen' => 'required',
            'topik' => 'required',
            'fungsi' => 'required',
            'tanggal_periode' => 'required|date',
            'nama_file' => 'required',
            'kategori' => 'required',
            'status_dokumen' => 'required',
        ]);

        $dokumen->update($request->all());

        $userId = Auth::id();
        ActivityLog::create([
            'user_id' => $userId,
            'action' => 'Meng-update Dokumen',
            'menu' => 'Update Dokumen',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('unggah')->with('success', 'Dokumen berhasil diperbarui');
    }

     public function destroy($id)
    {
        Dokumen::findOrFail($id)->delete();

        // Logging
            $userId = Auth::id();
            ActivityLog::create([
                'user_id' => $userId,
                'action' => 'Menghapus Dokumen',
                'menu' => 'Delete Document',
                'ip_address' => request()->ip(),
            ]);
        return redirect()->route('unggah')->with('success', 'Dokumen berhasil dihapus');
    }

}
