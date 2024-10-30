<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Carbon\Carbon;

class DeleteOldMessages extends Command
{
    protected $signature = 'messages:delete-old';
    protected $description = 'Delete messages older than one day';

    public function handle()
    {
        // Menghitung waktu satu hari yang lalu
        $date = Carbon::now()->subDay();

        // Menghapus pesan yang lebih tua dari satu hari
        $deletedCount = Message::where('created_at', '<', $date)->delete();

        $this->info("Deleted {$deletedCount} old messages.");
    }
}