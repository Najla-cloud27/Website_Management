<x-app-layout>
    <x-slot name="header">
        Supplier
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        {{-- Header halaman --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Data Supplier</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola data pemasok barang inventaris Anda.</p>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('supplier.create') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Supplier
                </a>
            @endif
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Pencarian --}}
        <form method="GET" action="{{ route('supplier.index') }}" class="flex items-center gap-3">
            <div class="relative flex-1 sm:max-w-sm">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Cari nama atau perusahaan..."
                       class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 shadow-sm focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>
            <button type="submit"
                    class="rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                Cari
            </button>
            @if ($search)
                <a href="{{ route('supplier.index') }}"
                   class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Reset
                </a>
            @endif
        </form>

        {{-- Tabel --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-400">
                            <th class="px-5 py-3.5">No</th>
                            <th class="px-5 py-3.5">Nama Supplier</th>
                            <th class="px-5 py-3.5">Perusahaan</th>
                            <th class="px-5 py-3.5">Telepon</th>
                            <th class="px-5 py-3.5">Email</th>
                            <th class="px-5 py-3.5">Alamat</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($suppliers as $supplier)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-3.5 text-slate-400">{{ $suppliers->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-3.5">
                                    <a href="{{ route('supplier.show', $supplier->id) }}" class="font-medium text-slate-700 hover:text-blue-600">
                                        {{ $supplier->nama_supplier }}
                                    </a>
                                </td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $supplier->perusahaan ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $supplier->nomor_telepon ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $supplier->email ?? '-' }}</td>
                                <td class="max-w-[260px] truncate px-5 py-3.5 text-slate-500">{{ $supplier->alamat ?? '-' }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('supplier.show', $supplier->id) }}"
                                           title="Lihat detail"
                                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-blue-300 hover:text-blue-600">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                                               title="Edit supplier"
                                               class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-indigo-300 hover:text-indigo-600">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        title="Hapus supplier"
                                                        onclick="return confirm('Yakin ingin menghapus supplier ini?');"
                                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-red-300 hover:text-red-600">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16">
                                    <div class="flex flex-col items-center gap-3 text-center">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-600">Belum ada supplier</p>
                                            <p class="mt-0.5 text-sm text-slate-400">Tambahkan supplier pertama Anda.</p>
                                        </div>
                                        @if (auth()->user()->isAdmin())
                                        <a href="{{ route('supplier.create') }}"
                                           class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                                            Tambah Supplier
                                        </a>
                                    @endif
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
            {{ $suppliers->links() }}
        </div>
    </div>
</x-app-layout>