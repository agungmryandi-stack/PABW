<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - LaporBanjir</title>
    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <div class="brand">
                <span class="icon">🌊</span>
                <div>
                    <h2>LaporBanjir</h2>
                    <small>BPBD Kabupaten Bandung</small>
                </div>
            </div>
            <nav>
                <a href="{{ route('laporan.form') }}"
                 class="{{ request()->routeIs('laporan.form') ? 'aktif' : '' }}">Form Lapor</a>
                <a href="{{ route('laporan.daftar') }}"
                 class="{{ request()->routeIs('laporan.daftar') ? 'aktif' : '' }}">Daftar Laporan</a>
            </nav>
        </div>
    </header>

    <main class="konten">
        @yield('konten')
    </main>
</body>
</html>