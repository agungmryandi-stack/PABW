<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - LaporBanjir</title>
    <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
    @stack('styles')
</head>
<body>
    {{-- Pita tipis di paling atas --}}
    <div class="pita">
        <div class="bungkus">
            <span>BPBD Kabupaten Bandung &middot; Posko Pelaporan Banjir</span>
            @auth
                <span>{{ Auth::user()->name }} &middot; {{ Auth::user()->role }}</span>
            @endauth
        </div>
    </div>

    {{-- Navbar --}}
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
                @auth
                    <a href="/" class="{{ request()->is('/') ? 'aktif' : '' }}">Beranda</a>
                    <a href="/form" class="{{ request()->is('form') ? 'aktif' : '' }}">Lapor Banjir</a>
                    <a href="/daftar-laporan" class="{{ request()->is('daftar-laporan') ? 'aktif' : '' }}">Daftar Laporan</a>
                    <a href="/profil" class="{{ request()->is('profil') ? 'aktif' : '' }}">Profil Petugas</a>
                    @if (Auth::user()->isAdmin())
                        <a href="/admin/petugas" class="{{ request()->is('admin/petugas') ? 'aktif' : '' }}">Kelola Petugas</a>
                    @endif
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    {{-- Tampil kalau BELUM login --}}
                    <a href="/form" class="{{ request()->is('form') ? 'aktif' : '' }}">Lapor Banjir</a>
                    <a href="/login" class="{{ request()->is('login*') ? 'aktif' : '' }}">Login</a>
                    <a href="/register" class="{{ request()->is('register*') ? 'aktif' : '' }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="bungkus">
        @if (session('sukses'))
            <x-alert type="success">{{ session('sukses') }}</x-alert>
        @endif
        @if (session('galat'))
            <x-alert type="danger">{{ session('galat') }}</x-alert>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="bungkus">
            <span>&copy; {{ date('Y') }} LaporBanjir</span>
            <span>Papan duga: Waspada &lt; 50 cm &middot; Siaga 50&ndash;99 cm &middot; Awas &ge; 100 cm</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
