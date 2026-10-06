<!DOCTYPE html>
<html>
<head>
    <title>Form Mahasiswa</title>
</head>
<body>
    <h1>Input Mahasiswa</h1>

    <form action="/simpan" method="post">
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="umur">Umur:</label>
        <input type="number" name="umur" id="umur" required><br><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>