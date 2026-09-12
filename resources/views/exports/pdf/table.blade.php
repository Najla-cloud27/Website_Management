<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #0f172a;
            margin: 0;
            padding: 0 20px;
        }
        .kop {
            border-bottom: 2px solid #1d4ed8;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }
        .kop h1 {
            margin: 0;
            font-size: 18px;
            color: #1d4ed8;
        }
        .kop p {
            margin: 2px 0 0;
            font-size: 10px;
            color: #475569;
        }
        h2.title {
            margin: 0 0 4px;
            font-size: 14px;
            color: #0f172a;
        }
        p.meta {
            margin: 0 0 12px;
            font-size: 10px;
            color: #64748b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        th {
            background-color: #2563eb;
            color: #ffffff;
            padding: 6px 7px;
            border: 1px solid #1e40af;
            text-align: left;
            font-size: 10px;
        }
        td {
            padding: 5px 7px;
            border: 1px solid #cbd5e1;
            font-size: 10px;
        }
        tr:nth-child(even) td {
            background-color: #f1f5f9;
        }
        .footer {
            font-size: 9px;
            color: #64748b;
            border-top: 1px solid #cbd5e1;
            padding-top: 6px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <h1>Stockify</h1>
        <p>Sistem Manajemen Inventaris Barang - {{ $judul }}</p>
    </div>

    <h2 class="title">{{ $judul }}</h2>
    <p class="meta">Tanggal Export: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" style="text-align:center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()?->name ?? '-' }} ({{ strtoupper(auth()->user()?->role ?? '-') }})
    </div>

    <script type="text/php">
        if (isset($pdf) && isset($fontMetrics)) {
            $text = "{PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->getFont('Helvetica', 'normal');
            $size = 8;
            $color = array(100, 116, 139);
            $width = $pdf->get_width();
            $height = $pdf->get_height();
            $x = ($width / 2) - ($fontMetrics->getTextWidth($text, $font, $size) / 2);
            $y = $height - 14;
            $pdf->page_text($x, $y, $text, $font, $size, $color);
        }
    </script>
</body>
</html>