<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>
<body>

    <h1>Tambah Kategori</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Kategori</label>
            <br>
            <input type="text" name="nama_kategori" required>
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <br>
            <textarea name="deskripsi"></textarea>
        </div>

        <br>

        <button type="submit">Simpan</button>

        <a href="{{ route('categories.index') }}">Kembali</a>
    </form>

</body>
</html>