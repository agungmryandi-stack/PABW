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
    Schema::create('lokasi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
        $table->string('nama')->unique();
        $table->decimal('lat', 10, 7);
        $table->decimal('lng', 10, 7);
        $table->string('gambar')->nullable();
        $table->string('alamat');
        $table->text('deskripsi')->nullable();
        $table->string('tiket', 100)->nullable();
        $table->string('jam_buka', 100)->nullable();
        $table->string('biaya', 100)->nullable();
        $table->decimal('rating', 2, 1)->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('lokasi');
}
};
