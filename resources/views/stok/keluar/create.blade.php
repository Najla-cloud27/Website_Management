<x-app-layout>
    <x-slot name="header">
        Catat Stok Keluar
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('stok.keluar.index') }}"
               class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Catat Stok Keluar</h2>
                <p class="text-sm text-slate-500">Barang yang keluar akan mengurangi saldo stok.</p>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
                    <p class="text-sm font-semibold text-red-700">Periksa kembali isian Anda:</p>
                    <ul class="mt-1.5 list-inside list-disc space-y-0.5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('stok.keluar.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="barang_id" class="mb-1.5 block text-sm font-medium text-slate-700">Pilih Barang <span class="text-red-500">*</span></label>
                    <select name="barang_id"
                            id="barang_id"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none">
                        <option value="">— Pilih Barang —</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" @selected(old('barang_id') == $barang->id)>
                                {{ $barang->kode_barang }} — {{ $barang->nama_barang }} (Stok: {{ $barang->stok }} {{ $barang->satuan }})
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($barangs->isEmpty())
                        <p class="mt-2 text-sm text-amber-600">Belum ada barang. <a href="{{ route('barang.create') }}" class="font-semibold underline">Tambahkan barang</a> terlebih dahulu.</p>
                    @endif
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="jumlah" class="mb-1.5 block text-sm font-medium text-slate-700">Jumlah Keluar <span class="text-red-500">*</span></label>
                        <input type="number"
                               name="jumlah"
                               id="jumlah"
                               value="{{ old('jumlah') }}"
                               required
                               min="1"
                               placeholder="Contoh: 5"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none">
                        @error('jumlah')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal" class="mb-1.5 block text-sm font-medium text-slate-700">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date"
                               name="tanggal"
                               id="tanggal"
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                               required
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none">
                        @error('tanggal')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="keterangan" class="mb-1.5 block text-sm font-medium text-slate-700">Keterangan</label>
                    <textarea name="keterangan"
                              id="keterangan"
                              rows="3"
                              placeholder="Contoh: Penjualan ke pelanggan / pengiriman ke cabang (opsional)"
                              class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('stok.keluar.index') }}"
                       class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-red-600/30 transition hover:bg-red-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1-4l-1 3h-4l-1-3m9 4v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7" />
                        </svg>
                        Simpan Stok Keluar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>