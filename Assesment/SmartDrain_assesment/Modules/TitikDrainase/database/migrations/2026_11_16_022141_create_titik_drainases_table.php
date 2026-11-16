<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('titik_drainases', function (Blueprint $table) {
            $table->id();
            $table->string('nama_titik');
            $table->string('kecamatan');
            $table->text('deskripsi')->nullable();
            $table->integer('kedalaman_cm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titik_drainases');
    }
};
