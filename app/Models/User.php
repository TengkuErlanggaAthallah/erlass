<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi untuk pesan yang dikirim
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Relasi untuk pesan yang diterima
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function isAdmin()
    {
        return $this->role === 'admin'; // Gantilah 'role' dengan nama kolom yang sesuai
    }

    public function isPetugas()
    {
        return $this->role === 'petugas'; // Gantilah 'role' dengan nama kolom yang sesuai
    }
}