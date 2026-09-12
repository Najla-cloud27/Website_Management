<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($header) ? strip_tags($header) . ' · ' : '' }}{{ config('app.name', 'Stockify') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }

            @media (min-width: 1024px) {
                .sidebar-panel {
                    display: flex !important;
                    transform: none !important;
                }
            }

            ::-webkit-scrollbar { width: 8px; height: 8px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
            ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>
    </head>

    <body class="h-full bg-slate-100 font-sans text-slate-800 antialiased">
        <div x-data="{ sidebarOpen: false, userMenuOpen: false, logoutOpen: false }" class="min-h-full">

            {{-- Overlay mobile --}}
            <div x-show="sidebarOpen" x-cloak
                 @click="sidebarOpen = false"
                 class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"
                 style="display: none;">
            </div>

            {{-- Sidebar --}}
            <aside x-show="sidebarOpen"
                   x-cloak
                   @click.outside="sidebarOpen = false"
                   class="sidebar-panel fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-slate-900 text-slate-300 shadow-2xl transition-transform duration-300"
                   style="display: none;">
                {{-- Logo --}}
                <div class="flex items-center gap-3 px-6 py-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold tracking-tight text-white">Stockify</p>
                        <p class="text-xs text-slate-400">Manajemen Inventaris</p>
                    </div>
                </div>

                {{-- Nav --}}
                <nav class="mt-2 flex-1 space-y-1 overflow-y-auto px-4">
                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Menu Utama</p>

                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- Inventaris --}}
                    <p class="px-3 pt-6 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Inventaris</p>

                    <a href="{{ route('barang.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('barang.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Manajemen Barang
                    </a>

                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('categories.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('categories.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Kategori Barang
                        </a>

                        <a href="{{ route('supplier.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('supplier.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Supplier
                        </a>
                    @endif

                    {{-- Stok --}}
                    <p class="px-3 pt-6 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Stok</p>

                    <a href="{{ route('stok.masuk.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('stok.masuk.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V8m0 0l-3 3m3-3l3 3M17 8v8m0 0l3-3m-3 3l-3-3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Stok Masuk
                    </a>

                    <a href="{{ route('stok.keluar.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('stok.keluar.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4v4M3 21L15 9M8 9h5V4M11 9v5h5M3 21l8-8" />
                        </svg>
                        Stok Keluar
                    </a>

                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('stok.monitoring.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('stok.monitoring.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Monitoring Stok
                        </a>
                    @endif

                    @if (auth()->user()->isAdmin())
                        {{-- Lainnya khusus admin --}}
                        <p class="px-3 pt-6 pb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Lainnya</p>

                        <a href="{{ route('users.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('users.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            User/Karyawan
                        </a>

                        <a href="{{ route('laporan.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('laporan.*', 'export.*') ? 'bg-blue-600/20 text-white ring-1 ring-blue-500/40' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Laporan
                        </a>
                    @endif
                </nav>

                {{-- Footer sidebar --}}
                <div class="border-t border-slate-800 p-4">
                    <p class="px-2 text-xs text-slate-500">© {{ date('Y') }} Stockify</p>
                </div>
            </aside>

            {{-- Area konten --}}
            <div class="flex min-h-full flex-col lg:pl-72">
                {{-- Topbar --}}
                <header class="sticky top-0 z-20 flex h-16 items-center gap-4 border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
                    <button @click="sidebarOpen = true" class="rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 lg:hidden" aria-label="Buka menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="min-w-0">
                        <h1 class="truncate text-lg font-bold text-slate-800 sm:text-xl">
                            {{ $header ?? 'Dashboard' }}
                        </h1>
                    </div>

                    <div class="ml-auto flex items-center gap-3">
                        <a href="/" class="hidden items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-slate-500 transition hover:bg-slate-100 hover:text-blue-600 sm:flex" title="Kembali ke Beranda">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>

                        {{-- Profile dropdown --}}
                        <div class="relative">
                            <button @click="userMenuOpen = !userMenuOpen"
                                    class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-white py-1.5 pl-1.5 pr-3 shadow-sm transition hover:border-blue-300 hover:shadow">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 text-sm font-bold text-white">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </span>
                                <span class="hidden text-sm font-semibold text-slate-700 sm:block">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="userMenuOpen"
                                 x-cloak
                                 @click.outside="userMenuOpen = false"
                                 class="absolute right-0 mt-2 w-56 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl"
                                 style="display: none;">
                                <div class="border-b border-slate-100 bg-slate-50 px-4 py-3">
                                    <p class="truncate text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                                    <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>

                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>

                                <button type="button" @click="logoutOpen = true" class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm text-slate-600 transition hover:bg-red-50 hover:text-red-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log out
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Konten --}}
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <footer class="border-t border-slate-200 bg-white px-6 py-4 text-center text-xs text-slate-400">
                    © {{ date('Y') }} Stockify · Sistem Manajemen Inventaris
                </footer>
            </div>

            {{-- Modal konfirmasi logout --}}
            <div x-show="logoutOpen"
                 x-cloak
                 x-transition.opacity
                 @keydown.escape.window="logoutOpen = false"
                 class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm"
                 style="display: none;">
                <div class="w-full max-w-sm overflow-hidden rounded-2xl bg-white shadow-2xl">
                    <div class="flex items-start gap-4 p-6">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Yakin ingin keluar?</h3>
                            <p class="mt-1 text-sm text-slate-500">Anda akan keluar dari akun Stockify.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4">
                        <button type="button"
                                @click="logoutOpen = false"
                                class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                            Batal
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                    class="w-full rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700">
                                Ya, Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>