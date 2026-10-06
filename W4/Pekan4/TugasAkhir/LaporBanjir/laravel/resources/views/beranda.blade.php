@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="hero">
        <h1>Laporkan Banjir, Selamatkan Sesama</h1>
        <p>Sistem pelaporan banjir warga Kabupaten Bandung. Kirim laporan genangan di sekitar Anda
           agar petugas BPBD dapat bergerak lebih cepat.</p>
        <a href="/form" class="btn btn-putih">Buat Laporan</a>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="angka">{{ $total }}</div>
            <div class="label">Total Laporan</div>
        </div>
        <div class="stat">
            <div class="angka" style="color: var(--awas)">{{ $awas }}</div>
            <div class="label">Status Awas</div>
        </div>
    </div>

    <h2 class="section-title">Laporan Terbaru</h2>
    @if($terbaru->count() > 0)
        <div class="grid">
            @foreach($terbaru as $laporan)
                @include('partials.laporan-card')
            @endforeach
        </div>
    @else
        <p class="kosong">Belum ada laporan masuk.</p>
    @endif
@endsection