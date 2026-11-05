@extends('layouts.app')

@section('title', 'Laporan Terkirim')

@section('content')
<div class="formulir sempit">
    <div class="formulir-kop">Tanda terima laporan &middot; No. {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</div>

    <x-alert type="success">
        Terima kasih, <strong>{{ $laporan->nama_pelapor }}</strong>. Laporan banjir Anda sudah kami terima.
    </x-alert>

    @include('partials.laporan-card')

    <div class="tombol-baris">
        <a href="/form" class="tombol">Lapor Lagi</a>
        @auth
            <a href="/daftar-laporan" class="tombol tombol-garis">Lihat Daftar</a>
        @else
            <a href="/login" class="tombol tombol-garis">Halaman Login</a>
        @endauth
    </div>
</div>
@endsection
