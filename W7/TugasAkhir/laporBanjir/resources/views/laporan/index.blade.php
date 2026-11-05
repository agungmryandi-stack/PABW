@extends('layouts.laporbanjir')
@section('title', 'Daftar Laporan')

@section('content')
<p class="kecil" style="margin-top:20px">Petugas BPBD</p>
<h1 class="judul-halaman">Daftar Laporan Banjir</h1>

<div class="tabel-bungkus" style="margin-top:20px">
    <table class="tabel">
        <thead>
            <tr>
                <th>No</th><th>Foto</th><th>Pelapor</th><th>Lokasi</th>
                <th>Kecamatan</th><th>Tinggi Air</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporans as $laporan)
                <tr>
                    <td>{{ $laporans->firstItem() + $loop->index }}</td>
                    <td><img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir" class="thumb"></td>
                    <td>{{ $laporan->nama_pelapor }}</td>
                    <td>{{ $laporan->lokasi }}</td>
                    <td>{{ $laporan->kecamatan }}</td>
                    <td>{{ $laporan->tinggi_air }} cm</td>
                    <td><span class="lencana lencana-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span></td>
                    <td>
                        <a href="{{ route('laporan.show', $laporan) }}" class="link-aksi">Lihat</a> |
                        <a href="{{ route('laporan.edit', $laporan) }}" class="link-aksi">Edit</a> |
                        <form action="{{ route('laporan.destroy', $laporan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-aksi link-hapus"
                                onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" style="text-align:center">Belum ada laporan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $laporans->links('pagination::default') }}
@endsection