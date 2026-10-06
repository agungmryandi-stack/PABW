@extends('layouts.app')

@section('title', 'Lapor Banjir')

@section('content')
    <h1 class="judul" style="text-align:center">Form Pelaporan Banjir</h1>
    <p class="sub" style="text-align:center">Isi data berikut dengan benar dan lengkap.</p>

    <div class="form-box">
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

            <label>Nama Pelapor</label>
            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Contoh: Budi Santoso">

            <label>Lokasi (Kecamatan)</label>
            <select name="lokasi">
                <option value="">-- Pilih kecamatan --</option>
                @foreach (['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'] as $kec)
                    <option value="{{ $kec }}" {{ old('lokasi') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                @endforeach
            </select>

            <label>Tinggi Genangan (cm)</label>
            <input type="number" name="tinggi_genangan" value="{{ old('tinggi_genangan') }}" placeholder="Contoh: 60">

            <label>Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}">

            <button type="submit" class="btn">Kirim Laporan</button>
        </form>
    </div>
@endsection