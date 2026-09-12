<x-app-layout>
    <x-slot name="header">
        Detail Kategori
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('categories.index') }}"
               class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Detail Kategori</h2>
                <p class="text-sm text-slate-500">Informasi lengkap dari kategori terpilih.</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-blue-200">Kategori</p>
                        <h3 class="text-xl font-bold text-white">{{ $category->nama_kategori }}</h3>
                    </div>
                </div>
            </div>

            <dl class="divide-y divide-slate-100 text-sm">
                <div class="grid grid-cols-3 gap-4 px-6 py-4">
                    <dt class="font-medium text-slate-500">Deskripsi</dt>
                    <dd class="col-span-2 text-slate-700">{{ $category->deskripsi ?? '-' }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4 px-6 py-4">
                    <dt class="font-medium text-slate-500">Ditambahkan</dt>
                    <dd class="col-span-2 text-slate-700">{{ $category->created_at?->format('d M Y H:i') }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-4 px-6 py-4">
                    <dt class="font-medium text-slate-500">Diperbarui</dt>
                    <dd class="col-span-2 text-slate-700">{{ $category->updated_at?->format('d M Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('categories.index') }}"
               class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                Kembali
            </a>
            <a href="{{ route('categories.edit', $category->id) }}"
               class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Kategori
            </a>
        </div>
    </div>
</x-app-layout>