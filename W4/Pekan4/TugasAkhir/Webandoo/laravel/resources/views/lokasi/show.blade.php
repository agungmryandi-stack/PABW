@extends('layouts.app')

@section('title', $lokasi->nama)

@section('content')
    <div class="detail">
        <img src="{{ asset('images/' . $lokasi->gambar) }}" alt="{{ $lokasi->nama }}">
        <div class="detail-body">
            <span class="badge" style="background: {{ $lokasi->kategori->warna }}">
                <i class="fas {{ $lokasi->kategori->icon }}"></i> {{ $lokasi->kategori->nama }}
            </span>
            <h1 class="judul">{{ $lokasi->nama }}</h1>
            <p class="meta">📍 {{ $lokasi->alamat }}</p>
            <p style="margin-top:12px">{{ $lokasi->deskripsi }}</p>

            <div class="info">
                <div><strong>Jam Buka</strong><br>{{ $lokasi->jam_buka }}</div>
                <div><strong>Tiket</strong><br>{{ $lokasi->tiket }}</div>
                <div><strong>Estimasi Biaya</strong><br>{{ $lokasi->biaya }}</div>
                <div><strong>Rating</strong><br><span class="rating">★ {{ $lokasi->rating }}</span></div>
                <div><strong>Koordinat</strong><br>{{ $lokasi->lat }}, {{ $lokasi->lng }}</div>
            </div>
        </div>
    </div>

    <h2 class="section-title">Review Pengunjung ({{ $lokasi->reviews->count() }})</h2>
    @forelse($lokasi->reviews as $r)
        <div class="review">
            <strong>{{ $r->nama_pengunjung }}</strong>
            <span class="rating">&nbsp;{{ str_repeat('★', $r->rating) }}{{ str_repeat('☆', 5 - $r->rating) }}</span>
            <p class="meta">Berkunjung: {{ $r->tanggal_kunjungan?->format('d M Y') }}</p>
            <p style="margin-top:6px">{{ $r->komentar }}</p>
        </div>
    @empty
        <p class="kosong">Belum ada review untuk lokasi ini.</p>
    @endforelse

    <p style="margin-top:20px"><a href="/lokasi" class="btn">← Kembali</a></p>
@endsection