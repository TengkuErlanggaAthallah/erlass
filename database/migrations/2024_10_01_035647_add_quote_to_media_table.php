<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteToMediaTable extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->text('quote')->nullable(); // Menambahkan kolom quote
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('quote'); // Menghapus kolom quote jika rollback
        });
    }
}

