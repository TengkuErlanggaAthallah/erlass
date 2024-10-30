<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'  => 'Tengku Erlangga Athallah',
            'email'  => 'adminexample@gmail.com',
            'password'  => Hash::make('passwordadmin'),
            'role' => 'admin', // Tambahkan role di sini
        ]);
        
        // Jika Anda ingin menambahkan pengguna lain dengan peran berbeda, tambahkan di sini
        User::create([
            'name'  => 'Petugas Example',
            'email'  => 'petugas@example.com',
            'password'  => Hash::make('passwordpetugas'),
            'role' => 'petugas', // Role untuk petugas
        ]);
    }
}
