@extends('layouts.app')

@section('judul', 'Konfirmasi Laporan')

@section('konten')
<div class="card">
    <x-alert type="success" message="Laporan Anda sudah kami terima dan akan segera ditindaklanjuti." />

    <h1>Detail Laporan</h1>

    <table>
        <tr><td>Nama Pelapor</td><td>{{ $nama }}</td></tr>
        <tr><td>Lokasi</td><td>{{ $lokasi }}</td></tr>
        <tr><td>Tinggi Genangan</td><td>{{ $tinggi }} cm</td></tr>
        <tr><td>Waktu Lapor</td><td>{{ $waktu }}</td></tr>
    </table>

    <a href="{{ route('laporan.form') }}" class="btn">Buat Laporan Baru</a>
    <a href="{{ route('laporan.daftar') }}" class="btn outline">Lihat Semua Laporan</a>
</div>
@endsection