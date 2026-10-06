<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['nama', 'slug', 'icon', 'warna'];

    public function lokasi()
    {
        return $this->hasMany(Lokasi::class);
    }
}