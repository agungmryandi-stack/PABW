@extends('layouts.app')

@section('title', 'Profil Petugas')

@section('content')
<div class="formulir sempit {{ Auth::user()->isAdmin() ? 'masuk-admin' : '' }}">
    <div class="formulir-kop">Kartu petugas</div>

    <h1 class="judul-halaman" style="margin-top:0">Profil Petugas</h1>

    <dl>
        <div class="data-baris"><dt>Nama</dt><dd>{{ Auth::user()->name }}</dd></div>
        <div class="data-baris"><dt>Email</dt><dd>{{ Auth::user()->email }}</dd></div>
        <div class="data-baris">
            <dt>Peran</dt>
            <dd><span class="peran peran-{{ Auth::user()->role }}">{{ Auth::user()->role }}</span></dd>
        </div>
        <div class="data-baris"><dt>Akun dibuat</dt><dd>{{ Auth::user()->created_at->format('d M Y, H:i') }}</dd></div>
    </dl>
</div>
@endsection
