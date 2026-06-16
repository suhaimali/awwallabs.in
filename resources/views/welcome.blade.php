<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SUHAIM SOFT LAB') }} | Advanced Laboratory Information System</title>
    <meta name="description" content="{{ config('app.name', 'SUHAIM SOFT LAB') }} is a cutting-edge Laboratory Information Management System (LIMS) built for diagnostic centers to automate medical testing, manage patients, and deliver reports instantly.">
    <meta name="keywords" content="laboratory management system, lims, lab software, diagnostics LIS, medical reports automation, suhaim soft lab">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ config('app.name', 'SUHAIM SOFT LAB') }} | Advanced Laboratory Information System">
    <meta property="og:description" content="Empower your diagnostic center with our cutting-edge LIMS.">
    <meta property="og:image" content="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy:       #050d1a;
            --navy-mid:   #0a1628;
            --navy-light: #0f2040;
            --blue:       #1e6fff;
            --blue-bright:#3d8eff;
            --cyan:       #00c8ff;
            --teal:       #00e5c0;
            --glass:      rgba(255,255,255,0.05);
            --glass-b:    rgba(255,255,255,0.10);
            --white:      #ffffff;
            --grey:       #a8b8d0;
            --card-bg:    rgba(14,28,56,0.85);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; overflow-x: hidden; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════
           SCROLLBAR
        ═══════════════════════════════════════ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--navy); }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 10px; }

        /* ═══════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════ */
        .lnav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 16px 0;
            background: transparent;
            transition: background 0.4s, padding 0.4s, box-shadow 0.4s;
        }
        .lnav.scrolled {
            background: rgba(5, 13, 26, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.4);
            border-bottom: 1px solid rgba(30, 111, 255, 0.15);
        }
        .lnav .container { display: flex; align-items: center; justify-content: space-between; }
        .lnav-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--white) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.3px;
        }
        .lnav-brand .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 0 20px rgba(30, 111, 255, 0.4);
        }
        .lnav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }
        .lnav-links a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 7px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .lnav-links a:hover { color: var(--white); background: var(--glass-b); }
        .lnav-links a.active { color: var(--cyan); }
        .lnav-cta {
            display: flex; align-items: center; gap: 10px;
        }
        .btn-ghost {
            background: var(--glass-b);
            border: 1px solid rgba(255,255,255,0.12);
            color: var(--white);
            font-size: 14px;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.15); color: var(--white); border-color: rgba(255,255,255,0.25); }
        .btn-primary-glow {
            background: linear-gradient(135deg, var(--blue), var(--blue-bright));
            color: var(--white);
            font-size: 14px;
            font-weight: 700;
            padding: 9px 22px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 0 20px rgba(30,111,255,0.4);
            transition: all 0.25s;
            cursor: pointer;
        }
        .btn-primary-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 35px rgba(30,111,255,0.6);
            color: var(--white);
        }

        /* Hamburger */
        .lnav-toggle {
            display: none;
            background: none;
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 4px;
            position: fixed;
            top: 68px; left: 0; right: 0;
            background: rgba(5,13,26,0.98);
            backdrop-filter: blur(20px);
            padding: 16px 20px 24px;
            z-index: 999;
            border-bottom: 1px solid rgba(30,111,255,0.15);
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .mobile-menu a:hover { background: var(--glass-b); color: var(--white); }

        /* ═══════════════════════════════════════
           HERO
        ═══════════════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 100px 0 80px;
            background: radial-gradient(ellipse 80% 60% at 50% -10%, rgba(30,111,255,0.25) 0%, transparent 60%),
                        radial-gradient(ellipse 50% 40% at 90% 60%, rgba(0,200,255,0.1) 0%, transparent 60%),
                        var(--navy);
        }
        /* Animated lab grid */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(30,111,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(30,111,255,0.06) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 30%, transparent 80%);
        }
        /* Floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            animation: orbFloat 8s ease-in-out infinite;
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(30,111,255,0.12); top: -100px; left: -150px; animation-delay: 0s; }
        .orb-2 { width: 350px; height: 350px; background: rgba(0,200,255,0.08); bottom: -50px; right: -80px; animation-delay: 3s; }
        .orb-3 { width: 250px; height: 250px; background: rgba(0,229,192,0.06); top: 40%; left: 60%; animation-delay: 1.5s; }
        @keyframes orbFloat {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(30,111,255,0.12);
            border: 1px solid rgba(30,111,255,0.3);
            color: var(--cyan);
            font-size: 13px;
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 50px;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
            animation: fadeUp 0.6s ease both;
        }
        .hero-badge .dot {
            width: 7px; height: 7px;
            background: var(--cyan);
            border-radius: 50%;
            animation: pulse-dot 2s ease infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.5); }
        }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.4rem, 5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 24px;
            animation: fadeUp 0.7s 0.1s ease both;
        }
        .hero h1 .grad {
            background: linear-gradient(90deg, var(--blue-bright), var(--cyan), var(--teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p.lead {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--grey);
            line-height: 1.8;
            max-width: 580px;
            margin-bottom: 40px;
            animation: fadeUp 0.7s 0.2s ease both;
        }
        .hero-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 60px;
            animation: fadeUp 0.7s 0.3s ease both;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--blue), var(--blue-bright));
            color: white;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 30px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 0 30px rgba(30,111,255,0.45), 0 4px 15px rgba(0,0,0,0.3);
            transition: all 0.25s;
        }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 0 50px rgba(30,111,255,0.65), 0 8px 25px rgba(0,0,0,0.3); color: white; }
        .btn-hero-secondary {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.18);
            color: white;
            font-weight: 600;
            font-size: 15px;
            padding: 14px 30px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 10px;
            transition: all 0.25s;
            backdrop-filter: blur(10px);
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.3); color: white; transform: translateY(-2px); }

        /* Hero stats */
        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            animation: fadeUp 0.7s 0.4s ease both;
        }
        .h-stat { display: flex; flex-direction: column; gap: 4px; }
        .h-stat-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--cyan), var(--teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }
        .h-stat-label { font-size: 12px; color: var(--grey); font-weight: 500; letter-spacing: 0.3px; }

        /* Hero visual - right side lab illustration */
        .hero-visual {
            position: relative;
            animation: fadeUp 0.7s 0.3s ease both;
        }
        .hero-visual-card {
            background: var(--card-bg);
            border: 1px solid rgba(30,111,255,0.2);
            border-radius: 24px;
            padding: 28px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.04);
        }
        .hvc-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .hvc-dot { width: 10px; height: 10px; border-radius: 50%; }
        .hvc-label { font-size: 13px; font-weight: 600; color: var(--grey); margin-left: auto; }
        .hvc-stat-row { display: flex; justify-content: space-between; margin-bottom: 16px; align-items: center; }
        .hvc-stat-name { font-size: 13px; color: var(--grey); }
        .hvc-stat-val { font-size: 13px; font-weight: 700; }
        .hvc-bar-track { height: 6px; border-radius: 10px; background: rgba(255,255,255,0.07); flex: 1; margin: 0 14px; overflow: hidden; }
        .hvc-bar-fill { height: 100%; border-radius: 10px; animation: barGrow 1.5s ease forwards; }
        @keyframes barGrow { from { width: 0; } }

        .float-pill {
            position: absolute;
            background: var(--card-bg);
            border: 1px solid rgba(30,111,255,0.25);
            border-radius: 50px;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            white-space: nowrap;
        }
        .float-pill .pill-icon {
            width: 32px; height: 32px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .fp-1 { top: -20px; right: -20px; animation: floatPill 4s ease-in-out infinite; }
        .fp-2 { bottom: 30px; left: -30px; animation: floatPill 5s 1s ease-in-out infinite; }
        @keyframes floatPill {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ═══════════════════════════════════════
           SECTION COMMONS
        ═══════════════════════════════════════ */
        section { position: relative; }
        .sec-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(30,111,255,0.1);
            border: 1px solid rgba(30,111,255,0.25);
            color: var(--cyan);
            font-size: 12px; font-weight: 700;
            padding: 6px 14px; border-radius: 50px;
            letter-spacing: 0.8px; text-transform: uppercase;
            margin-bottom: 16px;
        }
        .sec-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.15;
            color: var(--white);
            margin-bottom: 16px;
        }
        .sec-title .grad {
            background: linear-gradient(90deg, var(--blue-bright), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sec-sub {
            font-size: 1rem;
            color: var(--grey);
            line-height: 1.75;
            max-width: 520px;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════════════
           SECTION: METRICS STRIP
        ═══════════════════════════════════════ */
        .metrics-strip {
            padding: 0;
            background: linear-gradient(180deg, var(--navy) 0%, var(--navy-mid) 100%);
        }
        .metrics-inner {
            border-top: 1px solid rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .metric-item {
            flex: 1; min-width: 180px;
            padding: 40px 30px;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.05);
            position: relative;
        }
        .metric-item:last-child { border-right: none; }
        .metric-num {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--blue-bright), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 8px;
        }
        .metric-label { font-size: 13px; color: var(--grey); font-weight: 500; }

        /* ═══════════════════════════════════════
           SECTION: HOW IT WORKS
        ═══════════════════════════════════════ */
        .how-section {
            padding: 110px 0;
            background: var(--navy-mid);
        }
        .step-card {
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 36px 30px;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s, transform 0.3s;
        }
        .step-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(30,111,255,0.08) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .step-card:hover { border-color: rgba(30,111,255,0.35); transform: translateY(-6px); }
        .step-card:hover::before { opacity: 1; }
        .step-num {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, rgba(30,111,255,0.3), rgba(0,200,255,0.15));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
        }
        .step-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .step-card h4 { font-weight: 700; font-size: 1.1rem; margin-bottom: 12px; color: var(--white); }
        .step-card p { font-size: 14px; color: var(--grey); line-height: 1.7; margin: 0; }

        /* ═══════════════════════════════════════
           SECTION: FEATURES
        ═══════════════════════════════════════ */
        .features-section {
            padding: 110px 0;
            background: var(--navy);
        }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .feat-card {
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .feat-card:hover { border-color: rgba(30,111,255,0.3); transform: translateY(-5px); }
        .feat-card.featured {
            background: linear-gradient(135deg, rgba(30,111,255,0.15), rgba(0,200,255,0.05));
            border-color: rgba(30,111,255,0.35);
            grid-column: span 1;
        }
        .feat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .feat-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: 10px; color: var(--white); }
        .feat-card p { font-size: 13.5px; color: var(--grey); line-height: 1.7; margin: 0; }
        .feat-glow {
            position: absolute;
            width: 120px; height: 120px;
            border-radius: 50%;
            filter: blur(60px);
            bottom: -40px; right: -40px;
            pointer-events: none;
            opacity: 0.3;
        }

        /* ═══════════════════════════════════════
           SECTION: BENEFITS / STATS
        ═══════════════════════════════════════ */
        .benefits-section {
            padding: 110px 0;
            background: linear-gradient(180deg, var(--navy-mid) 0%, var(--navy-light) 100%);
            position: relative;
            overflow: hidden;
        }
        .benefits-section::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30,111,255,0.08) 0%, transparent 70%);
            top: -200px; right: -200px;
        }
        .benefit-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 36px 28px;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }
        .benefit-card:hover { background: rgba(30,111,255,0.08); border-color: rgba(30,111,255,0.3); transform: translateY(-6px); }
        .benefit-icon {
            width: 62px; height: 62px;
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
            margin: 0 auto 20px;
        }
        .benefit-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--blue-bright), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            line-height: 1;
        }
        .benefit-card h5 { font-weight: 700; font-size: 1rem; margin-bottom: 10px; color: var(--white); }
        .benefit-card p { font-size: 13px; color: var(--grey); margin: 0; line-height: 1.6; }

        /* ═══════════════════════════════════════
           SECTION: WORKFLOW MARQUEE
        ═══════════════════════════════════════ */
        .marquee-section {
            padding: 60px 0;
            background: var(--navy);
            overflow: hidden;
        }
        .marquee-track { display: flex; gap: 20px; width: max-content; animation: marquee 30s linear infinite; }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-item {
            display: flex; align-items: center; gap: 12px;
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 50px;
            padding: 12px 22px;
            white-space: nowrap;
            font-size: 14px;
            font-weight: 600;
            color: var(--grey);
        }
        .marquee-item i { color: var(--cyan); }
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ═══════════════════════════════════════
           CTA SECTION
        ═══════════════════════════════════════ */
        .cta-section {
            padding: 100px 0;
            background: var(--navy-light);
        }
        .cta-box {
            background: linear-gradient(135deg, rgba(30,111,255,0.15) 0%, rgba(0,200,255,0.08) 100%);
            border: 1px solid rgba(30,111,255,0.3);
            border-radius: 28px;
            padding: 70px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-box::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30,111,255,0.12), transparent 70%);
            top: -100px; left: -100px;
        }
        .cta-box::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,229,192,0.08), transparent 70%);
            bottom: -80px; right: -80px;
        }
        .cta-box h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
            position: relative; z-index: 1;
        }
        .cta-box p { color: var(--grey); font-size: 1rem; margin-bottom: 36px; max-width: 500px; margin-left: auto; margin-right: auto; position: relative; z-index: 1; }
        .cta-btns { display: flex; justify-content: center; flex-wrap: wrap; gap: 14px; position: relative; z-index: 1; }

        /* ═══════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════ */
        .lfooter {
            background: var(--navy);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 64px 0 30px;
        }
        .footer-brand-logo {
            display: flex; align-items: center; gap: 12px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--white);
            text-decoration: none;
            margin-bottom: 16px;
        }
        .footer-brand-logo .fb-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--blue), var(--cyan));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }
        .lfooter p { color: var(--grey); font-size: 14px; line-height: 1.7; max-width: 280px; margin-bottom: 24px; }
        .footer-social { display: flex; gap: 10px; }
        .footer-social a {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; justify-content: center;
            color: var(--grey);
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .footer-social a:hover { background: var(--blue); border-color: var(--blue); color: white; transform: translateY(-3px); }
        .footer-col h6 { font-weight: 700; font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 18px; }
        .footer-col ul { list-style: none; padding: 0; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a { color: var(--grey); text-decoration: none; font-size: 14px; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--cyan); }
        .contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; }
        .contact-item i { color: var(--cyan); font-size: 13px; margin-top: 3px; flex-shrink: 0; }
        .contact-item span { font-size: 13.5px; color: var(--grey); line-height: 1.5; }
        .contact-item a { color: var(--grey); text-decoration: none; }
        .contact-item a:hover { color: var(--cyan); }
        .footer-bottom {
            margin-top: 50px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .footer-bottom p { color: rgba(255,255,255,0.35); font-size: 13px; margin: 0; }
        .footer-bottom a { color: var(--cyan); text-decoration: none; }

        /* ═══════════════════════════════════════
           FLOATING BUTTONS
        ═══════════════════════════════════════ */
        .fab-wrap { position: fixed; bottom: 28px; right: 28px; z-index: 900; display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }
        .fab-btn {
            width: 52px; height: 52px;
            border-radius: 16px;
            border: none;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
        }
        .fab-wa { background: #25d366; color: white; box-shadow: 0 4px 20px rgba(37,211,102,0.4); }
        .fab-wa:hover { transform: scale(1.1); box-shadow: 0 8px 30px rgba(37,211,102,0.5); color: white; }
        .fab-top { background: var(--blue); color: white; box-shadow: 0 4px 20px rgba(30,111,255,0.4); display: none; }
        .fab-top:hover { transform: scale(1.1); box-shadow: 0 8px 30px rgba(30,111,255,0.5); }
        .fab-top.visible { display: flex; }

        /* WhatsApp popup */
        .wa-popup {
            position: fixed;
            bottom: 92px; right: 28px;
            width: 300px;
            background: var(--navy-mid);
            border: 1px solid rgba(30,111,255,0.25);
            border-radius: 18px;
            overflow: hidden;
            z-index: 901;
            display: none;
            animation: slideUp 0.3s ease;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        .wa-popup.open { display: block; }
        .wa-popup-head {
            background: linear-gradient(135deg, var(--blue), #0052cc);
            padding: 16px 18px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .wa-popup-head span { font-weight: 700; font-size: 14px; }
        .wa-popup-head button { background: none; border: none; color: rgba(255,255,255,0.7); font-size: 18px; cursor: pointer; }
        .wa-popup-body { padding: 18px; }
        .wa-bubble { background: rgba(255,255,255,0.05); border-radius: 4px 14px 14px 14px; padding: 14px; font-size: 13.5px; color: var(--grey); line-height: 1.6; }
        .wa-popup-foot { padding: 14px 18px 18px; }
        .wa-popup-foot a {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            background: #25d366;
            color: white;
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .wa-popup-foot a:hover { background: #1da851; color: white; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* ═══════════════════════════════════════
           MODAL
        ═══════════════════════════════════════ */
        .enroll-modal .modal-content {
            background: var(--navy-mid);
            border: 1px solid rgba(30,111,255,0.25);
            border-radius: 22px;
        }
        .enroll-modal .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 22px 28px 16px;
        }
        .enroll-modal .modal-title { font-weight: 800; font-size: 1.2rem; }
        .enroll-modal .modal-body { padding: 16px 28px 28px; }
        .enroll-modal .form-label { font-size: 13px; font-weight: 600; color: var(--grey); margin-bottom: 6px; }
        .enroll-modal .form-control {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: var(--white);
            padding: 12px 14px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        .enroll-modal .form-control:focus { border-color: var(--blue); background: rgba(30,111,255,0.05); box-shadow: 0 0 0 3px rgba(30,111,255,0.15); color: white; }
        .enroll-modal .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .enroll-modal .btn-close { filter: invert(1) grayscale(1); }
        .btn-enroll-submit {
            background: linear-gradient(135deg, var(--blue), var(--blue-bright));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.25s;
            box-shadow: 0 0 20px rgba(30,111,255,0.3);
        }
        .btn-enroll-submit:hover { box-shadow: 0 0 35px rgba(30,111,255,0.5); transform: translateY(-2px); color: white; }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 991px) {
            .lnav-links, .lnav-cta { display: none; }
            .lnav-toggle { display: block; }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
            .metric-item { min-width: 140px; padding: 28px 16px; }
        }
        @media (max-width: 767px) {
            .hero { padding: 100px 0 60px; text-align: center; }
            .hero p.lead { margin-left: auto; margin-right: auto; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; }
            .hero-visual { margin-top: 50px; }
            .fp-1, .fp-2 { display: none; }
            .feat-grid { grid-template-columns: 1fr; }
            .cta-box { padding: 48px 24px; }
            .lfooter .row > div { margin-bottom: 36px; }
            .metric-item { min-width: 50%; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.05); }
        }
        @media (max-width: 480px) {
            .hero h1 { font-size: 2rem; }
            .hero p.lead { font-size: 0.95rem; }
            .btn-hero-primary, .btn-hero-secondary { width: 100%; justify-content: center; }
            .fab-wrap { bottom: 18px; right: 18px; }
        }

        /* Tooltip on hover for feature cards */
        .feat-card .tag-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(0,200,255,0.1);
            border: 1px solid rgba(0,200,255,0.2);
            color: var(--cyan);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            margin-top: 14px;
            letter-spacing: 0.3px;
        }

        /* ═══════════════════════════════════════
           3D LAB SCENE
        ═══════════════════════════════════════ */
        .lab3d-scene {
            position: relative;
            width: 100%;
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 900px;
        }

        /* Subtle ambient glow beneath the 3D object */
        .lab3d-glow {
            position: absolute;
            width: 280px; height: 80px;
            background: radial-gradient(ellipse, rgba(30,111,255,0.35) 0%, transparent 70%);
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            filter: blur(18px);
            border-radius: 50%;
            animation: glowPulse 3s ease-in-out infinite;
            z-index: 0;
        }
        @keyframes glowPulse {
            0%,100% { opacity: 0.7; transform: translateX(-50%) scaleX(1); }
            50%      { opacity: 1;   transform: translateX(-50%) scaleX(1.15); }
        }

        /* The 3D cube wrapper */
        .cube-wrap {
            position: relative;
            z-index: 2;
            width: 200px; height: 200px;
            transform-style: preserve-3d;
            animation: rotateCube 14s linear infinite;
        }
        @keyframes rotateCube {
            0%   { transform: rotateX(-20deg) rotateY(0deg); }
            100% { transform: rotateX(-20deg) rotateY(360deg); }
        }
        .cube-wrap:hover { animation-play-state: paused; }

        /* Six faces of the cube */
        .cube-face {
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 22px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid rgba(30,111,255,0.3);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .cube-face i   { font-size: 2.8rem; }
        .cube-face span { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.8); letter-spacing: 0.3px; }

        /* face backgrounds — each face a different lab-themed colour tint */
        .cf-front  { background: rgba(30,111,255,0.14);  transform: translateZ(100px); }
        .cf-back   { background: rgba(0,229,192,0.10);   transform: rotateY(180deg) translateZ(100px); }
        .cf-right  { background: rgba(0,200,255,0.11);   transform: rotateY(90deg)  translateZ(100px); }
        .cf-left   { background: rgba(168,85,247,0.10);  transform: rotateY(-90deg) translateZ(100px); }
        .cf-top    { background: rgba(251,191,36,0.10);  transform: rotateX(90deg)  translateZ(100px); }
        .cf-bottom { background: rgba(239,68,68,0.08);   transform: rotateX(-90deg) translateZ(100px); }

        /* Floating stat badges around the cube */
        .lab3d-badge {
            position: absolute;
            background: rgba(10,22,40,0.92);
            border: 1px solid rgba(30,111,255,0.28);
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.35);
            z-index: 10;
            white-space: nowrap;
        }
        .lab3d-badge .b-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }
        .lab3d-badge .b-text { display: flex; flex-direction: column; gap: 2px; }
        .lab3d-badge .b-val  { font-family: 'Space Grotesk',sans-serif; font-size: 1.1rem; font-weight: 800; line-height: 1; }
        .lab3d-badge .b-lbl  { font-size: 11px; color: var(--grey); font-weight: 500; }

        /* Badge positions & animations */
        .lb-1 { top: 10px;  left: -10px;  animation: badgeFloat1 4s ease-in-out infinite; }
        .lb-2 { top: 10px;  right: -10px; animation: badgeFloat2 5s 0.5s ease-in-out infinite; }
        .lb-3 { bottom: 40px; left: -10px;  animation: badgeFloat1 4.5s 1s ease-in-out infinite; }
        .lb-4 { bottom: 40px; right: -10px; animation: badgeFloat2 5.5s 1.5s ease-in-out infinite; }

        @keyframes badgeFloat1 {
            0%,100% { transform: translateY(0px);  }
            50%      { transform: translateY(-10px); }
        }
        @keyframes badgeFloat2 {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(10px); }
        }

        /* Orbiting ring */
        .orbit-ring {
            position: absolute;
            width: 300px; height: 300px;
            border: 1px dashed rgba(30,111,255,0.18);
            border-radius: 50%;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%) rotateX(75deg);
            animation: orbitSpin 20s linear infinite;
            z-index: 1;
        }
        .orbit-ring::before {
            content: '';
            position: absolute;
            width: 12px; height: 12px;
            background: var(--cyan);
            border-radius: 50%;
            box-shadow: 0 0 14px var(--cyan);
            top: -6px; left: 50%;
            transform: translateX(-50%);
        }
        @keyframes orbitSpin { from{transform:translate(-50%,-50%) rotateX(75deg) rotateZ(0deg);} to{transform:translate(-50%,-50%) rotateX(75deg) rotateZ(360deg);} }
    </style>
