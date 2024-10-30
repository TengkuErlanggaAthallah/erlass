<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('message')->nullable()->change(); // Allow NULL values
            // or
            // $table->string('message')->default('')->change(); // Set a default value
        });
    }
    
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('message')->nullable(false)->change(); // Revert to NOT NULL
            // or
            // $table->string('message')->default(null)->change(); // Remove default value
        });
    }
};
