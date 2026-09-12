<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masuk ke Stockify untuk mengelola inventaris Anda.">
    <title>Login - Stockify</title>

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
            grid-template-columns: 0.9fr 1.1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 90px -20px rgba(15, 23, 42, 0.35);
        }

        /* Panel branding */
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

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .brand-mark svg {
            width: 21px;
            height: 21px;
        }

        .brand-tagline {
            position: relative;
            z-index: 1;
            margin-top: 56px;
        }

        .brand-tagline h1 {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.25;
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
            margin-top: 30px;
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

        /* Panel form */
        .auth-form {
            padding: 48px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

        .form-group {
            margin-top: 20px;
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

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .check-row {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13.5px;
            color: var(--slate);
            user-select: none;
        }

        .check-row input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .form-options a {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
        }

        .form-options a:hover {
            text-decoration: underline;
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

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 22px;
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

        @media (max-width: 820px) {
            .auth-card {
                grid-template-columns: 1fr;
                max-width: 460px;
            }

            .auth-brand {
                padding: 30px 28px;
            }

            .brand-tagline {
                margin-top: 28px;
            }

            .brand-tagline h1 {
                font-size: 24px;
            }

            .brand-points {
                display: none;
            }

            .auth-form {
                padding: 34px 28px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-card">
        {{-- Panel branding --}}
        <aside class="auth-brand">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </span>
                Stockify
            </a>

            <div class="brand-tagline">
                <h1>Selamat Datang Kembali</h1>
                <p>Masuk untuk mengelola data inventaris barang, kategori, supplier, dan stok Anda.</p>
            </div>

            <div class="brand-points">
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Data inventaris yang terorganisir
                </span>
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Akses cepat ke dashboard
                </span>
                <span class="bp">
                    <span class="tick">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7" /></svg>
                    </span>
                    Aman &amp; hanya untuk Anda
                </span>
            </div>
        </aside>

        {{-- Panel form --}}
        <main class="auth-form">
            <h2>Login</h2>
            <p class="sub">Masukkan email dan password Anda untuk melanjutkan.</p>

            @if (session('status'))
                <div class="alert-box alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-box alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <span class="lead-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               placeholder="nama@email.com" autofocus autocomplete="username" required>
                    </div>
                    @error('email')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <span class="lead-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password"
                               placeholder="••••••••" autocomplete="current-password" required>
                    </div>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="check-row">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">Login</button>
            </form>

            <p class="form-footer">
                Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </p>

            <a href="{{ route('home') }}" class="back-home">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke beranda
            </a>
        </main>
    </div>
</body>
</html>