<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'kategori_id', 'nama', 'lat', 'lng', 'gambar', 'alamat',
        'deskripsi', 'tiket', 'jam_buka', 'biaya', 'rating',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}