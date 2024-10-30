<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCreatedByAndVideoUrlFromTableName extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('video_url');
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable(); // Ganti dengan tipe data asli jika berbeda
            $table->string('video_url')->nullable(); // Ganti dengan tipe data asli jika berbeda
        });
    }
}
