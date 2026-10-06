<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporBanjir - Konfirmasi Laporan</title>
    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}">
</head>
<body>
    <div class="card">
        <h1>Laporan Diterima</h1>
        <p class="sub">Terima kasih, laporan Anda sudah kami terima.</p>

        <table>
            <tr><td>Nama Pelapor</td><td>{{ $nama }}</td></tr>
            <tr><td>Lokasi</td><td>{{ $lokasi }}</td></tr>
            <tr><td>Tinggi Genangan</td><td>{{ $tinggi }} cm</td></tr>
            <tr><td>Status</td><td><span class="badge {{ $status }}">{{ $status }}</span></td></tr>
            <tr><td>Waktu Lapor</td><td>{{ $waktu }}</td></tr>
        </table>

        <a href="{{ route('laporan.form') }}" class="btn">Buat Laporan Baru</a>
    </div>
</body>
</html>