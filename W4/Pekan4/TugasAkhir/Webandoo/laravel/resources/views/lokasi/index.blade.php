@extends('layouts.app')

@section('title', 'Daftar Lokasi')

@section('content')
    <h1 class="judul">Daftar Lokasi</h1>
    <p class="sub">Data diambil langsung dari database menggunakan model Eloquent.</p>

    <div class="chips">
        <a href="/lokasi" class="chip {{ !$aktif ? 'active' : '' }}">Semua</a>
        @foreach($kategori as $k)
            <a href="/lokasi?kategori={{ $k->slug }}" class="chip {{ $aktif == $k->slug ? 'active' : '' }}">{{ $k->nama }}</a>
        @endforeach
    </div>

    @if($lokasi->count() > 0)
        <div class="grid">
            @foreach($lokasi as $item)
                @include('partials.lokasi-card')
            @endforeach
        </div>
    @else
        <p class="kosong">Belum ada lokasi pada kategori ini.</p>
    @endif
@endsection