</head>
<body>

<!-- ══════════════════════════════
     NAVIGATION
══════════════════════════════ -->
<nav class="lnav" id="lnav">
    <div class="container">
        <a href="#" class="lnav-brand">
            <div class="brand-icon"><i class="fa-solid fa-flask-vial"></i></div>
            {{ config('app.name', 'SUHAIM SOFT LAB') }}
        </a>
        <ul class="lnav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#how">Process</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#benefits">Benefits</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="lnav-cta">
            <a href="#" class="btn-ghost" data-bs-toggle="modal" data-bs-target="#enrollModal">Enroll Now</a>
            <a href="{{ route('login') }}" class="btn-primary-glow"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        </div>
        <button class="lnav-toggle" id="navToggle"><i class="fa-solid fa-bars"></i></button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <a href="#home">Home</a>
    <a href="#how">Process</a>
    <a href="#features">Features</a>
    <a href="#benefits">Benefits</a>
    <a href="#contact">Contact</a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#enrollModal" style="color:var(--cyan);">Enroll Now</a>
    <a href="{{ route('login') }}" style="background:#1e6fff;color:#fff;margin-top:4px;text-align:center;font-weight:700;border-radius:12px;padding:14px;border:2px solid #fff;"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</a>
</div>

<!-- ══════════════════════════════
     HERO
