<x-app-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">Selamat datang, {{ auth()->user()->name }}</h2>
            <p class="mt-1 text-sm text-slate-500">Ringkasan performa inventaris Stockify pada {{ now()->format('d M Y') }}.</p>
        </div>

        {{-- Kartu statistik --}}
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
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Kategori</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalKategori }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Supplier</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalSupplier }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Pengguna</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-fuchsia-50 text-fuchsia-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $totalUser }}</p>
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

            <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-red-600">Stok Habis</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-800">{{ $stokHabis }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nilai Inventori</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-2 text-2xl font-extrabold text-slate-800">Rp {{ number_format($nilaiInventori, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Grafik --}}
        <div class="grid gap-5 xl:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
                <h3 class="mb-1 font-semibold text-slate-800">Perpindahan Stok 14 Hari Terakhir</h3>
                <p class="mb-4 text-xs text-slate-400">Jumlah barang masuk dan keluar per hari.</p>
                <div class="h-72">
                    <canvas id="chartTransaksi"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="mb-1 font-semibold text-slate-800">Kondisi Stok</h3>
                <p class="mb-4 text-xs text-slate-400">Klasifikasi ketersediaan barang.</p>
                <div class="h-72">
                    <canvas id="chartKondisi"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
                <h3 class="mb-1 font-semibold text-slate-800">Barang per Kategori</h3>
                <p class="mb-4 text-xs text-slate-400">Sebaran jumlah barang pada tiap kategori.</p>
                <div class="h-72">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>

            {{-- Transaksi terakhir --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="mb-4 font-semibold text-slate-800">Transaksi Terakhir</h3>
                <div class="space-y-3">
                    @forelse ($transaksiTerakhir as $t)
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg {{ $t->jenis = 'masuk' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $t->jenis = 'masuk' ? 'M12 4v16m8-8H4' : 'M20 12H4' }}" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-slate-700">{{ $t->barang?->nama_barang ?? '-' }}</p>
                                <p class="text-xs text-slate-400">{{ $t->user?->name ?? '-' }} · {{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</p>
                            </div>
                            <span class="text-sm font-semibold {{ $t->jenis = 'masuk' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $t->jenis = 'masuk' ? '+' : '-' }}{{ $t->jumlah }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Belum ada transaksi.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartTransaksi = document.getElementById('chartTransaksi');
            new Chart(chartTransaksi, {
                type: 'bar',
                data: {
                    labels: @json($chartTanggal),
                    datasets: [
                        {
                            label: 'Stok Masuk',
                            data: @json($chartMasuk),
                            backgroundColor: '#10b981',
                            borderRadius: 4,
                        },
                        {
                            label: 'Stok Keluar',
                            data: @json($chartKeluar),
                            backgroundColor: '#ef4444',
                            borderRadius: 4,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                    },
                },
            });

            const chartKondisi = document.getElementById('chartKondisi');
            new Chart(chartKondisi, {
                type: 'doughnut',
                data: {
                    labels: ['Aman', 'Menipis', 'Habis'],
                    datasets: [{
                        data: @json([$stokAman, $stokMenipis, $stokHabis]),
                        backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                        borderWidth: 0,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' },
                    },
                },
            });

            const chartKategori = document.getElementById('chartKategori');
            new Chart(chartKategori, {
                type: 'bar',
                data: {
                    labels: @json($kategoriLabels),
                    datasets: [{
                        label: 'Jumlah Barang',
                        data: @json($kategoriCounts),
                        backgroundColor: '#3b82f6',
                        borderRadius: 4,
                    }],
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        x: { beginAtZero: true, ticks: { precision: 0 } },
                    },
                },
            });
        });
    </script>
</x-app-layout>