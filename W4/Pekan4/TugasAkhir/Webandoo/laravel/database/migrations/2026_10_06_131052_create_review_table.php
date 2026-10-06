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
    Schema::create('review', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lokasi_id')->constrained('lokasi')->cascadeOnDelete();
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->string('nama_pengunjung', 100);
        $table->unsignedTinyInteger('rating');
        $table->date('tanggal_kunjungan')->nullable();
        $table->text('komentar');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('review');
}
};
