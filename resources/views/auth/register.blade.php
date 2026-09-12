<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buat akun Stockify untuk mulai mengelola inventaris Anda.">
    <title>Register - Stockify</title>

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --navy: #0f1f4b;
            --ink: #0f172a;
            --slate: #475569;
            --muted: #64748b;
            --line: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, Roboto, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: var(--ink);
            background:
                radial-gradient(700px 480px at 85% 10%, rgba(37, 99, 235, 0.22), transparent 60%),
                radial-gradient(600px 420px at 5% 90%, rgba(79, 70, 229, 0.18), transparent 60%),
                linear-gradient(150deg, #ecf3ff 0%, #e7edfb 45%, #dfe8fb 100%);
        }

        .auth-card {
            width: 100%;
            max-width: 940px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 90px -20px rgba(15, 23, 42, 0.35);
        }

        /* Panel form kiri (register tampil di kiri, akhiran link login di kanan untuk variasi) */
        .auth-form {
            padding: 46px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 800;
            color: var(--ink);
            text-decoration: none;
            margin-bottom: 28px;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .brand-mark svg {
            width: 21px;
            height: 21px;
            color: #fff;
        }

        .auth-form h2 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .auth-form .sub {
            margin-top: 6px;
            font-size: 14.5px;
            color: var(--muted);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-top: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .lead-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            display: flex;
            pointer-events: none;
        }

        .input-wrap .lead-icon svg {
            width: 18px;
            height: 18px;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1px solid var(--line);
            border-radius: 12px;
            font-size: 14.5px;
            font-family: inherit;
            color: var(--ink);
            background: #fbfcfe;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            outline: none;
        }

        .input-wrap input::placeholder {
            color: #94a3b8;
        }

        .input-wrap input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .form-group .error-text {
            margin-top: 6px;
            font-size: 13px;
            color: #dc2626;
        }

        .btn-submit {
            margin-top: 24px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--primary) 0%, #3b4fd8 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 34px rgba(37, 99, 235, 0.42);
            filter: brightness(1.05);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .form-footer {
            margin-top: 22px;
            text-align: center;
            font-size: 14px;
            color: var(--muted);
        }

        .form-footer a {
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert-box {
            margin-top: 18px;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13.5px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-error ul {
            list-style: disc;
            padding-left: 18px;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            text-decoration: none;
        }

        .back-home:hover {
            color: var(--primary);
        }

        .back-home svg {
            width: 15px;
            height: 15px;
        }

        /* Panel branding kanan */
        .auth-brand {
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, #16264f 0%, #0f1f4b 55%, #1d4ed8 130%);
            color: #fff;
            padding: 44px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .auth-brand::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.35);
        }

        .auth-brand::after {
            content: '';
            position: absolute;
            bottom: -90px;
            left: -70px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(129, 140, 248, 0.18);
        }

        .brand-tagline {
            position: relative;
            z-index: 1;
            margin-top: 30px;
        }

        .brand-tagline h3 {
            font-size: 28px;
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -0.02em;
        }

        .brand-tagline p {
            margin-top: 14px;
            font-size: 15px;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.75);
        }

        .brand-points {
            position: relative;
            z-index: 1;
            margin-top: 26px;
            display: grid;
            gap: 12px;
        }

        .bp {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.85);
        }

        .bp .tick {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bp .tick svg {
            width: 13px;
            height: 13px;
        }

        .auth-brand .quote {
            position: relative;
            z-index: 1;
            font-size: 14px;
            font-style: italic;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            border-left: 3px solid rgba(255, 255, 255, 0.3);
            padding-left: 14px;
            margin-top: 30px;
        }

        @media (max-width: 820px) {
            .auth-card {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .auth-brand {
                display: none;
            }

            .auth-form {
                padding: 32px 26px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <div class="auth-card">
        {{-- Panel form --}}
        <main class="auth-form">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </span>
                Stockify
            </a>

            <h2>Buat Akun Baru</h2>
            <p class="sub">Daftar untuk mulai mengelola inventaris Anda.</p>

            @if ($errors->any())
                <div class="alert-box alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <div class="input-wrap">
                            <span class="lead-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   placeholder="Nama lengkap" autofocus autocomplete="name" required>
                        </div>
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <span class="lead-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   placeholder="nama@email.com" autocomplete="username" required>
                        </div>
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <span class="lead-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" name="password" id="password"
                                   placeholder="Min. 8 karakter" autocomplete="new-password" required>
                        </div>
                        @error('password')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <span class="lead-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   placeholder="Ulangi password" autocomplete="new-password" required>
                        </div>
                        @error('password_confirmation')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit">Register</button>
            </form>

            <p class="form-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </p>

            <a href="{{ route('home') }}" class="back-home">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke beranda
            </a>
        </main>

        {{-- Panel branding --}}
        <aside class="auth-brand">
            <div class="brand-tagline">
                <h3>Satu Langkah dari Inventaris yang Lebih Rapi</h3>
                <p>Kelola barang, kategori, supplier, dan stok dalam satu sistem yang sederhana.</p>
            </div>

            <div class="brand-points">
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Gratis untuk memulai
                </span>
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Antarmuka yang mudah dipakai
                </span>
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Data tersimpan dengan aman
                </span>
            </div>

            <p class="quote">"Pencatatan yang teratur adalah awal dari pengelolaan inventaris yang sehat."</p>
        </aside>
    </div>
</body>
</html>