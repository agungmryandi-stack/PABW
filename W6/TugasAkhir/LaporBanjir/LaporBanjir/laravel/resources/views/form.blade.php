@extends('layouts.app')

@section('title', 'Lapor Banjir')

@section('content')
<div class="dua-kolom">

    <section class="formulir">
        <div class="formulir-kop">Formulir laporan genangan</div>

        @if ($errors->any())
            <x-alert type="danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <form action="/simpan" method="POST">
            @csrf

            <div class="isian">
                <label>01 &middot; Nama Pelapor</label>
                <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Contoh: Budi Santoso">
            </div>

            <div class="isian">
                <label>02 &middot; Lokasi (Kecamatan)</label>
                <select name="lokasi">
                    <option value="">-- Pilih kecamatan --</option>
                    @foreach (['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'] as $kec)
                        <option value="{{ $kec }}" {{ old('lokasi') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                    @endforeach
                </select>
            </div>

            <div class="isian">
                <label>03 &middot; Tinggi Genangan (cm)</label>
                <input type="number" name="tinggi_genangan" value="{{ old('tinggi_genangan') }}" placeholder="Contoh: 60">
            </div>

            <div class="isian">
                <label>04 &middot; Tanggal Kejadian</label>
                <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}">
            </div>

            <button type="submit" class="tombol tombol-penuh">Kirim Laporan</button>
        </form>
    </section>

    <aside class="catatan">
        <p class="kecil">Untuk warga</p>
        <h1 class="judul-halaman">Laporkan genangan di sekitar Anda.</h1>
        <p class="lead">Tidak perlu login. Isi data dengan benar agar petugas BPBD dapat menilai tingkat bahayanya.</p>

        <h3 style="margin-top:32px">Cara membaca status</h3>
        @include('partials.skala')
        <p style="margin-top:14px">Ukur tinggi air dari permukaan tanah ke batas air terdalam yang terlihat.</p>
    </aside>
</div>
@endsection