══════════════════════════════ -->
<section id="home" class="hero">
    <div class="hero-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="container" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <!-- Left -->
            <div class="col-lg-6">
                <div class="hero-badge">
                    <div class="dot"></div>
                    Next-Generation Laboratory System
                </div>
                <h1>
                    Digital Lab<br>
                    <span class="grad">Intelligence</span><br>
                    For Modern Care
                </h1>
                <p class="lead">
                    Automate your entire lab workflow — from patient registration to report delivery — with a powerful, secure, and beautifully designed LIMS built for diagnostic centers.
                </p>
                <div class="hero-btns">
                    <a href="#how" class="btn-hero-primary">
                        <i class="fa-solid fa-play-circle"></i> See How It Works
                    </a>
                    <a href="{{ route('login') }}" style="background:#ffffff;color:#1e6fff;font-weight:700;font-size:15px;padding:14px 30px;border-radius:12px;border:2px solid #1e6fff;text-decoration:none;display:inline-flex;align-items:center;gap:10px;transition:all 0.25s;">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="h-stat">
                        <span class="h-stat-val">30s</span>
                        <span class="h-stat-label">Report Generation</span>
                    </div>
                    <div class="h-stat" style="padding-left:28px;border-left:1px solid rgba(255,255,255,0.07);">
                        <span class="h-stat-val">100%</span>
                        <span class="h-stat-label">Digital Workflow</span>
                    </div>

                </div>
            </div>

            <!-- Right — 3D Lab Scene -->
            <div class="col-lg-6">
                <div class="lab3d-scene">

                    <!-- Ambient glow -->
                    <div class="lab3d-glow"></div>

                    <!-- Orbiting ring -->
                    <div class="orbit-ring"></div>

                    <!-- Floating stat badges -->
                    <div class="lab3d-badge lb-1">
                        <div class="b-icon" style="background:rgba(0,229,192,0.12);color:var(--teal);"><i class="fa-solid fa-file-medical"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:var(--teal);">500+</span>
                            <span class="b-lbl">Reports Generated</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-2">
                        <div class="b-icon" style="background:rgba(30,111,255,0.12);color:var(--blue-bright);"><i class="fa-solid fa-clock"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:var(--blue-bright);">30s</span>
                            <span class="b-lbl">Report Time</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-3">
                        <div class="b-icon" style="background:rgba(251,191,36,0.12);color:#fbbf24;"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:#fbbf24;">100%</span>
                            <span class="b-lbl">Data Secured</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-4">
                        <div class="b-icon" style="background:rgba(168,85,247,0.12);color:#a78bfa;"><i class="fa-solid fa-star"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:#a78bfa;">5★</span>
                            <span class="b-lbl">Rated by Labs</span>
                        </div>
                    </div>

                    <!-- 3D Rotating Cube -->
                    <div class="cube-wrap" id="labCube">

                        <!-- Front: Flask -->  
                        <div class="cube-face cf-front">
                            <i class="fa-solid fa-flask" style="color:var(--blue-bright);"></i>
                            <span>Lab Tests</span>
                        </div>

                        <!-- Back: Microscope -->
                        <div class="cube-face cf-back">
                            <i class="fa-solid fa-microscope" style="color:var(--teal);"></i>
                            <span>Diagnostics</span>
                        </div>

                        <!-- Right: DNA -->
                        <div class="cube-face cf-right">
                            <i class="fa-solid fa-dna" style="color:var(--cyan);"></i>
                            <span>Genomics</span>
                        </div>

                        <!-- Left: Heart Pulse -->
                        <div class="cube-face cf-left">
                            <i class="fa-solid fa-heart-pulse" style="color:#a78bfa;"></i>
                            <span>Vitals</span>
                        </div>

                        <!-- Top: Report -->
                        <div class="cube-face cf-top">
                            <i class="fa-solid fa-file-medical" style="color:#fbbf24;"></i>
                            <span>Reports</span>
                        </div>

                        <!-- Bottom: Shield -->
                        <div class="cube-face cf-bottom">
                            <i class="fa-solid fa-shield-halved" style="color:#f87171;"></i>
                            <span>Security</span>
                        </div>

                    </div><!-- /cube-wrap -->

                </div><!-- /lab3d-scene -->
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     METRICS STRIP
══════════════════════════════ -->
<div class="metrics-strip">
    <div class="container">
        <div class="metrics-inner">
            <div class="metric-item reveal">
                <div class="metric-num"><span class="counter" data-to="30">0</span>s</div>
                <div class="metric-label">Avg. Report Time</div>
            </div>
            <div class="metric-item reveal">
                <div class="metric-num"><span class="counter" data-to="100">0</span>%</div>
                <div class="metric-label">Paperless Workflow</div>
            </div>
            <div class="metric-item reveal">
                <div class="metric-num"><span class="counter" data-to="500">0</span>+</div>
                <div class="metric-label">Tests Supported</div>
            </div>
            <div class="metric-item reveal">
                <div class="metric-num"><span class="counter" data-to="1000">0</span>+</div>
                <div class="metric-label">Happy Patients</div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     HOW IT WORKS
