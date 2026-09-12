<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Stockify') }} - Sistem Manajemen Inventaris</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background:
                    radial-gradient(700px 460px at 88% 8%, rgba(37, 99, 235, 0.22), transparent 60%),
                    radial-gradient(620px 420px at 6% 92%, rgba(79, 70, 229, 0.18), transparent 60%),
                    linear-gradient(150deg, #ecf3ff 0%, #e7edfb 45%, #dfe8fb 100%);
            }

            .auth-shell {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 28px 20px;
            }

            .auth-inner {
                width: 100%;
                max-width: 28rem;
                text-align: center;
            }

            .auth-logo {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 20px;
                font-weight: 800;
                color: #0f172a;
                text-decoration: none;
                margin-bottom: 18px;
            }

            .auth-logo-mark {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 12px;
                background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
                color: #fff;
                box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
            }

            .auth-logo-mark svg {
                width: 20px;
                height: 20px;
            }

            .auth-card {
                background: #fff;
                border-radius: 20px;
                box-shadow: 0 28px 60px -18px rgba(15, 23, 42, 0.28);
                border: 1px solid #e2e8f0;
            }
        </style>
    </head>
    <body class="font-sans text-slate-800 antialiased">
        <div class="auth-shell">
            <div class="auth-inner">
                <a href="{{ route('home') }}" class="auth-logo">
                    <span class="auth-logo-mark">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </span>
                    Stockify
                </a>

                <div class="auth-card p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>