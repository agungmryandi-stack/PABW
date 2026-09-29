<div class="laporan-card">
    <div class="info">
        <b>{{ $item['nama'] }}</b>
        <span>{{ $item['lokasi'] }}</span>
    </div>
    <div class="tinggi">
        <div>{{ $item['tinggi'] }} cm</div>
        @if ($item['tinggi'] < 30)
            <span class="badge Waspada">Waspada</span>
        @elseif ($item['tinggi'] <= 70)
            <span class="badge Siaga">Siaga</span>
        @else
            <span class="badge Awas">Awas</span>
        @endif
    </div>
</div>