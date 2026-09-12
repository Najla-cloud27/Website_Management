<x-app-layout>
    <x-slot name="header">
        Monitoring Stok
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Monitoring Stok</h2>
            <p class="mt-1 text-sm text-slate-500">Pantau ketersediaan stok barang secara real-time berdasarkan data inventaris.</p>
        </div>

        {{-- Kartu ringkasan --}}
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Barang</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalBarang }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Stok</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalStok }}</p>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Stok Menipis</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-amber-700">{{ $totalMenipis }}</p>
            </div>

            <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-red-600">Stok Habis</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-red-700">{{ $totalHabis }}</p>
            </div>
        </div>

        {{-- Filter status + pencarian --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('stok.monitoring.index') }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ !$status ? 'bg-slate-800 text-white' : 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                    Semua
                </a>
                <a href="{{ route('stok.monitoring.index', ['status' => 'aman']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $status === 'aman' ? 'bg-emerald-600 text-white' : 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                    Aman
                </a>
                <a href="{{ route('stok.monitoring.index', ['status' => 'menipis']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $status === 'menipis' ? 'bg-amber-500 text-white' : 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                    Menipis
                </a>
                <a href="{{ route('stok.monitoring.index', ['status' => 'habis']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $status === 'habis' ? 'bg-red-600 text-white' : 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                    Habis
                </a>
            </div>

            <form method="GET" action="{{ route('stok.monitoring.index') }}" class="flex items-center gap-3">
                @if ($status)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative flex-1 sm:max-w-xs">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Cari kode atau nama barang..."
                           class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 shadow-sm focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
                <button type="submit"
                        class="rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Cari
                </button>
            </form>
        </div>

        {{-- Tabel monitoring --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            <th class="px-5 py-3.5">No</th>
                            <th class="px-5 py-3.5">Kode Barang</th>
                            <th class="px-5 py-3.5">Nama Barang</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5 text-center">Stok</th>
                            <th class="px-5 py-3.5">Satuan</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Nilai Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($barangs as $barang)
                            @php
                                $stokStatus = $barang->stok == 0
                                    ? ['label' => 'Habis', 'badge' => 'bg-red-100 text-red-700']
                                    : ($barang->stok <= 10
                                        ? ['label' => 'Menipis', 'badge' => 'bg-amber-100 text-amber-700']
                                        : ['label' => 'Aman', 'badge' => 'bg-emerald-100 text-emerald-700']);
                            @endphp
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-3.5 text-slate-400">{{ $barangs->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-3.5 font-mono text-xs text-slate-500">{{ $barang->kode_barang }}</td>
                                <td class="px-5 py-3.5 font-medium text-slate-700">{{ $barang->nama_barang }}</td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $barang->category?->nama_kategori ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-center">
                                    @if ($barang->stok == 0)
                                        <span class="text-slate-400">-</span>
                                    @else
                                        <span class="font-bold text-slate-700">{{ number_format($barang->stok, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $barang->satuan ?? '-' }}</td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $stokStatus['badge'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $stokStatus['label'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right font-medium text-slate-600">Rp {{ number_format($barang->harga * $barang->stok, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-16">
                                    <div class="flex flex-col items-center gap-3 text-center">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-600">Belum ada data barang</p>
                                            <p class="mt-0.5 text-sm text-slate-400">Tambahkan barang terlebih dahulu untuk memantau stok.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div>
            {{ $barangs->links() }}
        </div>
    </div>
</x-app-layout>