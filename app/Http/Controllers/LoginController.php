<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->intended('admin/dashboard');
        } elseif ($user->role == 'petugas') {
            return redirect()->intended('petugas/dashboard');
        }
    }

    return redirect()->back()->with('failed', 'Invalid credentials');
}
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Proses login
    public function login_proses(Request $request)
    {
        // Validasi login
        $credentials = $request->only('email', 'password');
    
        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['login' => 'Akun tidak terdaftar.']);
        }
    
        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Jika login berhasil, cek peran
            $user = Auth::user();
    
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect admin
            } elseif ($user->role == 'petugas') {
                return redirect()->route('petugas.dashboard'); // Redirect petugas
            } else {
                return redirect('/'); // Redirect jika peran tidak dikenal
            }
        }
    
        return redirect()->back()->withErrors(['login' => 'Email atau password salah.']);
    }
    // Menampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // Proses register
    // app/Http/Controllers/LoginController.php

public function register_proses(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'petugas', // default role
    ]);

    Auth::attempt(['email' => $request->email, 'password' => $request->password]);

    return redirect()->route('admin.dashboard')->with('success', 'Registration successful.');
}
    // Proses logout
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to login page with success message
        return redirect()->route('/')->with('success', 'You have been logged out.');
    }
}
