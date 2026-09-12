<x-app-layout>
    <x-slot name="header">
        Tambah Barang
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('barang.index') }}"
               class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Tambah Barang</h2>
                <p class="text-sm text-slate-500">Isi data barang baru di bawah ini.</p>
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

            <form action="{{ route('barang.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="kode_barang" class="mb-1.5 block text-sm font-medium text-slate-700">Kode Barang <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="kode_barang"
                               id="kode_barang"
                               value="{{ old('kode_barang') }}"
                               required
                               maxlength="50"
                               placeholder="Contoh: BRG-001"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('kode_barang')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_barang" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="nama_barang"
                               id="nama_barang"
                               value="{{ old('nama_barang') }}"
                               required
                               maxlength="255"
                               placeholder="Contoh: Monitor LED 24 inch"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('nama_barang')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="category_id" class="mb-1.5 block text-sm font-medium text-slate-700">Kategori</label>
                        <select name="category_id"
                                id="category_id"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                            <option value="">— Pilih Kategori —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="supplier_id" class="mb-1.5 block text-sm font-medium text-slate-700">Supplier</label>
                        <select name="supplier_id"
                                id="supplier_id"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                            <option value="">— Pilih Supplier —</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>
                                    {{ $supplier->nama_supplier }}@if ($supplier->perusahaan) ({{ $supplier->perusahaan }})@endif
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-3">
                    <div>
                        <label for="stok" class="mb-1.5 block text-sm font-medium text-slate-700">Stok Awal <span class="text-red-500">*</span></label>
                        <input type="number"
                               name="stok"
                               id="stok"
                               value="{{ old('stok', 0) }}"
                               required
                               min="0"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('stok')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="satuan" class="mb-1.5 block text-sm font-medium text-slate-700">Satuan <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="satuan"
                               id="satuan"
                               value="{{ old('satuan', 'pcs') }}"
                               required
                               maxlength="50"
                               placeholder="pcs, box, kg, liter"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('satuan')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="mb-1.5 block text-sm font-medium text-slate-700">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number"
                               name="harga"
                               id="harga"
                               value="{{ old('harga') }}"
                               required
                               min="0"
                               step="0.01"
                               placeholder="Contoh: 1500000"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('harga')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi"
                              id="deskripsi"
                              rows="3"
                              placeholder="Deskripsi singkat tentang barang ini (opsional)"
                              class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('barang.index') }}"
                       class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1-4l-1 3h-4l-1-3m9 4v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7" />
                        </svg>
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>