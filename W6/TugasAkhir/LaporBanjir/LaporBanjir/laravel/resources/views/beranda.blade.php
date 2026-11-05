@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="beranda">

    {{-- Kiri: ringkasan --}}
    <section>
        <p class="kecil">Ringkasan laporan &middot; {{ now()->format('d/m/Y') }}</p>

        <h1 class="judul-besar">
            <span class="angka-awas">{{ $awas }}</span> laporan berstatus Awas
            dari {{ $total }} laporan yang masuk.
        </h1>

        @if ($tertinggi)
            <p class="lead">
                Genangan tertinggi tercatat <strong>{{ $tertinggi->tinggi_genangan }} cm</strong>
                di {{ $tertinggi->lokasi }} ({{ $tertinggi->tanggal_kejadian->format('d M Y') }}).
            </p>
        @else
            <p class="lead">Belum ada laporan yang masuk.</p>
        @endif

        <div class="hitung">
            <div><b>{{ $total }}</b><span>Total</span></div>
            <div class="h-awas"><b>{{ $awas }}</b><span>Awas</span></div>
            <div class="h-siaga"><b>{{ $siaga }}</b><span>Siaga</span></div>
            <div class="h-waspada"><b>{{ $waspada }}</b><span>Waspada</span></div>
        </div>

        <div class="tombol-baris">
            <a href="/daftar-laporan" class="tombol">Buka Daftar Laporan</a>
            <a href="/form" class="tombol tombol-garis">Isi Laporan Baru</a>
        </div>
    </section>

    {{-- Kanan: papan duga (tiang pengukur tinggi air) --}}
    <aside class="duga">
        <p class="kecil">Papan duga &middot; genangan tertinggi</p>

        <svg viewBox="0 0 280 370" role="img" aria-label="Papan duga tinggi genangan">
            {{-- Tiga zona warna: 0-50, 50-100, 100-150 cm (1 cm = 2 satuan) --}}
            <rect x="70" y="240" width="46" height="100" fill="#d9a521"/>
            <rect x="70" y="140" width="46" height="100" fill="#d9692a"/>
            <rect x="70" y="40"  width="46" height="100" fill="#b3281f"/>
            <rect x="70" y="40"  width="46" height="300" fill="none" stroke="#17232d" stroke-width="2"/>

            {{-- Garis ukur tiap 10 cm --}}
            @for ($cm = 0; $cm <= 150; $cm += 10)
                @php
                    $y = 340 - $cm * 2;
                    $panjang = ($cm % 50 == 0) ? 24 : 13;
                @endphp
                <line x1="70" y1="{{ $y }}" x2="{{ 70 + $panjang }}" y2="{{ $y }}" stroke="#17232d" stroke-width="1.5"/>
                <text x="62" y="{{ $y + 3 }}" text-anchor="end" class="duga-angka">{{ $cm }}</text>
            @endfor

            {{-- Nama zona --}}
            <text x="124" y="324" class="duga-zona">WASPADA</text>
            <text x="124" y="224" class="duga-zona">SIAGA</text>
            <text x="124" y="124" class="duga-zona">AWAS</text>

            {{-- Penanda genangan tertinggi --}}
            @if ($tertinggi)
                @php $yTanda = 340 - min(150, $tertinggi->tinggi_genangan) * 2; @endphp
                <line x1="68" y1="{{ $yTanda }}" x2="272" y2="{{ $yTanda }}" stroke="#17232d" stroke-width="2.5"/>
                <circle cx="272" cy="{{ $yTanda }}" r="4" fill="#17232d"/>
                <text x="272" y="{{ $yTanda - 8 }}" text-anchor="end" class="duga-nilai">{{ $tertinggi->tinggi_genangan }} cm</text>
            @endif

            <text x="62" y="362" text-anchor="end" class="duga-angka">cm</text>
        </svg>
    </aside>
</div>

<h2 class="bagian">Laporan terbaru</h2>

@if ($terbaru->count() > 0)
    <div class="slip-grid">
        @foreach ($terbaru as $laporan)
            @include('partials.laporan-card')
        @endforeach
    </div>
@else
    <p class="kosong">Belum ada laporan masuk.</p>
@endif
@endsection
