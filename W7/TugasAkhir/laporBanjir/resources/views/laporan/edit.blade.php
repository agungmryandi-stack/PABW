@extends('layouts.laporbanjir')
@section('title', 'Edit Laporan')

@section('content')
<section class="formulir" style="margin-top:24px; max-width:720px">
    <div class="formulir-kop">Edit laporan</div>

    <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="isian">
            <label>Nama Pelapor</label>
            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}">
            @error('nama_pelapor') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $laporan->no_hp) }}">
            @error('no_hp') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}">
            @error('lokasi') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Kecamatan</label>
            <select name="kecamatan">
                @foreach (['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'] as $kec)
                    <option value="{{ $kec }}" @selected(old('kecamatan', $laporan->kecamatan) == $kec)>{{ $kec }}</option>
                @endforeach
            </select>
            @error('kecamatan') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Tinggi Air (cm)</label>
            <input type="number" name="tinggi_air" value="{{ old('tinggi_air', $laporan->tinggi_air) }}">
            @error('tinggi_air') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="3">{{ old('keterangan', $laporan->keterangan) }}</textarea>
            @error('keterangan') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Status Penanganan</label>
            <select name="status">
                @foreach (['Menunggu', 'Diproses', 'Selesai'] as $s)
                    <option value="{{ $s }}" @selected(old('status', $laporan->status) === $s)>{{ $s }}</option>
                @endforeach
            </select>
            @error('status') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="isian">
            <label>Foto saat ini</label>
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir" class="thumb" style="width:140px;height:auto;margin-bottom:10px">
            <label>Ganti foto (kosongkan jika tidak ingin mengganti)</label>
            <input type="file" name="foto" accept="image/*">
            @error('foto') <div class="galat">{{ $message }}</div> @enderror
        </div>

        <div class="tombol-baris">
            <button type="submit" class="tombol">Update</button>
            <a href="{{ route('laporan.index') }}" class="tombol tombol-garis">Batal</a>
        </div>
    </form>
</section>
@endsection