══════════════════════════════ -->
<section id="how" class="how-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center reveal">
                <div class="sec-tag"><i class="fa-solid fa-diagram-project"></i> Simple Process</div>
                <h2 class="sec-title">Up and running in<br><span class="grad">three easy steps</span></h2>
                <p class="sec-sub mx-auto">Get your diagnostic center fully digitized with zero friction using our streamlined onboarding process.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <div class="step-icon" style="background:rgba(30,111,255,0.12);color:var(--blue-bright);">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h4>Consult & Demo</h4>
                    <p>Schedule a personalized demo. Our specialists will showcase the platform tailored to your diagnostic center's workflow and requirements.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.1s;">
                <div class="step-card">
                    <div class="step-num">02</div>
                    <div class="step-icon" style="background:rgba(0,200,255,0.12);color:var(--cyan);">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h4>Seamless Setup</h4>
                    <p>Our team handles data migration, system configuration, and full integration with your existing infrastructure — zero downtime, zero hassle.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.2s;">
                <div class="step-card">
                    <div class="step-num">03</div>
                    <div class="step-icon" style="background:rgba(0,229,192,0.12);color:var(--teal);">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h4>Train & Launch</h4>
                    <p>Comprehensive staff training, dedicated onboarding support, and ongoing technical assistance — ensuring your team thrives from day one.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     MARQUEE TICKER
