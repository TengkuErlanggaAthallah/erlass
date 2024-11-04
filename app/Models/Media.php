<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    // App/Models/Media.php
    protected $fillable = [
        'category',
        'title',
        'upload_date',
        'description',
        'designer_name',
        'video_title',
        'image',
        'media',
        'thumbnail',
        'type',
        'path',
        'user_id',
        'quote',
    ];

    // Di dalam model Media
        public function user() {
            return $this->belongsTo(User::class, 'user_id'); // ganti 'user_id' dengan nama kolom yang sesuai
        }
    }
