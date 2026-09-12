<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Selamat datang, {{ auth()->user()->name }}</h2>
            <p class="mt-1 text-sm text-slate-500">Pantau ringkasan inventaris Stockify pada {{ now()->format('d M Y') }}.</p>
        </div>

        {{-- Kartu statistik --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
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
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $stokMenipis }}</p>
            </div>
        </div>

        {{-- Aksi cepat --}}
        <div class="grid gap-4 sm:grid-cols-3">
            <a href="{{ route('barang.index') }}"
               class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-300 hover:shadow">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </span>
                <div>
                    <p class="font-semibold text-slate-800">Manajemen Barang</p>
                    <p class="text-xs text-slate-400">Kelola data barang inventaris</p>
                </div>
            </a>

            <a href="{{ route('stok.masuk.create') }}"
               class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-emerald-300 hover:shadow">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V8m0 0l-3 3m3-3l3 3M17 8v8m0 0l3-3m-3 3l-3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <div>
                    <p class="font-semibold text-slate-800">Catat Stok Masuk</p>
                    <p class="text-xs text-slate-400">Tambahkan stok barang</p>
                </div>
            </a>

            <a href="{{ route('stok.keluar.create') }}"
               class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-red-300 hover:shadow">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4v4M3 21L15 9M8 9h5V4M11 9v5h5M3 21l8-8" />
                    </svg>
                </span>
                <div>
                    <p class="font-semibold text-slate-800">Catat Stok Keluar</p>
                    <p class="text-xs text-slate-400">Kurangi stok barang</p>
                </div>
            </a>
        </div>

        {{-- Transaksi terakhir --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 font-semibold text-slate-800">Transaksi Terakhir</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Barang</th>
                            <th class="px-4 py-3 text-right">Jenis</th>
                            <th class="px-4 py-3 text-right">Jumlah</th>
                            <th class="px-4 py-3">Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($transaksiTerakhir as $t)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-500">{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-slate-700">{{ $t->barang?->nama_barang ?? '-' }}</p>
                                    <p class="text-xs text-slate-400">{{ $t->barang?->kode_barang ?? '' }}</p>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $t->jenis = 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($t->jenis) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold {{ $t->jenis = 'masuk' ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $t->jenis = 'masuk' ? '+' : '-' }}{{ $t->jumlah }}
                                </td>
                                <td class="px-4 py-3 text-slate-500">{{ $t->user?->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-400">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>