══════════════════════════════ -->
<div class="marquee-section">
    <div class="marquee-track" id="marqueeTrack">
        @php
        $items = [
            ['fa-vial', 'Automated Reports'],
            ['fa-user-nurse', 'Patient Management'],
            ['fa-flask', 'Test Tracking'],
            ['fa-file-medical', 'Digital Records'],
            ['fa-paper-plane', 'WhatsApp Delivery'],
            ['fa-chart-line', 'Live Dashboard'],
            ['fa-shield-halved', 'Secure Platform'],
            ['fa-bell', 'Smart Alerts'],
            ['fa-print', 'Instant Printing'],
            ['fa-receipt', 'Billing & Payments'],
        ];
        @endphp
        @foreach(array_merge($items, $items) as $it)
        <div class="marquee-item">
            <i class="fa-solid {{ $it[0] }}"></i>
            {{ $it[1] }}
        </div>
        @endforeach
    </div>
</div>

<!-- ══════════════════════════════
     FEATURES
══════════════════════════════ -->
<section id="features" class="features-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center reveal">
                <div class="sec-tag"><i class="fa-solid fa-sparkles"></i> Core Features</div>
                <h2 class="sec-title">Everything your lab<br><span class="grad">needs to excel</span></h2>
                <p class="sec-sub mx-auto">Purpose-built for diagnostic laboratories — covering every aspect of your daily operations.</p>
            </div>
        </div>

        <div class="feat-grid">
            <!-- Feature 1 -->
            <div class="feat-card featured reveal">
                <div class="feat-glow" style="background:var(--blue);"></div>
                <div class="feat-icon" style="background:rgba(30,111,255,0.12);color:var(--blue-bright);">
                    <i class="fa-solid fa-stopwatch"></i>
                </div>
                <h4>30-Second Report Generation</h4>
                <p>Generate fully formatted, professional lab reports in under 30 seconds using intelligent templates with pre-filled reference ranges and auto-flagging.</p>
                <div class="tag-pill"><i class="fa-solid fa-bolt"></i> Fastest in Class</div>
            </div>
            <!-- Feature 2 -->
            <div class="feat-card reveal" style="transition-delay:.1s;">
                <div class="feat-glow" style="background:var(--cyan);"></div>
                <div class="feat-icon" style="background:rgba(0,200,255,0.12);color:var(--cyan);">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h4>Automated WhatsApp Delivery</h4>
                <p>Send finalized reports directly to patients on WhatsApp or email instantly — eliminate paper waste and wait times entirely.</p>
            </div>
            <!-- Feature 3 -->
            <div class="feat-card reveal" style="transition-delay:.2s;">
                <div class="feat-glow" style="background:var(--teal);"></div>
                <div class="feat-icon" style="background:rgba(0,229,192,0.12);color:var(--teal);">
                    <i class="fa-solid fa-chart-area"></i>
                </div>
                <h4>Real-Time Dashboard</h4>
                <p>Monitor patient flow, test status, pending reports, and revenue metrics in real-time from a single intuitive control panel.</p>
            </div>
            <!-- Feature 4 -->
            <div class="feat-card reveal" style="transition-delay:.1s;">
                <div class="feat-glow" style="background:var(--blue);"></div>
                <div class="feat-icon" style="background:rgba(255,193,7,0.12);color:#fbbf24;">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <h4>Patient Management</h4>
                <p>Complete patient profiles, appointment history, test records, and payment tracking — all organized in one searchable database.</p>
            </div>
            <!-- Feature 5 -->
            <div class="feat-card reveal" style="transition-delay:.2s;">
                <div class="feat-glow" style="background:var(--blue-bright);"></div>
                <div class="feat-icon" style="background:rgba(30,111,255,0.12);color:var(--blue-bright);">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4>Enterprise-Grade Security</h4>
                <p>Multi-layered security architecture with encrypted sessions, role-based access control, and audit logs for complete data protection.</p>
            </div>
            <!-- Feature 6 -->
            <div class="feat-card reveal" style="transition-delay:.3s;">
                <div class="feat-glow" style="background:var(--teal);"></div>
                <div class="feat-icon" style="background:rgba(168,85,247,0.12);color:#a78bfa;">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <h4>Billing & Collections</h4>
                <p>Streamline invoicing, track daily collections, manage payment records, and generate income reports with one-click accuracy.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     BENEFITS
