<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Media;

class HomeController extends Controller
{
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard
        $totalUsers = User::count();
        $totalMedia = Media::count();
    
        // Ambil media terbaru dengan kolom yang diperlukan, termasuk nama pengguna
        $recentMedia = Media::with('user') // Memuat relasi pengguna
                            ->select('title', 'video_title', 'video_date', 'design_date', 'upload_date', 'category', 'user_id') // Pastikan untuk menyertakan user_id
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
    
        $newUserRegistrations = User::whereDate('created_at', '>', now()->subWeek())->count();
    
        // Kirim data ke view
        return view('admin.dashboard', compact('totalUsers', 'totalMedia', 'recentMedia', 'newUserRegistrations',));
    }

    public function index(Request $request)
    {
        $role = $request->input('role');
        $query = User::query(); // Mengambil model User
    
        // Jika ada filter berdasarkan role, tambahkan kondisi ke query
        if ($role) {
            $query->where('role', $role);
        }
    
        // Ambil data pengguna dengan pagination
        $data = $query->paginate(10); // Menambahkan pagination
    
        // Ambil semua pengguna untuk sidebar atau keperluan lain
        $users = User::where(function($query) {
            $query->where('role', 'petugas')
                  ->orWhere('role', 'admin');
        })->where('id', '!=', auth()->id())->get(); // Mengecualikan pengguna yang sedang login
    
        // Kembalikan view dengan data
        return view('admin.user.index', ['Data' => $data, 'users' => $users]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Simpan data ke dalam database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
        'role' => 'required|in:admin,petugas', // Pastikan validasi role sesuai
    ]);

    $user = User::findOrFail($id);
    $user->email = $request->input('email');
    $user->name = $request->input('name');
    
    if ($request->input('password')) {
        $user->password = bcrypt($request->input('password')); // Hash password jika diubah
    }
    
    $user->role = $request->input('role'); // Update role
    $user->save();

    return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
}

    public function destroy($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // Hapus user dari database
        $user->delete();
        
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}