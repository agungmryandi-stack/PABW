<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'lokasi_id', 'user_id', 'nama_pengunjung',
        'rating', 'tanggal_kunjungan', 'komentar',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}