══════════════════════════════ -->
<section id="benefits" class="benefits-section">
    <div class="container" style="position:relative;z-index:2;">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center reveal">
                <div class="sec-tag"><i class="fa-solid fa-trophy"></i> Proven Results</div>
                <h2 class="sec-title">Measurable impact<br><span class="grad">from day one</span></h2>
                <p class="sec-sub mx-auto">Our platform delivers real, quantifiable improvements across every dimension of your laboratory operations.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6 reveal">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:rgba(0,229,192,0.1);color:var(--teal);">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="80">0</span>%</div>
                    <h5>Time Saved</h5>
                    <p>Reduce administrative workload, freeing staff for critical patient care activities.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.1s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:rgba(30,111,255,0.1);color:var(--blue-bright);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="99">0</span>%</div>
                    <h5>Data Accuracy</h5>
                    <p>Intelligent validation and auto-fill minimize human errors across all data entry points.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.2s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:rgba(251,191,36,0.1);color:#fbbf24;">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="40">0</span>%</div>
                    <h5>Revenue Growth</h5>
                    <p>Efficient billing, reduced revenue leakage, and faster collections boost your bottom line.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.3s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:rgba(168,85,247,0.1);color:#a78bfa;">
                        <i class="fa-solid fa-face-smile-beam"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="95">0</span>%</div>
                    <h5>Patient Satisfaction</h5>
                    <p>Faster reports, digital delivery, and smooth check-ins drive outstanding patient experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     CTA
