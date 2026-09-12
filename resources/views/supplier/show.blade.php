<x-app-layout>
    <x-slot name="header">
        Detail Supplier
    </x-slot>

    <div class="mx-auto max-w-4xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('supplier.index') }}"
                   class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-800">{{ $supplier->nama_supplier }}</h2>
                    <p class="text-sm text-slate-500">{{ $supplier->perusahaan ?? '-' }}</p>
                </div>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('supplier.edit', $supplier->id) }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
            @endif
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:col-span-2">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-400">Informasi Supplier</h3>
                <dl class="grid gap-4 text-sm sm:grid-cols-2">
                    <div>
                        <dt class="text-xs text-slate-400">Nama Supplier</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $supplier->nama_supplier }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Perusahaan</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $supplier->perusahaan ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Nomor Telepon</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $supplier->nomor_telepon ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-400">Email</dt>
                        <dd class="mt-1 font-medium text-slate-800">{{ $supplier->email ?? '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs text-slate-400">Alamat</dt>
                        <dd class="mt-1 text-slate-700">{{ $supplier->alamat ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-slate-400">Jumlah Barang</h3>
                <p class="text-4xl font-extrabold text-slate-800">{{ $supplier->barangs_count }}</p>
                <p class="mt-1 text-sm text-slate-500">barang dari supplier ini</p>
                @if ($supplier->barangs_count > 0)
                    <a href="{{ route('barang.index') }}" class="mt-4 inline-flex text-sm font-semibold text-blue-600 hover:text-blue-700">
                        Lihat barang →
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>