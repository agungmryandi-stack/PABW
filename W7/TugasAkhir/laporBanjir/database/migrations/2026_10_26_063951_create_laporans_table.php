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
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelapor');
        $table->string('no_hp', 15);                           // string, biar angka 0 di depan nggak hilang
        $table->string('lokasi');
        $table->string('kecamatan');
        $table->unsignedInteger('tinggi_air');                 // dalam cm
        $table->text('keterangan')->nullable();                // boleh kosong
        $table->string('foto');                                // yang disimpan cuma alamat (path) fotonya
        $table->string('status')->default('Menunggu');         // otomatis "Menunggu"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