══════════════════════════════ -->
<section class="cta-section" id="contact">
    <div class="container">
        <div class="cta-box reveal">
            <h2>Ready to transform your<br><span class="grad">laboratory operations?</span></h2>
            <p>Join diagnostic centers already running on {{ config('app.name', 'SUHAIM SOFT LAB') }}. Request a free demo and see the difference in minutes.</p>
            <div class="cta-btns">
                <a href="#" class="btn-primary-glow btn-lg" data-bs-toggle="modal" data-bs-target="#enrollModal" style="padding:14px 32px;font-size:15px;">
                    <i class="fa-solid fa-rocket"></i> Request Free Demo
                </a>
                <a href="https://wa.me/918891479505" target="_blank" class="btn-ghost" style="padding:14px 32px;font-size:15px;">
                    <i class="fa-brands fa-whatsapp me-2" style="color:#25d366;"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     FOOTER
══════════════════════════════ -->
<footer class="lfooter">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <a href="#" class="footer-brand-logo">
                    <div class="fb-icon"><i class="fa-solid fa-flask-vial"></i></div>
                    {{ config('app.name', 'SUHAIM SOFT LAB') }}
                </a>
                <p>A next-generation Laboratory Information System built to automate, simplify, and elevate diagnostic center operations.</p>
                <div class="footer-social">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://wa.me/918891479505" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6 footer-col">
                <h6>Navigation</h6>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#how">How It Works</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#benefits">Benefits</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-6 footer-col">
                <h6>Features</h6>
                <ul>
                    <li><a href="#">Report Generation</a></li>
                    <li><a href="#">Patient Management</a></li>
                    <li><a href="#">WhatsApp Reports</a></li>
                    <li><a href="#">Billing & Payments</a></li>
                    <li><a href="#">Live Analytics</a></li>
                </ul>
            </div>
            <div class="col-lg-3 footer-col" id="contact-info">
                <h6>Contact</h6>
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Pathappiriyam, Kerala, India</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span><a href="tel:+918891479505">+91 8891 479 505</a></span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span><a href="mailto:info@suhaimsoft.com">info@suhaimsoft.com</a></span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-globe"></i>
                    <span><a href="https://suhaimsoft.com" target="_blank">suhaimsoft.com</a></span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SUHAIM SOFT. All rights reserved.</p>
            <p>Crafted with <i class="fa-solid fa-heart" style="color:#ff4757;"></i> by <a href="https://suhaimsoft.com" target="_blank">Suhaim Soft</a></p>
        </div>
    </div>
