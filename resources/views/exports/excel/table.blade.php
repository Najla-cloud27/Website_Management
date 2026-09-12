<table>
    <tr>
        <td colspan="{{ count($headers) }}"><b>Stockify - Sistem Manajemen Inventaris</b></td>
    </tr>
    <tr>
        <td colspan="{{ count($headers) }}"><b>{{ $judul }}</b></td>
    </tr>
    <tr>
        <td colspan="{{ count($headers) }}">Tanggal Export: {{ $tanggal }}</td>
    </tr>
    <tr>
        <td colspan="{{ count($headers) }}"></td>
    </tr>
    <tr>
        @foreach ($headers as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    @forelse ($rows as $row)
        <tr>
            @foreach ($row as $cell)
                <td>{{ $cell }}</td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ count($headers) }}">Tidak ada data.</td>
        </tr>
    @endforelse
</table>