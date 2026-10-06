@extends('layouts.app')

@section('title', 'Daftar Laporan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/daftar.js') }}"></script>
@endpush

@section('content')
<div class="lb-head">
    <div>
        <h1>Daftar Laporan Banjir</h1>
        <p>Rekap laporan warga berdasarkan tingkat status ketinggian genangan.</p>
    </div>
    <a href="/form" class="lb-btn">+ Buat Laporan</a>
</div>

<div class="lb-panel">
    <div class="lb-toolbar">
        <div class="lb-tabs" id="lbTabs">
            <button class="lb-tab active" data-filter="semua">Semua <span class="n">{{ $jumlah['semua'] }}</span></button>
            <button class="lb-tab" data-filter="awas"><span class="dot dot-awas"></span>Awas <span class="n">{{ $jumlah['awas'] }}</span></button>
            <button class="lb-tab" data-filter="siaga"><span class="dot dot-siaga"></span>Siaga <span class="n">{{ $jumlah['siaga'] }}</span></button>
            <button class="lb-tab" data-filter="waspada"><span class="dot dot-waspada"></span>Waspada <span class="n">{{ $jumlah['waspada'] }}</span></button>
        </div>

        <div class="lb-search">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="text" id="lbCari" placeholder="Cari lokasi atau pelapor...">
        </div>
    </div>

    <div class="lb-scroll">
        <table class="lb-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Tinggi Genangan</th>
                    <th>Status</th>
                    <th>Pelapor</th>
                </tr>
            </thead>
            <tbody id="lbBody">
                @foreach($laporan as $item)
                    <tr data-status="{{ strtolower($item->status) }}"
                        data-cari="{{ strtolower($item->lokasi . ' ' . $item->nama_pelapor) }}">
                        <td data-label="Tanggal" class="lb-tgl">{{ $item->tanggal_kejadian->format('d M Y') }}</td>
                        <td data-label="Lokasi" class="lb-lokasi">{{ $item->lokasi }}</td>
                        <td data-label="Tinggi">
                            <div class="lb-tinggi">
                                <b>{{ $item->tinggi_genangan }} <small>cm</small></b>
                                <div class="lb-bar">
                                    <i class="bar-{{ strtolower($item->status) }}" style="width: {{ $item->lebar_bar }}%"></i>
                                </div>
                            </div>
                        </td>
                        <td data-label="Status">
                            <span class="lb-badge lb-{{ strtolower($item->status) }}">{{ $item->status }}</span>
                        </td>
                        <td data-label="Pelapor" class="lb-pelapor">{{ $item->nama_pelapor }}</td>
                    </tr>
                @endforeach

                <tr id="lbKosong" style="{{ $jumlah['semua'] ? 'display:none' : '' }}">
                    <td colspan="5" class="lb-empty">
                        @if($jumlah['semua'])
                            Tidak ada laporan yang cocok.
                        @else
                            Belum ada laporan. <a href="/form">Buat laporan pertama</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="lb-foot">
        <span id="lbInfo">Menampilkan {{ $jumlah['semua'] }} dari {{ $jumlah['semua'] }} laporan</span>
        <span>Awas ≥ 100 cm &nbsp;·&nbsp; Siaga 50–99 cm &nbsp;·&nbsp; Waspada &lt; 50 cm</span>
    </div>
</div>
@endsection