@extends('layouts.laporbanjir')
@section('title', 'Lapor Banjir')

@section('content')
<div class="dua-kolom">

    <section class="formulir">
        <div class="formulir-kop">Formulir laporan banjir</div>

        {{-- enctype WAJIB supaya foto ikut terkirim --}}
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="isian">
                <label>01 &middot; Nama Pelapor</label>
                <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Contoh: Budi Santoso">
                @error('nama_pelapor') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>02 &middot; No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                @error('no_hp') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>03 &middot; Lokasi (alamat / nama jalan)</label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Raya Dayeuhkolot No. 12">
                @error('lokasi') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>04 &middot; Kecamatan</label>
                <select name="kecamatan">
                    <option value="">-- Pilih kecamatan --</option>
                    @foreach (['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'] as $kec)
                        <option value="{{ $kec }}" @selected(old('kecamatan') == $kec)>{{ $kec }}</option>
                    @endforeach
                </select>
                @error('kecamatan') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>05 &middot; Tinggi Air (cm)</label>
                <input type="number" name="tinggi_air" value="{{ old('tinggi_air') }}" placeholder="Contoh: 60">
                @error('tinggi_air') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>06 &middot; Keterangan (opsional)</label>
                <textarea name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <div class="isian">
                <label>07 &middot; Foto Kondisi Banjir (jpg, jpeg, png - maks. 2 MB)</label>
                <input type="file" name="foto" accept="image/*">
                @error('foto') <div class="galat">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="tombol tombol-penuh">Kirim Laporan</button>
        </form>
    </section>

    <aside class="catatan">
        <p class="kecil">Untuk warga</p>
        <h1 class="judul-halaman">Laporkan banjir di sekitar Anda.</h1>
        <p class="lead">Tidak perlu login. Sertakan foto kondisi banjir sebagai bukti agar petugas BPBD dapat menilai tingkat bahayanya.</p>
        <p style="margin-top:14px">Ukur tinggi air dari permukaan tanah ke batas air terdalam yang terlihat.</p>
    </aside>
</div>
@endsection