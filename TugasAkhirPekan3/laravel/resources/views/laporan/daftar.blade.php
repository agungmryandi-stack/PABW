@extends('layouts.app')

@section('judul', 'Daftar Laporan')

@section('konten')
<div class="card">
    <h1>Daftar Laporan Banjir</h1>
    <p class="sub">Rekap laporan yang masuk dari warga.</p>

    @forelse ($laporan as $item)
        @include('partials.laporan-card', ['item' => $item])
    @empty
        <div class="empty-state">Belum ada laporan yang masuk.</div>
    @endforelse

    <a href="{{ route('laporan.form') }}" class="btn">+ Tambah Laporan</a>
</div>
@endsection