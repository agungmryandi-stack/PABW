<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporBanjir - Form Pelaporan</title>
    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}">
</head>
<body>
    <div class="card">
        <h1>LaporBanjir</h1>
        <p class="sub">BPBD Kabupaten Bandung - Form Pelaporan Banjir</p>

        <form action="{{ route('laporan.kirim') }}" method="POST" id="formLapor">
            @csrf

            <label for="nama">Nama Pelapor</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
            @error('nama') <div class="error">{{ $message }}</div> @enderror

            <label for="lokasi">Lokasi Kejadian (Kecamatan/Desa)</label>
            <textarea id="lokasi" name="lokasi" rows="3">{{ old('lokasi') }}</textarea>
            @error('lokasi') <div class="error">{{ $message }}</div> @enderror

            <label for="tinggi">Tinggi Genangan Air (cm)</label>
            <input type="number" id="tinggi" name="tinggi" value="{{ old('tinggi') }}">
            @error('tinggi') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" id="btnKirim">Kirim Laporan</button>
        </form>
    </div>

    <script>
        // Mencegah tombol diklik dua kali saat form dikirim
        document.getElementById('formLapor').addEventListener('submit', function () {
            var tombol = document.getElementById('btnKirim');
            tombol.disabled = true;
            tombol.textContent = 'Mengirim...';
        });
    </script>
</body>
</html>