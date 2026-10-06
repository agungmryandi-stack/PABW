<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - LaporBanjir</title>
    <style>
        :root {
            --biru: #0b5ed7; --biru-tua: #083d91; --bg: #f4f7fb;
            --teks: #1f2937; --abu: #6b7280;
            --waspada: #d97706; --siaga: #ea580c; --awas: #dc2626;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg);
               color: var(--teks); min-height: 100vh; display: flex; flex-direction: column; }

        /* Navbar */
        .navbar { background: var(--biru-tua); position: sticky; top: 0; z-index: 10;
                  box-shadow: 0 2px 8px rgba(0,0,0,.15); }
        .nav-inner { max-width: 1100px; margin: auto; padding: 14px 20px; display: flex;
                     align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
        .brand { font-size: 1.35rem; font-weight: 700; color: #fff; text-decoration: none; }
        .nav-links a { color: #cfe0ff; text-decoration: none; margin-left: 20px;
                       padding-bottom: 4px; font-weight: 500; }
        .nav-links a:hover, .nav-links a.active { color: #fff; border-bottom: 2px solid #fff; }

        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; flex: 1; width: 100%; }
        h1.judul { font-size: 1.7rem; margin-bottom: 6px; }
        .sub { color: var(--abu); margin-bottom: 22px; }

        /* Hero */
        .hero { background: linear-gradient(135deg, var(--biru), var(--biru-tua)); color: #fff;
                border-radius: 16px; padding: 48px 32px; text-align: center; margin-bottom: 26px; }
        .hero h1 { font-size: 2.1rem; margin-bottom: 10px; }
        .hero p { color: #dbe8ff; max-width: 560px; margin: 0 auto 22px; line-height: 1.6; }

        /* Tombol */
        .btn { display: inline-block; background: var(--biru); color: #fff; border: none;
               padding: 11px 22px; border-radius: 8px; font-size: 1rem; font-weight: 600;
               text-decoration: none; cursor: pointer; }
        .btn:hover { background: var(--biru-tua); }
        .btn-putih { background: #fff; color: var(--biru-tua); }
        .btn-putih:hover { background: #e6efff; }

        /* Statistik */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                 gap: 16px; margin-bottom: 26px; }
        .stat { background: #fff; border-radius: 12px; padding: 18px; text-align: center;
                box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .stat .angka { font-size: 2rem; font-weight: 700; }
        .stat .label { color: var(--abu); font-size: .9rem; }

        /* Kartu laporan */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; }
        .card { background: #fff; border-radius: 12px; padding: 18px;
                box-shadow: 0 2px 8px rgba(0,0,0,.06); border-top: 5px solid var(--abu); }
        .card.status-waspada { border-top-color: var(--waspada); }
        .card.status-siaga   { border-top-color: var(--siaga); }
        .card.status-awas    { border-top-color: var(--awas); }
        .card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .card h3 { font-size: 1.1rem; margin-bottom: 6px; }
        .tinggi { font-size: 1.8rem; font-weight: 700; }
        .tinggi small { font-size: .9rem; color: var(--abu); font-weight: 400; }
        .pelapor, .tgl { color: var(--abu); font-size: .85rem; }

        /* Badge */
        .badge { color: #fff; font-size: .75rem; font-weight: 700; padding: 4px 12px; border-radius: 999px; }
        .badge-waspada { background: var(--waspada); }
        .badge-siaga   { background: var(--siaga); }
        .badge-awas    { background: var(--awas); }

        /* Form */
        .form-box { background: #fff; max-width: 560px; margin: auto; padding: 28px;
                    border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.08); }
        .form-box label { display: block; font-weight: 600; margin: 14px 0 6px; }
        .form-box input, .form-box select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1;
                    border-radius: 8px; font-size: 1rem; }
        .form-box input:focus, .form-box select:focus { outline: 2px solid var(--biru); border-color: var(--biru); }
        .form-box .btn { width: 100%; margin-top: 22px; }

        /* Alert */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 18px; line-height: 1.5; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alert-danger  { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .alert ul { margin-left: 18px; }

        .section-title { font-size: 1.25rem; margin: 10px 0 14px; }
        .kosong { text-align: center; color: var(--abu); padding: 40px 0; }
        footer { text-align: center; color: var(--abu); padding: 20px; font-size: .9rem; }
    </style>
        @stack('styles')
</head>
</head>
<body>
    <nav class="navbar">
        <div class="nav-inner">
            <a href="/" class="brand">🌊 LaporBanjir</a>
            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/form" class="{{ request()->is('form') ? 'active' : '' }}">Lapor Banjir</a>
                <a href="/daftar-laporan" class="{{ request()->is('daftar-laporan') ? 'active' : '' }}">Daftar Laporan</a>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>&copy; {{ date('Y') }} LaporBanjir - BPBD Kabupaten Bandung</footer>
        @stack('scripts')
</body>
</body>
</html>