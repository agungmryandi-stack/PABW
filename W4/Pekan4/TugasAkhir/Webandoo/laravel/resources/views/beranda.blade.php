@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="hero">
        <h1>Jelajahi Bandung Lebih Mudah</h1>
        <p>Temukan wisata sejarah, kuliner, kafe, spot foto, dan event Kota Bandung lengkap dengan jam buka, harga, dan ulasan pengunjung.</p>
        <a href="/lokasi" class="btn btn-putih">Lihat Semua Lokasi</a>
    </div>

    <div class="stats">
        <div class="stat"><div class="angka">{{ $totalLokasi }}</div><div class="label">Lokasi</div></div>
        <div class="stat"><div class="angka">{{ $totalKategori }}</div><div class="label">Kategori</div></div>
        <div class="stat"><div class="angka">{{ $totalReview }}</div><div class="label">Review</div></div>
    </div>

    <h2 class="section-title">Kategori</h2>
    <div class="chips">
        @foreach($kategori as $k)
            <a href="/lokasi?kategori={{ $k->slug }}" class="chip">
                <i class="fas {{ $k->icon }}" style="color: {{ $k->warna }}"></i> {{ $k->nama }} ({{ $k->lokasi_count }})
            </a>
        @endforeach
    </div>

    <h2 class="section-title">Rating Tertinggi</h2>
    <div class="grid">
        @foreach($terbaik as $item)
            @include('partials.lokasi-card')
        @endforeach
    </div>
@endsection