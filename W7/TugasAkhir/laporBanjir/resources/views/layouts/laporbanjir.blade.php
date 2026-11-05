<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - LaporBanjir</title>
    <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>
<body>
    <div class="pita">
        <div class="bungkus">
            <span>BPBD Kabupaten Bandung &middot; Posko Pelaporan Banjir</span>
            @auth
                <span>{{ Auth::user()->name }} &middot; Petugas</span>
            @endauth
        </div>
    </div>

    <header class="atas">
        <div class="bungkus">
            <a href="/" class="merek">
                <svg width="22" height="26" viewBox="0 0 24 28" aria-hidden="true">
                    <rect x="8" y="1" width="8" height="26" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M8 6h4M8 11h6M8 16h4M8 21h6" stroke="currentColor" stroke-width="2"/>
                    <path d="M0 19c3-2 5 2 8 0M16 19c3-2 5 2 8 0" stroke="#7fc1e3" stroke-width="2" fill="none"/>
                </svg>
                <span>Lapor<b>Banjir</b></span>
            </a>

            <nav class="menu">
                <a href="{{ route('laporan.create') }}"  
                class="{{ request()->routeIs('laporan.create') ? 'aktif' : '' }}">Lapor Banjir</a>
                @auth
                    <a href="{{ route('laporan.index') }}"
                     class="{{ request()->routeIs('laporan.index', 'laporan.show', 'laporan.edit') ? 'aktif' : '' }}">Daftar Laporan</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login Petugas</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="bungkus">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="bungkus">
            <span>&copy; {{ date('Y') }} LaporBanjir</span>
            <span>Papan duga: Waspada &lt; 50 cm &middot; Siaga 50&ndash;99 cm &middot; Awas &ge; 100 cm</span>
        </div>
    </footer>
</body>
</html>