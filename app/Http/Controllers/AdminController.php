<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan ini ditambahkan
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard
        $users = User::where(function($query) {
            $query->where('role', 'petugas')
                  ->orWhere('role', 'admin');
        })->where('id', '!=', auth()->id())->get(); // Mengecualikan pengguna yang sedang login
    
        $totalUsers = User::count();
        $totalMedia = Media::count(); // Anda perlu menambahkan model Media dan query ini jika belum ada
        $recentMedia = Media::orderBy('created_at', 'desc')->take(5)->get(); // Sesuaikan dengan model Media Anda
        $newUserRegistrations = User::whereDate('created_at', '>', now()->subWeek())->count();
    
        return view('admin.dashboard', compact('totalUsers', 'totalMedia', 'recentMedia', 'newUserRegistrations', 'users'));
    }

    public function index(Request $request)
{
    $role = $request->input('role');
    $query = User::query();
    
    if ($role) {
        $query->where('role', $role);
    }
    
    $data = $query->get();
    return view('admin.user.index', ['Data' => $data]);
}

    public function create()
    {
        return view('create');
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

    public function destroy($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // Hapus user dari database
        $user->delete();
        
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Update user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/profile_pictures', $filename);
            $user->profile_picture = 'profile_pictures/' . $filename;
        }

        $user->save();
        
        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully');
    }
}
