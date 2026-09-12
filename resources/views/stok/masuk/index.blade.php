<x-app-layout>
    <x-slot name="header">
        Stok Masuk
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Riwayat Stok Masuk</h2>
                <p class="mt-1 text-sm text-slate-500">Catatan barang yang masuk ke gudang.</p>
            </div>
            <a href="{{ route('stok.masuk.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-emerald-600/30 transition hover:bg-emerald-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Catat Stok Masuk
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            <th class="px-5 py-3.5">No</th>
                            <th class="px-5 py-3.5">Tanggal</th>
                            <th class="px-5 py-3.5">Barang</th>
                            <th class="px-5 py-3.5 text-right">Jumlah</th>
                            <th class="px-5 py-3.5">Keterangan</th>
                            <th class="px-5 py-3.5">Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transaksis as $transaksi)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-3.5 text-slate-400">{{ $transaksis->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-3.5 font-medium text-slate-700">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</td>
                                <td class="px-5 py-3.5">
                                    <p class="font-medium text-slate-700">{{ $transaksi->barang?->nama_barang ?? '-' }}</p>
                                    <p class="text-xs text-slate-400">{{ $transaksi->barang?->kode_barang ?? '' }}</p>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                        +{{ $transaksi->jumlah }} {{ $transaksi->barang?->satuan ?? '' }}
                                    </span>
                                </td>
                                <td class="max-w-[260px] truncate px-5 py-3.5 text-slate-500">{{ $transaksi->keterangan ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $transaksi->user?->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-16">
                                    <div class="flex flex-col items-center gap-3 text-center">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V8m0 0l-3 3m3-3l3 3M17 8v8m0 0l3-3m-3 3l-3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-600">Belum ada transaksi masuk</p>
                                            <p class="mt-0.5 text-sm text-slate-400">Catat stok masuk pertama Anda.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $transaksis->links() }}
        </div>
    </div>
</x-app-layout>