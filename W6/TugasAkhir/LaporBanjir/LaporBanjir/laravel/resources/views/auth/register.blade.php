@extends('layouts.app')

@section('title', 'Register ' . ucfirst($role))

@section('content')
<div class="masuk masuk-{{ $role }}">

    <section>
        <div class="tab-peran">
            <a href="/register/petugas" class="{{ $role == 'petugas' ? 'aktif' : '' }}">Petugas</a>
            <a href="/register/admin" class="{{ $role == 'admin' ? 'aktif' : '' }}">Admin</a>
        </div>

        @if ($role == 'admin')
            <h1>Daftar sebagai admin.</h1>
            <p class="lead">Pendaftaran admin memerlukan kode admin dari BPBD. Tanpa kode, akun tidak dapat dibuat.</p>
        @else
            <h1>Daftar sebagai petugas.</h1>
            <p class="lead">Akun petugas dapat membuka Daftar Laporan dan Profil Petugas setelah login.</p>
        @endif

        @include('partials.skala')
    </section>

    <section class="formulir">
        <div class="formulir-kop">Register {{ $role }}</div>

        @if ($errors->any())
            <x-alert type="danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <form action="/register/{{ $role }}" method="POST">
            @csrf

            <div class="isian">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div class="isian">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="isian">
                <label>Password</label>
                <input type="password" name="password">
            </div>

            <div class="isian">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation">
            </div>

            {{-- Kolom ini hanya muncul di register admin --}}
            @if ($role == 'admin')
                <div class="isian">
                    <label>Kode Admin</label>
                    <input type="password" name="kode_admin">
                </div>
            @endif

            <button type="submit" class="tombol tombol-penuh">Register</button>
        </form>

        <p class="pindah">Sudah punya akun? <a href="/login/{{ $role }}">Login {{ $role }}</a></p>
    </section>
</div>
@endsection
