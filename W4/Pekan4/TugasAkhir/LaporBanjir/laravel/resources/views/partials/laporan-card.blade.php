<div class="card status-{{ strtolower($laporan->status) }}">
    <div class="card-top">
        <span class="badge badge-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span>
        <span class="tgl">{{ $laporan->tanggal_kejadian->format('d M Y') }}</span>
    </div>
    <h3>📍 {{ $laporan->lokasi }}</h3>
    <p class="tinggi">{{ $laporan->tinggi_genangan }} <small>cm</small></p>
    <p class="pelapor">Dilaporkan oleh {{ $laporan->nama_pelapor }}</p>
</div>