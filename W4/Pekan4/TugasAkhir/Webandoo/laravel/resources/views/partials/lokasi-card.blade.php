<div class="card">
    <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->nama }}">
    <div class="card-body">
        <span class="badge" style="background: {{ $item->kategori->warna }}">
            <i class="fas {{ $item->kategori->icon }}"></i> {{ $item->kategori->nama }}
        </span>
        <h3>{{ $item->nama }}</h3>
        <p class="meta">📍 {{ $item->alamat }}</p>
        <p class="meta">🕐 {{ $item->jam_buka }} &nbsp;|&nbsp; 🎟️ {{ $item->tiket }}</p>
        <p class="meta"><span class="rating">★ {{ $item->rating }}</span>
            @isset($item->reviews_count) &middot; {{ $item->reviews_count }} review @endisset
        </p>
        <p style="margin-top:12px"><a href="/lokasi/{{ $item->id }}" class="btn" style="padding:7px 16px; font-size:.9rem">Lihat Detail</a></p>
    </div>
</div>