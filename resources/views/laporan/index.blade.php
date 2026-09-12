<x-app-layout>
    <x-slot name="header">
        Laporan
    </x-slot>

    <div class="mx-auto max-w-5xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Unduh Laporan</h2>
            <p class="mt-1 text-sm text-slate-500">Export data inventaris ke format Excel atau PDF.</p>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $laporans = [
                    ['jenis' => 'barang', 'nama' => 'Laporan Barang', 'desc' => 'Data lengkap barang, kategori, supplier, stok, dan harga.', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                    ['jenis' => 'kategori', 'nama' => 'Laporan Kategori', 'desc' => 'Daftar kategori beserta jumlah barang tiap kategori.', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                    ['jenis' => 'supplier', 'nama' => 'Laporan Supplier', 'desc' => 'Data lengkap supplier beserta jumlah barang terkait.', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['jenis' => 'stok', 'nama' => 'Laporan Monitoring Stok', 'desc' => 'Realisasi stok terkini dengan status aman, menipis, atau habis.', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['jenis' => 'transaksi', 'nama' => 'Laporan Transaksi Stok', 'desc' => 'Catatan seluruh transaksi masuk dan keluar beserta petugas.', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                    ['jenis' => 'masuk', 'nama' => 'Laporan Stok Masuk', 'desc' => 'Catatan barang masuk beserta petugas yang mencatat.', 'icon' => 'M7 16V8m0 0l-3 3m3-3l3 3M17 8v8m0 0l3-3m-3 3l-3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['jenis' => 'keluar', 'nama' => 'Laporan Stok Keluar', 'desc' => 'Catatan barang keluar beserta petugas yang mencatat.', 'icon' => 'M15 3h4v4M3 21L15 9M8 9h5V4M11 9v5h5M3 21l8-8'],
                ];
            @endphp

            @foreach ($laporans as $laporan)
                <div class="flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $laporan['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-800">{{ $laporan['nama'] }}</h3>
                    <p class="mt-1 flex-1 text-sm text-slate-500">{{ $laporan['desc'] }}</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('export.excel', $laporan['jenis']) }}"
                           class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m4-4l-4 4-4-4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                            </svg>
                            Excel
                        </a>
                        <a href="{{ route('export.pdf', $laporan['jenis']) }}"
                           class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-red-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-700">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            PDF
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>