<x-app-layout>
    <x-slot name="header">
        Tambah Pengguna
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}"
               class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-300 hover:text-blue-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">Tambah Pengguna</h2>
                <p class="text-sm text-slate-500">Buat akun baru untuk anggota tim.</p>
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

            <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           required
                           maxlength="255"
                           placeholder="Nama pengguna"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email <span class="text-red-500">*</span></label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           required
                           maxlength="255"
                           placeholder="contoh@email.com"
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password <span class="text-red-500">*</span></label>
                        <input type="password"
                               name="password"
                               id="password"
                               required
                               placeholder="••••••••"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               required
                               placeholder="••••••••"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="role" class="mb-1.5 block text-sm font-medium text-slate-700">Role <span class="text-red-500">*</span></label>
                    <select name="role"
                            id="role"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none">
                        <option value="user" @selected(old('role', 'user') == 'user')>User - anggota tim (menu standar)</option>
                        <option value="admin" @selected(old('role') == 'admin')>Admin - akses penuh</option>
                    </select>
                    @error('role')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('users.index') }}"
                       class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/30 transition hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1-4l-1 3h-4l-1-3m9 4v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7" />
                        </svg>
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>