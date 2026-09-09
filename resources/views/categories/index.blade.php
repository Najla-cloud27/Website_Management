<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
</head>
<body>

    <h1>Data Kategori</h1>

    <a href="{{ route('categories.create') }}">+ Tambah Kategori</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->nama_kategori }}</td>
                    <td>{{ $category->deskripsi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}">Detail</a>

                        <a href="{{ route('categories.edit', $category->id) }}">Edit</a>

                        <form action="{{ route('categories.destroy', $category->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>