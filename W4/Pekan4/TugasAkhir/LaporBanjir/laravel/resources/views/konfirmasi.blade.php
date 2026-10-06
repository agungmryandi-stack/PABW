@extends('layouts.app')

@section('title', 'Laporan Terkirim')

@section('content')
    <div class="form-box">
        <x-alert type="success">
            ✅ Terima kasih, <strong>{{ $laporan->nama_pelapor }}</strong>! Laporan banjir Anda berhasil disimpan.
        </x-alert>

        @include('partials.laporan-card')

        <div style="display:flex; gap:10px; margin-top:20px">
            <a href="/form" class="btn" style="flex:1; text-align:center">Lapor Lagi</a>
            <a href="/daftar-laporan" class="btn btn-putih" style="flex:1; text-align:center; border:1px solid var(--biru)">Lihat Daftar</a>
        </div>
    </div>
@endsection