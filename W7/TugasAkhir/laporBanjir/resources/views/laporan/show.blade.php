@extends('layouts.laporbanjir')
@section('title', 'Detail Laporan')

@section('content')
<p class="kecil" style="margin-top:20px">Petugas BPBD &middot; Laporan #{{ $laporan->id }}</p>
<h1 class="judul-halaman">Detail Laporan</h1>

<div class="kartu-detail">
    <div class="kartu-foto">
        <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank">
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir">
        </a>
        <small>Klik foto untuk memperbesar</small>
    </div>

    <div class="kartu-isi">
        <div class="kartu-kepala">
            <h2>{{ $laporan->lokasi }}</h2>
            <span class="lencana lencana-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span>
        </div>

        <dl class="info">
            <dt>Pelapor</dt>    <dd>{{ $laporan->nama_pelapor }}</dd>
            <dt>No HP</dt>      <dd>{{ $laporan->no_hp }}</dd>
            <dt>Kecamatan</dt>  <dd>{{ $laporan->kecamatan }}</dd>
            <dt>Tinggi Air</dt> <dd>{{ $laporan->tinggi_air }} cm</dd>
            <dt>Keterangan</dt> <dd>{{ $laporan->keterangan ?? '-' }}</dd>
            <dt>Dilaporkan</dt> <dd>{{ $laporan->created_at->format('d-m-Y H:i') }}</dd>
        </dl>

        <div class="tombol-baris">
            <a href="{{ route('laporan.edit', $laporan) }}" class="tombol">Edit</a>
            <a href="{{ route('laporan.index') }}" class="tombol tombol-garis">Kembali</a>
        </div>
    </div>
</div>
@endsection