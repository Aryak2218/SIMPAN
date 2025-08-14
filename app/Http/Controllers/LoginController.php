<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ActivityLog;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }


    public function login_proses(Request $request)
    {
        $request->validate([
            'NIK' => 'required',
            'password' => 'required'
        ]);
        
        $data = [
            'NIK' => $request->NIK,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $userId = Auth::id();
            ActivityLog::create([
            'user_id' => $userId,
            'action' => 'Login ke sistem',
            'menu' => 'Halaman Login',
            'ip_address' => $request->ip(),
            ]);

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'NIK atau password salah');
        }
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();
        Auth::logout();
        
        ActivityLog::create([
            'user_id' => $userId,
            'action' => 'Logout dari Sistem',
            'menu' => 'Logout',
            'ip_address' => $request->ip(),
        ]);
        return redirect()->route('login')->with('success', 'Anda berhasil logout');   
    }

    public function register()
    {
        return view('backend.auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'NIK' => 'required|unique:users,NIK|max:16',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data['NIK'] = $request->NIK;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'user';

        User::create($data);

        if (Auth::attempt(['NIK' => $request->NIK, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('error', 'NIK atau password salah');
        }
    }
}
