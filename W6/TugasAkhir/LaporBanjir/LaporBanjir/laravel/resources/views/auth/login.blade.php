@extends('layouts.app')

@section('title', 'Login ' . ucfirst($role))

@section('content')
<div class="masuk masuk-{{ $role }}">

    {{-- Kolom kiri: penjelasan (berbeda untuk petugas dan admin) --}}
    <section>
        <div class="tab-peran">
            <a href="/login/petugas" class="{{ $role == 'petugas' ? 'aktif' : '' }}">Petugas</a>
            <a href="/login/admin" class="{{ $role == 'admin' ? 'aktif' : '' }}">Admin</a>
        </div>

        @if ($role == 'admin')
            <h1>Ruang kendali admin BPBD.</h1>
            <p class="lead">Admin dapat membuka semua halaman petugas dan mengelola akun petugas.</p>
        @else
            <h1>Masuk untuk memantau laporan genangan.</h1>
            <p class="lead">Petugas dapat membuka Daftar Laporan dan Profil Petugas. Gunakan akun yang sudah terdaftar.</p>
        @endif

        @include('partials.skala')
    </section>

    {{-- Kolom kanan: form login --}}
    <section class="formulir">
        <div class="formulir-kop">Login {{ $role }}</div>

        @if ($errors->any())
            <x-alert type="danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <form action="/login/{{ $role }}" method="POST">
            @csrf

            <div class="isian">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="isian">
                <label>Password</label>
                <input type="password" name="password">
            </div>

            <button type="submit" class="tombol tombol-penuh">Login</button>
        </form>

        <p class="pindah">Belum punya akun? <a href="/register/{{ $role }}">Register {{ $role }}</a></p>
    </section>
</div>

{{-- Warga tidak perlu login untuk melapor --}}
<div class="warga">
    <p><strong>Anda warga?</strong><br>
       Laporkan genangan di sekitar Anda langsung lewat formulir, tanpa perlu login.</p>
    <a href="/form" class="tombol tombol-garis">Lapor Banjir</a>
</div>
@endsection
