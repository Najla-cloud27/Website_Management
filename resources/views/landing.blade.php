<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stockify — sistem manajemen inventaris untuk mengelola barang, kategori, supplier, dan stok secara teratur.">
    <title>Stockify - Sistem Manajemen Inventaris</title>

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
            --navy-2: #101f45;
            --ink: #0f172a;
            --slate: #475569;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg-soft: #f8fafc;
            --radius: 16px;
            --shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, Roboto, Arial, sans-serif;
            color: var(--ink);
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
        }

        img, svg {
            display: inline-block;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%);
            color: #fff;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }

        .brand-mark svg {
            width: 20px;
            height: 20px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            color: var(--slate);
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn-sm {
            padding: 9px 16px;
            font-size: 13.5px;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.28);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.34);
        }

        .btn-outline {
            background: #fff;
            color: var(--slate);
            border-color: var(--line);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #eff6ff;
        }

        .btn-lg {
            padding: 14px 26px;
            font-size: 15px;
            border-radius: 14px;
        }

        .btn-white {
            background: #fff;
            color: var(--primary);
            box-shadow: 0 8px 24px rgba(2, 6, 23, 0.18);
        }

        .btn-white:hover {
            background: #eff6ff;
            transform: translateY(-1px);
        }

        .btn-ghost-light {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.35);
        }

        .btn-ghost-light:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        /* Avatar & dropdown */
        .avatar-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px 6px 6px;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: #fff;
            cursor: pointer;
            position: relative;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .avatar-wrap:hover {
            border-color: #bfdbfe;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12);
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        .avatar-wrap .name {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .avatar-wrap .caret {
            color: #94a3b8;
            font-size: 10px;
        }

        .dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            min-width: 210px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.14);
            padding: 6px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: all 0.18s ease;
        }

        .dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-head {
            padding: 12px 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 4px;
        }

        .dropdown-head .d-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown-head .d-email {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .dropdown a:hover {
            background: #eff6ff;
            color: var(--primary);
        }

        .dropdown a.icon-danger:hover,
        .dropdown button.icon-danger:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .dropdown button {
            width: 100%;
            text-align: left;
            cursor: pointer;
            border: none;
            background: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            font-family: inherit;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .dropdown button:hover {
            background: #eff6ff;
            color: var(--primary);
        }

        .dropdown svg {
            width: 17px;
            height: 17px;
            color: currentColor;
        }

        /* Hamburger */
        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #334155;
            border-radius: 10px;
        }

        .hamburger:hover {
            background: #f1f5f9;
        }

        .hamburger svg {
            width: 26px;
            height: 26px;
        }

        /* Mobile menu */
        .mobile-menu {
            display: none;
            position: fixed;
            inset: 0 0 auto 0;
            z-index: 99;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
            padding: 88px 24px 24px;
        }

        .mobile-menu.open {
            display: block;
        }

        .mobile-menu a.m-link {
            display: block;
            padding: 14px 4px;
            font-size: 16px;
            font-weight: 600;
            color: var(--ink);
            border-bottom: 1px solid #f1f5f9;
        }

        .mobile-menu a.m-link:hover {
            color: var(--primary);
        }

        .mobile-menu .m-auth {
            margin-top: 20px;
            display: grid;
            gap: 12px;
        }

        .mobile-menu .m-user {
            padding: 14px 16px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid var(--line);
        }

        .mobile-menu .m-user .mu-name {
            font-weight: 700;
            color: var(--ink);
        }

        .mobile-menu .m-user .mu-email {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        .mobile-menu .m-user a,
        .mobile-menu .m-user button {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px 14px;
            cursor: pointer;
            font-family: inherit;
        }

        .mobile-menu .m-user a:hover,
        .mobile-menu .m-user button:hover {
            color: var(--primary);
            border-color: #bfdbfe;
        }

        /* ---------- HERO ---------- */
        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(600px 380px at 12% 8%, rgba(37, 99, 235, 0.14), transparent 60%),
                radial-gradient(700px 420px at 92% 20%, rgba(79, 70, 229, 0.10), transparent 60%),
                linear-gradient(180deg, #eef4ff 0%, #f8fafc 100%);
        }

        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(37, 99, 235, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, 0.06) 1px, transparent 1px);
            background-size: 44px 44px;
            -webkit-mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, #000 40%, transparent 75%);
            mask-image: radial-gradient(ellipse 80% 70% at 50% 30%, #000 40%, transparent 75%);
        }

        .hero-inner {
            position: relative;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            align-items: center;
            gap: 48px;
            padding: 88px 0 110px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 14px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid #dbeafe;
            color: var(--primary);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 22px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);
        }

        .hero-badge svg {
            width: 15px;
            height: 15px;
        }

        .hero h1 {
            font-size: 50px;
            line-height: 1.12;
            letter-spacing: -0.03em;
            font-weight: 800;
            color: var(--ink);
        }

        .hero h1 .hl {
            background: linear-gradient(120deg, var(--primary), #4f46e5);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }

        .hero p.lead {
            margin-top: 20px;
            font-size: 17px;
            line-height: 1.75;
            color: var(--slate);
            max-width: 520px;
        }

        .hero-actions {
            margin-top: 32px;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-stats {
            margin-top: 40px;
            display: flex;
            align-items: center;
            gap: 26px;
            flex-wrap: wrap;
        }

        .hero-stats .hs {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: var(--muted);
            font-weight: 500;
        }

        .hero-stats .hs svg {
            width: 18px;
            height: 18px;
            color: var(--primary);
        }

        /* Hero visual (3D) */
        .hero-visual {
            position: relative;
            perspective: 1300px;
            display: flex;
            justify-content: center;
        }

        .dash-card {
            width: 100%;
            max-width: 460px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 40px 80px -18px rgba(37, 99, 235, 0.25);
            transform: rotateX(8deg) rotateY(-9deg) rotateZ(1deg);
            transform-style: preserve-3d;
            transition: transform 0.45s ease, box-shadow 0.45s ease;
            position: relative;
            z-index: 2;
        }

        .hero-visual:hover .dash-card {
            transform: rotateX(3deg) rotateY(-4deg) rotateZ(0.5deg);
            box-shadow: 0 46px 90px -18px rgba(37, 99, 235, 0.32);
        }

        .dc-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .dc-dots {
            display: flex;
            gap: 6px;
        }

        .dc-dots span {
            width: 10px;
            height: 10px;
            border-radius: 999px;
        }

        .dc-dots span:nth-child(1) { background: #f87171; }
        .dc-dots span:nth-child(2) { background: #fbbf24; }
        .dc-dots span:nth-child(3) { background: #34d399; }

        .dc-top .dc-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .dc-greeting {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #eff6ff, #eef2ff);
            border: 1px solid #dbeafe;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 16px;
        }

        .dc-greeting .g-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
        }

        .dc-greeting .g-avatar svg {
            width: 17px;
            height: 17px;
        }

        .dc-greeting .g-text p {
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
        }

        .dc-greeting .g-text strong {
            font-size: 14px;
            color: var(--ink);
        }

        .dc-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .dc-stat {
            background: #f8fafc;
            border: 1px solid #eef2f7;
            border-radius: 14px;
            padding: 13px;
        }

        .dc-stat .ds-head {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 9px;
        }

        .dc-stat .ds-head svg {
            width: 14px;
            height: 14px;
            color: var(--primary);
        }

        .skeleton {
            background: linear-gradient(90deg, #eef2f7 25%, #e2e8f0 50%, #eef2f7 75%);
            background-size: 200% 100%;
            animation: shimmer 1.6s infinite;
            border-radius: 6px;
            height: 9px;
        }

        .skeleton.w-60 { width: 60%; }
        .skeleton.w-45 { width: 45%; }
        .skeleton.w-75 { width: 75%; }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .dc-chart {
            background: #fff;
            border: 1px solid #eef2f7;
            border-radius: 14px;
            padding: 14px;
        }

        .dc-chart .ch-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 12px;
        }

        .ch-head .ch-tag {
            font-size: 10.5px;
            font-weight: 600;
            color: #059669;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 3px 8px;
            border-radius: 999px;
        }

        .ch-bars {
            display: flex;
            align-items: flex-end;
            gap: 10px;
            height: 70px;
        }

        .ch-bars .bar {
            flex: 1;
            border-radius: 6px 6px 3px 3px;
            background: linear-gradient(180deg, #60a5fa, #3b82f6);
            opacity: 0.9;
        }

        .ch-bars .bar.b1 { height: 38%; }
        .ch-bars .bar.b2 { height: 62%; }
        .ch-bars .bar.b3 { height: 48%; }
        .ch-bars .bar.b4 { height: 82%; }
        .ch-bars .bar.b5 { height: 60%; }
        .ch-bars .bar.b6 { height: 95%; }
        .ch-bars .bar.alt { background: linear-gradient(180deg, #a5b4fc, #6366f1); }

        .dc-legend {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 12px;
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
        }

        .dc-legend span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .dc-legend i {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            display: inline-block;
        }

        .dc-legend i.a { background: #3b82f6; }
        .dc-legend i.b { background: #6366f1; }

        .chip-preview {
            position: absolute;
            top: 0;
            right: -14px;
            transform: translateZ(60px);
            z-index: 3;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--ink);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
        }

        .chip i {
            width: 9px;
            height: 9px;
            border-radius: 999px;
            display: inline-block;
        }

        .chip.i-green i { background: #10b981; }
        .chip.i-blue i { background: #3b82f6; }

        .floating-card {
            position: absolute;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
            padding: 14px 16px;
            z-index: 1;
        }

        .floating-card .fc-top {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: var(--ink);
        }

        .floating-card .fc-top svg {
            width: 15px;
            height: 15px;
            color: var(--primary);
        }

        .floating-card .fc-line {
            margin-top: 10px;
            width: 110px;
            height: 8px;
            border-radius: 6px;
            background: #eef2f7;
        }

        .floating-card .fc-line.half {
            width: 72px;
        }

        .fc-r {
            bottom: 14px;
            right: -26px;
            transform: rotateY(18deg) rotateX(-6deg);
        }

        .fc-l {
            bottom: -18px;
            left: -22px;
            transform: rotateY(-14deg) rotateX(6deg);
        }

        .preview-tag {
            position: absolute;
            top: 18px;
            left: -6px;
            z-index: 3;
            background: var(--navy);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            border-radius: 999px;
            padding: 6px 12px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25);
        }

        /* ---------- SECTIONS ---------- */
        .section {
            padding: 96px 0;
        }

        .section-head {
            text-align: center;
            max-width: 620px;
            margin: 0 auto 56px;
        }

        .section-head .eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
        }

        .section-head h2 {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
        }

        .section-head p {
            margin-top: 14px;
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
        }

        /* Features */
        .feat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feat-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 28px 26px;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .feat-card:hover {
            transform: translateY(-5px);
            border-color: #bfdbfe;
            box-shadow: 0 22px 40px rgba(37, 99, 235, 0.10);
        }

        .feat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .feat-icon svg {
            width: 26px;
            height: 26px;
        }

        .feat-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feat-card p {
            font-size: 14.5px;
            line-height: 1.7;
            color: var(--muted);
        }

        .feat-card .soon-badge {
            display: inline-block;
            margin-top: 14px;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            background: #f1f5f9;
            border-radius: 999px;
            padding: 4px 10px;
        }

        /* About */
        .about-section {
            background: var(--bg-soft);
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
            align-items: center;
        }

        .about-grid h2 {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .about-grid p {
            font-size: 16px;
            line-height: 1.8;
            color: var(--slate);
            margin-bottom: 16px;
        }

        .about-list {
            display: grid;
            gap: 16px;
        }

        .about-list .al-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 16px 18px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .about-list .al-item:hover {
            transform: translateX(4px);
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.07);
        }

        .al-check {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            background: #ecfdf5;
            color: #059669;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .al-check svg {
            width: 16px;
            height: 16px;
        }

        .al-item strong {
            font-size: 15px;
            color: var(--ink);
            display: block;
        }

        .al-item span {
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.6;
            margin-top: 3px;
            display: block;
        }

        /* ---------- CTA ---------- */
        .cta-section {
            padding: 90px 0;
        }

        .cta-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1e4fd8 0%, #4f46e5 100%);
            border-radius: 28px;
            text-align: center;
            padding: 70px 40px;
            color: #fff;
            box-shadow: 0 40px 80px -20px rgba(37, 99, 235, 0.5);
        }

        .cta-panel::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -80px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .cta-panel::after {
            content: '';
            position: absolute;
            bottom: -140px;
            left: -70px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .cta-panel h2 {
            position: relative;
            z-index: 1;
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .cta-panel p {
            position: relative;
            z-index: 1;
            margin: 14px auto 30px;
            max-width: 460px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
        }

        .cta-panel .btn {
            position: relative;
            z-index: 1;
        }

        .cta-note {
            position: relative;
            z-index: 1;
            margin-top: 16px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* ---------- FOOTER ---------- */
        .site-footer {
            background: var(--navy);
            color: #cbd5e1;
            padding: 64px 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 44px;
        }

        .footer-brand p {
            margin-top: 16px;
            font-size: 14px;
            line-height: 1.8;
            color: #94a3b8;
            max-width: 300px;
        }

        .footer-brand .brand {
            color: #fff;
        }

        .footer-col h4 {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #fff;
            margin-bottom: 16px;
        }

        .footer-col a {
            display: block;
            padding: 7px 0;
            font-size: 14px;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .footer-col a:hover {
            color: #60a5fa;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 20px 0;
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .footer-bottom .made,
        .footer-bottom .made-link {
            font-weight: 700;
            color: #93c5fd;
            transition: color 0.2s ease;
        }

        .footer-bottom .made-link:hover {
            color: #60a5fa;
            text-decoration: underline;
        }

        /* ---------- RESPONSIVE ---------- */
        @media (max-width: 1024px) {
            .hero-inner {
                grid-template-columns: 1fr;
                padding: 64px 0 80px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero-visual {
                margin-top: 30px;
            }

            .feat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links,
            .nav-actions .btn {
                display: none;
            }

            .nav-actions .avatar-wrap {
                display: none;
            }

            .hamburger {
                display: inline-flex;
            }

            .hero {
                padding-top: 20px;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero p.lead {
                font-size: 15.5px;
            }

            .section {
                padding: 72px 0;
            }

            .section-head h2,
            .about-grid h2,
            .cta-panel h2 {
                font-size: 30px;
            }

            .feat-grid {
                grid-template-columns: 1fr;
            }

            .fc-r {
                right: -8px;
            }

            .fc-l {
                left: -8px;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu {
                display: none !important;
            }
        }

        .pop-overlay {
            position: fixed;
            inset: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .6);
            backdrop-filter: blur(4px);
        }

        .pop-overlay.closed {
            display: none;
        }

        .pop-card {
            width: 100%;
            max-width: 380px;
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .35);
            animation: popIn .2s ease-out;
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(.95) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .pop-body {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 22px 24px;
        }

        .pop-icon {
            display: flex;
            flex: 0 0 auto;
            width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eef2ff;
            color: #2563eb;
        }

        .pop-icon svg {
            width: 22px;
            height: 22px;
        }

        .pop-title {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
        }

        .pop-desc {
            margin: 4px 0 0;
            font-size: 13.5px;
            line-height: 1.5;
            color: #64748b;
        }

        .pop-foot {
            display: flex;
            gap: 12px;
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .pop-foot button {
            flex: 1;
            border-radius: 12px;
            padding: 11px 14px;
            font-size: 14px;
            font-weight: 700;
            border: 0;
            cursor: pointer;
        }

        .pop-cancel {
            background: #fff;
            color: #475569;
            border: 1px solid #cbd5e1 !important;
        }

        .pop-cancel:hover {
            background: #f1f5f9;
        }

        .pop-confirm {
            background: linear-gradient(135deg, #1d4ed8, #4f46e5);
            color: #fff;
        }

        .pop-confirm:hover {
            background: linear-gradient(135deg, #1e40af, #4338ca);
        }
    </style>
</head>

<body>

    <!-- = NAVBAR = -->
    <nav class="navbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </span>
                Stockify
            </a>

            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#fitur">Fitur</a>
                <a href="#tentang">Tentang</a>
            </div>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                @else
                    <div class="avatar-wrap" id="profileTrigger">
                        <span class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="name">{{ Auth::user()->name }}</span>
                        <span class="caret">&#9662;</span>

                        <div class="dropdown" id="profileDropdown">
                            <div class="dropdown-head">
                                <p class="d-name">{{ Auth::user()->name }}</p>
                                <p class="d-email">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                            <a href="{{ route('dashboard') }}">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                            <button type="button" class="logout-open icon-danger">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log out
                                </button>
                        </div>
                    </div>
                @endguest
            </div>

            <button class="hamburger" id="hamburger" aria-label="Buka menu">
                <svg id="iconOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="iconClose" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a class="m-link" href="#home">Home</a>
        <a class="m-link" href="#fitur">Fitur</a>
        <a class="m-link" href="#tentang">Tentang</a>

        @guest
            <div class="m-auth">
                <a href="{{ route('login') }}" class="btn btn-outline btn-lg">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
            </div>
        @else
            <div class="m-user">
                <p class="mu-name">{{ Auth::user()->name }}</p>
                <p class="mu-email">{{ Auth::user()->email }}</p>
                <a href="{{ route('profile.edit') }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Profile
                </a>
                <a href="{{ route('dashboard') }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>
                <button type="button" class="logout-open">Log out</button>
            </div>
        @endguest
    </div>

    <!-- = HERO = -->
    <section class="hero" id="home">
        <div class="hero-grid"></div>
        <div class="container hero-inner">
            <div>
                <span class="hero-badge">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Sistem Manajemen Inventaris
                </span>

                <h1>Kelola Inventaris <span class="hl">Lebih Mudah</span> &amp; Teratur</h1>

                <p class="lead">
                    Stockify membantu mengelola data barang, kategori, supplier, dan stok
                    dalam satu sistem yang sederhana dan terorganisir.
                </p>

                <div class="hero-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
                    @endguest
                    <a href="#fitur" class="btn btn-outline btn-lg">Lihat Fitur</a>
                </div>

                <div class="hero-stats">
                    <span class="hs">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Data terpusat &amp; aman
                    </span>
                    <span class="hs">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Responsif &amp; mudah dipakai
                    </span>
                </div>
            </div>

            <div class="hero-visual">
                <span class="preview-tag">Preview UI</span>

                <div class="dash-card">
                    <div class="dc-top">
                        <div class="dc-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <span class="dc-label">Stockify Dashboard</span>
                    </div>

                    <div class="dc-greeting">
                        <span class="g-avatar">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="g-text">
                            <p>Ringkasan inventaris</p>
                            <strong>Selamat datang kembali</strong>
                        </span>
                    </div>

                    <div class="dc-stats">
                        <div class="dc-stat">
                            <div class="ds-head">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Barang
                            </div>
                            <div class="skeleton w-60"></div>
                            <div class="skeleton w-45" style="margin-top:6px;"></div>
                        </div>
                        <div class="dc-stat">
                            <div class="ds-head">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Kategori
                            </div>
                            <div class="skeleton w-75"></div>
                            <div class="skeleton w-45" style="margin-top:6px;"></div>
                        </div>
                    </div>

                    <div class="dc-chart">
                        <div class="ch-head">
                            Aktivitas Stok
                            <span class="ch-tag">● Preview</span>
                        </div>
                        <div class="ch-bars">
                            <span class="bar b1"></span>
                            <span class="bar b2"></span>
                            <span class="bar b3"></span>
                            <span class="bar b4"></span>
                            <span class="bar b5 alt"></span>
                            <span class="bar b6"></span>
                        </div>
                        <div class="dc-legend">
                            <span><i class="a"></i>Masuk</span>
                            <span><i class="b"></i>Keluar</span>
                        </div>
                    </div>
                </div>

                <div class="chip chip-preview i-green">
                    <i></i>
                    Stok Terpantau
                </div>

                <div class="floating-card fc-r">
                    <div class="fc-top">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Laporan Stok
                    </div>
                    <div class="fc-line"></div>
                    <div class="fc-line half" style="margin-top:7px;"></div>
                </div>

                <div class="floating-card fc-l">
                    <div class="fc-top">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kategori Baru
                    </div>
                    <div class="fc-line"></div>
                    <div class="fc-line half" style="margin-top:7px;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- = FITUR = -->
    <section class="section" id="fitur">
        <div class="container">
            <div class="section-head">
                <span class="eyebrow">Fitur Utama</span>
                <h2>Semua Kebutuhan Inventaris dalam Satu Sistem</h2>
                <p>Modul-modul yang dirancang untuk memudahkan pencatatan dan pengelolaan data secara terstruktur.</p>
            </div>

            <div class="feat-grid">
                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3>Manajemen Barang</h3>
                    <p>Kelola data barang dengan informasi yang terstruktur, mudah dicari, dan tetap rapi.</p>
                </div>

                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3>Kategori Barang</h3>
                    <p>Kelompokkan barang berdasarkan kategori agar data lebih mudah dikelola dan diakses.</p>
                </div>

                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3-3 3 3m-3-3v8m-2 8H5a2 2 0 01-2-2v-2a2 2 0 012-2h1m6 0a2 2 0 002 2h1a2 2 0 002-2v-2a2 2 0 00-2-2H9a2 2 0 00-2 2v1m0 3a3 3 0 003 3h4a3 3 0 003-3m-2 0a3 3 0 00-3-3h-2" />
                        </svg>
                    </div>
                    <h3>Supplier</h3>
                    <p>Catat data supplier maupun pemasok barang dalam satu tempat yang terorganisir.</p>
                </div>

                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3>Monitoring Stok</h3>
                    <p>Pantau jumlah stok barang agar kebutuhan dan ketersediaan inventaris lebih terkontrol.</p>
                </div>

                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3>Riwayat Transaksi</h3>
                    <p>Catatan aktivitas keluar-masuk barang yang membantu pelacakan setiap pergerakan.</p>
                </div>

                <div class="feat-card">
                    <div class="feat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3>Keamanan Akses</h3>
                    <p>Data dilindungi sistem autentikasi sehingga hanya pengguna terdaftar yang dapat mengakses.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- = TENTANG = -->
    <section class="section about-section" id="tentang">
        <div class="container about-grid">
            <div>
                <span class="eyebrow">Tentang Stockify</span>
                <h2>Sistem yang Membantu Inventaris Lebih Terorganisir</h2>
                <p>
                    Stockify merupakan website manajemen inventaris yang dirancang untuk membantu
                    proses pencatatan dan pengelolaan data barang secara lebih teratur. Seluruh data
                    dikelola dalam satu sistem yang mudah digunakan kapan saja.
                </p>
                <p>
                    Dibangun menggunakan Laravel, Stockify telah dilengkapi modul lengkap: autentikasi
                    pengguna, manajemen kategori, barang, supplier, pencatatan stok masuk dan keluar,
                    serta monitoring dan laporan stok untuk kebutuhan inventaris yang terus berkembang.
                </p>
            </div>

            <div class="about-list">
                <div class="al-item">
                    <span class="al-check">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <div>
                        <strong>Data terpusat</strong>
                        <span>Semua informasi inventoradisimpan di satu tempat agar mudah dikelola.</span>
                    </div>
                </div>
                <div class="al-item">
                    <span class="al-check">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <div>
                        <strong>Mudah digunakan</strong>
                        <span>Antarmuka sederhana dan responsif untuk semua perangkat.</span>
                    </div>
                </div>
                <div class="al-item">
                    <span class="al-check">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <div>
                        <strong>Tumbuh bertahap</strong>
                        <span>Fitur baru terus dikembangkan sesuai kebutuhan inventaris Anda.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- = CTA = -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-panel">
                <h2>Siap Mengelola Inventaris?</h2>
                <p>Mulai kelola data inventaris dengan lebih mudah dan terorganisir bersama Stockify.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg">Mulai Sekarang</a>
                    <p class="cta-note">Gratis daftar · Tanpa biaya untuk memulai</p>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-white btn-lg">Ke Dashboard</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- = FOOTER = -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="brand">
                        <span class="brand-mark">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        Stockify
                    </a>
                    <p>Sistem manajemen inventaris yang membantu pengelolaan barang, kategori, supplier, dan stok dalam satu platform.</p>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <a href="#home">Home</a>
                    <a href="#fitur">Fitur</a>
                    <a href="#tentang">Tentang</a>
                </div>

                <div class="footer-col">
                    <h4>Akun</h4>
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @else
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('profile.edit') }}">Profile</a>
                    @endguest
                </div>

                <div class="footer-col">
                    <h4>Modul</h4>
                    <a href="{{ route('categories.index') }}">Kategori Barang</a>
                    <a href="{{ route('stok.monitoring.index') }}">Monitoring Stok</a>
                </div>
            </div>

            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} Stockify. All rights reserved.</span>
                <a href="https://www.instagram.com/jlaahaura?igsi=Mjc0dWJqemt1bWlj"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="made made-link">
                    by: najla 💙
                </a>
            </div>
        </div>
    </footer>

    <!-- Logout confirmation modal -->
    <div class="pop-overlay closed" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="logoutTitle">
        <div class="pop-card">
            <div class="pop-body">
                <div class="pop-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <div>
                    <h3 class="pop-title" id="logoutTitle">Yakin ingin keluar?</h3>
                    <p class="pop-desc">Anda akan keluar dari akun Stockify.</p>
                </div>
            </div>
            <div class="pop-foot">
                <button type="button" class="pop-cancel" id="logoutCancel">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="pop-confirm">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var burger = document.getElementById('hamburger');
            var menu = document.getElementById('mobileMenu');
            var iconOpen = document.getElementById('iconOpen');
            var iconClose = document.getElementById('iconClose');

            if (burger && menu) {
                burger.addEventListener('click', function () {
                    var isOpen = menu.classList.toggle('open');
                    iconOpen.style.display = isOpen ? 'none' : 'inline-block';
                    iconClose.style.display = isOpen ? 'inline-block' : 'none';
                    document.body.style.overflow = isOpen ? 'hidden' : '';
                });

                menu.querySelectorAll('a.m-link').forEach(function (link) {
                    link.addEventListener('click', function () {
                        menu.classList.remove('open');
                        iconOpen.style.display = 'inline-block';
                        iconClose.style.display = 'none';
                        document.body.style.overflow = '';
                    });
                });

                window.addEventListener('resize', function () {
                    if (window.innerWidth >= 769 && menu.classList.contains('open')) {
                        menu.classList.remove('open');
                        iconOpen.style.display = 'inline-block';
                        iconClose.style.display = 'none';
                        document.body.style.overflow = '';
                    }
                });
            }

            var trigger = document.getElementById('profileTrigger');
            var dropdown = document.getElementById('profileDropdown');

            if (trigger && dropdown) {
                trigger.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('open');
                });

                document.addEventListener('click', function (e) {
                    if (!trigger.contains(e.target)) {
                        dropdown.classList.remove('open');
                    }
                });
            }

            var logoutModal = document.getElementById('logoutModal');
            var logoutCancel = document.getElementById('logoutCancel');

            function openLogout() {
                if (!logoutModal) return;
                logoutModal.classList.remove('closed');
                document.body.style.overflow = 'hidden';
                if (menu && menu.classList.contains('open')) {
                    menu.classList.remove('open');
                    iconOpen.style.display = 'inline-block';
                    iconClose.style.display = 'none';
                }
            }

            function closeLogout() {
                if (!logoutModal) return;
                logoutModal.classList.add('closed');
                document.body.style.overflow = '';
            }

            document.querySelectorAll('.logout-open').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    closeLogout();
                    openLogout();
                });
            });

            if (logoutCancel) {
                logoutCancel.addEventListener('click', closeLogout);
            }

            if (logoutModal) {
                logoutModal.addEventListener('click', function (e) {
                    if (e.target === logoutModal) {
                        closeLogout();
                    }
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        closeLogout();
                    }
                });
            }
        })();
    </script>

</body>
</html>