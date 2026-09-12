<x-app-layout>
    <x-slot name="header">
        Detail Barang
    </x-slot>

    <div class="mx-auto max-w-4xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('barang.index') }}"
                   class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-800">{{ $barang->nama_barang }}</h2>
                    <p class="text-sm text-slate-500">Kode <span class="font-mono font-semibold text-slate-700">{{ $barang->kode_barang }}</span></p>
                </div>
            </div>
            <a href="{{ route('barang.edit', $barang->id) }}"
               class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            {{-- Info utama --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:col-span-2">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-400">Informasi Barang</h3>
                <dl class="grid gap-4 text-sm sm:grid-cols-2">
                    <div>
                        <dt class="text-xs text-slate-400">Nama Barang</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $barang->nama_barang }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Kode Barang</dt>
                        <dd class="mt-1 font-mono text-slate-800">{{ $barang->kode_barang }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Kategori</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $barang->category?->nama_kategori ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Supplier</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $barang->supplier?->nama_supplier ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Harga Satuan</dt>
                        <dd class="mt-1 font-medium text-slate-800">Rp {{ number_format($barang->harga, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Satuan</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $barang->satuan }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs text-slate-400">Deskripsi</dt>
                        <dd class="mt-1 text-slate-700">{{ $barang->deskripsi ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Kartu stok --}}
            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-400">Stok</h3>
                    @php
                        $status = $barang->stok = 0 ? ['Habis', 'bg-red-100 text-red-700'] : ($barang->stok <= 10 ? ['Menipis', 'bg-amber-100 text-amber-700'] : ['Aman', 'bg-emerald-100 text-emerald-700']);
                    @endphp
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-extrabold text-slate-800">
                            {{ $barang->stok }}
                            <span class="text-base font-semibold text-slate-400">{{ $barang->satuan }}</span>
                        </p>
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $status[1] }}">{{ $status[0] }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('stok.masuk.create') }}"
                       class="flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Catat Stok Masuk
                    </a>
                    <a href="{{ route('stok.keluar.create') }}"
                       class="flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                        </svg>
                        Catat Stok Keluar
                    </a>
                </div>

                @if (auth()->user()->isAdmin())
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus barang ini? Tindakan tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Hapus Barang
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>