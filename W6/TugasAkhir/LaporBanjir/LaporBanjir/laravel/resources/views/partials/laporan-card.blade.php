<article class="slip slip-{{ strtolower($laporan->status) }}">
    <div class="slip-atas">
        <span class="cap cap-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span>
        <span class="tgl">{{ $laporan->tanggal_kejadian->format('d M Y') }}</span>
    </div>
    <h3>{{ $laporan->lokasi }}</h3>
    <p class="slip-tinggi">{{ $laporan->tinggi_genangan }} <small>cm</small></p>
    <p class="slip-pelapor">Pelapor: {{ $laporan->nama_pelapor }}</p>
</article>
