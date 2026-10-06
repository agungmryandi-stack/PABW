@extends('layouts.app')

@section('judul', 'Form Pelaporan')

@section('konten')
<div class="card">
    <h1>Lapor Kejadian Banjir</h1>
    <p class="sub">Isi form di bawah untuk melaporkan banjir di wilayah Anda.</p>

    <form action="{{ route('laporan.kirim') }}" method="POST" id="formLapor">
        @csrf

        <label for="nama">Nama Pelapor</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso">
        @error('nama') <div class="error">{{ $message }}</div> @enderror

        <label for="lokasi">Lokasi Kejadian (Kecamatan/Desa)</label>
        <textarea id="lokasi" name="lokasi" rows="3" placeholder="Contoh: Kecamatan Dayeuhkolot">{{ old('lokasi') }}</textarea>
        @error('lokasi') <div class="error">{{ $message }}</div> @enderror

        <label for="tinggi">Tinggi Genangan Air (cm)</label>
        <input type="number" id="tinggi" name="tinggi" value="{{ old('tinggi') }}" placeholder="Contoh: 45">
        @error('tinggi') <div class="error">{{ $message }}</div> @enderror

        <button type="submit" id="btnKirim">Kirim Laporan</button>
    </form>
</div>

<script>
    document.getElementById('formLapor').addEventListener('submit', function () {
        var tombol = document.getElementById('btnKirim');
        tombol.disabled = true;
        tombol.textContent = 'Mengirim...';
    });
</script>
@endsection