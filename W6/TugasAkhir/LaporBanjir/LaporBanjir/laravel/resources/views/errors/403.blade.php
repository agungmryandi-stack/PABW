@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<div class="sempit">
    <p class="kecil">Kode 403</p>
    <h1 class="judul-halaman">Akses ditolak.</h1>
    <p class="lead">{{ $exception->getMessage() ?: 'Anda tidak punya izin untuk membuka halaman ini.' }}</p>

    <div class="tombol-baris">
        <a href="/" class="tombol">Kembali ke Beranda</a>
    </div>
</div>
@endsection