</footer>

<!-- ══════════════════════════════
     FLOATING BUTTONS
══════════════════════════════ -->
<div class="fab-wrap">
    <button class="fab-btn fab-top" id="fabTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
    <button class="fab-btn fab-wa" onclick="toggleWaPopup()" title="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </button>
</div>

<!-- WhatsApp Popup -->
<div class="wa-popup" id="waPopup">
    <div class="wa-popup-head">
        <span><i class="fa-brands fa-whatsapp me-2"></i>{{ config('app.name', 'SUHAIM SOFT LAB') }}</span>
        <button onclick="toggleWaPopup()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="wa-popup-body">
        <div class="wa-bubble">
            👋 Welcome to <strong>{{ config('app.name', 'SUHAIM SOFT LAB') }}</strong>!<br><br>
            How can we help you today? We're here to assist with demos, setup, and support.
        </div>
    </div>
    <div class="wa-popup-foot">
        <a href="https://wa.me/918891479505" target="_blank">
            <i class="fa-brands fa-whatsapp"></i> Start Chat on WhatsApp
        </a>
    </div>
</div>

<!-- ══════════════════════════════
     ENROLL MODAL
══════════════════════════════ -->
<div class="modal fade enroll-modal" id="enrollModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-rocket me-2" style="color:var(--cyan);"></i>Request a Free Demo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:13.5px;color:var(--grey);margin-bottom:22px;">Fill out the form below and our team will get back to you within 24 hours.</p>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="e.g. Dr. Ahmed" required autocomplete="off" name="enroll_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" placeholder="+91 00000 00000" required autocomplete="off" name="enroll_phone">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="3" placeholder="Tell us about your lab..." autocomplete="off" name="enroll_msg"></textarea>
                    </div>
                    <button type="submit" class="btn-enroll-submit">
                        <i class="fa-solid fa-paper-plane me-2"></i>Send Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function() {
    // Navbar scroll
    const nav = document.getElementById('lnav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
        // Back to top
        document.getElementById('fabTop').classList.toggle('visible', window.scrollY > 400);
    });

    // Mobile menu toggle
    document.getElementById('navToggle').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('open');
    });

    // Close mobile menu on link click
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => document.getElementById('mobileMenu').classList.remove('open'));
    });

    // WhatsApp popup
    window.toggleWaPopup = function() {
        document.getElementById('waPopup').classList.toggle('open');
    };

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Intersection Observer for reveal animations
    const reveals = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => revealObserver.observe(el));

    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.done) {
                entry.target.dataset.done = '1';
                const target = +entry.target.dataset.to;
                let current = 0;
                const step = Math.max(1, Math.ceil(target / 60));
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    entry.target.textContent = current;
                    if (current >= target) clearInterval(timer);
                }, 25);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(el => counterObserver.observe(el));

    // Active nav link on scroll
    const sections = ['home', 'how', 'features', 'benefits', 'contact'];
    const navLinks = document.querySelectorAll('.lnav-links a');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 100) current = id;
        });
        navLinks.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href') === '#' + current);
        });
    });
})();
</script>
</body>
</html>
