<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - WeBandoo+</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --utama:#0f766e; --tua:#134e4a; --bg:#f3f6f8; --teks:#1f2937; --abu:#6b7280; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'Segoe UI',Arial,sans-serif; background:var(--bg); color:var(--teks);
               min-height:100vh; display:flex; flex-direction:column; }
        .navbar { background:var(--tua); position:sticky; top:0; z-index:10; box-shadow:0 2px 8px rgba(0,0,0,.2); }
        .nav-inner { max-width:1100px; margin:auto; padding:14px 20px; display:flex;
                     justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; }
        .logo { color:#fff; font-size:1.4rem; font-weight:700; text-decoration:none; }
        .nav-links a { color:#b6e3dc; text-decoration:none; margin-left:20px; font-weight:500; padding-bottom:4px; }
        .nav-links a:hover, .nav-links a.active { color:#fff; border-bottom:2px solid #fff; }
        .container { max-width:1100px; margin:30px auto; padding:0 20px; width:100%; flex:1; }
        .hero { background:linear-gradient(135deg,var(--utama),var(--tua)); color:#fff; border-radius:16px;
                padding:46px 30px; text-align:center; margin-bottom:26px; }
        .hero h1 { font-size:2rem; margin-bottom:10px; }
        .hero p { color:#d1f0eb; max-width:580px; margin:0 auto 20px; line-height:1.6; }
        .btn { display:inline-block; background:var(--utama); color:#fff; padding:10px 22px; border-radius:8px;
               text-decoration:none; font-weight:600; }
        .btn-putih { background:#fff; color:var(--tua); }
        .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(170px,1fr)); gap:16px; margin-bottom:26px; }
        .stat { background:#fff; border-radius:12px; padding:18px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,.06); }
        .stat .angka { font-size:2rem; font-weight:700; color:var(--utama); }
        .stat .label { color:var(--abu); font-size:.9rem; }
        h1.judul { font-size:1.7rem; margin-bottom:4px; }
        .sub { color:var(--abu); margin-bottom:20px; }
        .section-title { font-size:1.25rem; margin:10px 0 14px; }
        .chips { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:22px; }
        .chip { padding:7px 16px; border-radius:999px; background:#fff; color:var(--teks); text-decoration:none;
                font-size:.9rem; border:1px solid #d1d5db; }
        .chip.active { background:var(--utama); color:#fff; border-color:var(--utama); }
        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(270px,1fr)); gap:18px; }
        .card { background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.07); }
        .card img { width:100%; height:170px; object-fit:cover; display:block; }
        .card-body { padding:16px; }
        .badge { display:inline-block; color:#fff; font-size:.75rem; font-weight:700; padding:3px 12px; border-radius:999px; margin-bottom:8px; }
        .card h3 { font-size:1.08rem; margin-bottom:6px; }
        .meta { color:var(--abu); font-size:.85rem; line-height:1.6; }
        .rating { color:#f59e0b; font-weight:700; }
        .detail { background:#fff; border-radius:14px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.08); margin-bottom:22px; }
        .detail img { width:100%; max-height:340px; object-fit:cover; display:block; }
        .detail-body { padding:24px; }
        .info { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; margin:16px 0; }
        .info div { background:var(--bg); padding:12px; border-radius:8px; font-size:.9rem; }
        .review { background:#fff; padding:16px; border-radius:10px; margin-bottom:12px; box-shadow:0 1px 5px rgba(0,0,0,.06); }
        .kosong { text-align:center; color:var(--abu); padding:40px 0; }
        footer { text-align:center; color:var(--abu); padding:20px; font-size:.9rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-inner">
            <a href="/" class="logo"><i class="fas fa-map-location-dot"></i> WeBandoo+</a>
            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/lokasi" class="{{ request()->is('lokasi*') ? 'active' : '' }}">Lokasi</a>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>&copy; {{ date('Y') }} WeBandoo+ - Panduan Wisata Kota Bandung</footer>
</body>
</html>