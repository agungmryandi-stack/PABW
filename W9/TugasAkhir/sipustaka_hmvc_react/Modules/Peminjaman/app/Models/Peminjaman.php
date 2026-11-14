<?php

namespace Modules\Peminjaman\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    public const STATUS = ['Dipinjam', 'Dikembalikan'];

    // Nama tabel ditulis manual karena pluralisasi otomatis menghasilkan "peminjamen"
    protected $table = 'peminjamans';

    protected $fillable = [
        'nama_peminjam',
        'judul_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'bukti',
        'nama_bukti',
    ];

    // bukti_url ikut dikirim ke React dalam bentuk JSON
    protected $appends = ['bukti_url'];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date:Y-m-d',
            'tanggal_kembali' => 'date:Y-m-d',
        ];
    }

    // URL publik file bukti, atau null jika belum ada file
    protected function buktiUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->bukti ? asset('storage/'.$this->bukti) : null);
    }
}