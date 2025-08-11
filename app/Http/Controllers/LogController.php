<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        // Cek apakah yang login adalah Superadmin
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak');
        }

        // Ambil semua log terbaru, bisa difilter berdasarkan user atau aksi jika diperlukan
        $logs = ActivityLog::with('user')->latest()->paginate(25);

        return view('backend.user.activity.log', compact('logs'));
    }
}
