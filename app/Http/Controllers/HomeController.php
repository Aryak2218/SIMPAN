<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard () {
        return view('backend.dashboard');
    }

    public function index()
    {
       $data = User::get();
       return view('backend.index', compact('data'));
    }

    public function create()
    {
        return view('backend.crud.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIK' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
            
            $data['NIK'] = $request->NIK;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['role'] = $request->role;

           User::create($data);

            // Logging
            $userId = Auth::id();
            ActivityLog::create([
                'user_id' => $userId,
                'action' => 'Menambahkan User',
                'menu' => 'User Management',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->route('index');
        
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('backend.crud.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'NIK' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user->NIK = $request->NIK;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password diisi, ubah password-nya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Logging
            $userId = Auth::id();
            ActivityLog::create([
                'user_id' => $userId,
                'action' => 'Mengupdate User',
                'menu' => 'User Management',
                'ip_address' => $request->ip(),
            ]);

        return redirect()->route('index')->with('success', 'User berhasil diupdate');
        
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Logging
            $userId = Auth::id();
            ActivityLog::create([
                'user_id' => $userId,
                'action' => 'Menghapus User',
                'menu' => 'User Management',
                'ip_address' => request()->ip(),
            ]);
        return redirect()->route('index')->with('success', 'User berhasil dihapus');
    }

}
