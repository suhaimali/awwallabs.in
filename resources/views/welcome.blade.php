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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg-page:        #f8fafc;
            --bg-card:        #ffffff;
            --text-dark:      #0f172a;
            --text-body:      #334155;
            --text-muted:     #64748b;
            --border-color:   #e2e8f0;
            --border-light:   #f1f5f9;
            
            --primary:        #0284c7;
            --primary-dark:   #0369a1;
            --primary-light:  #e0f2fe;
            --cyan:           #06b6d4;
            --cyan-light:     #ecfeff;
            --teal:           #0d9488;
            --teal-light:     #f0fdfa;
            --emerald:        #059669;
            --emerald-light:  #ecfdf5;
            --amber:          #d97706;
            --amber-light:    #fffbeb;
            --indigo:         #4f46e5;
            --indigo-light:   #eef2ff;

            --navy-footer:    #071a2e;
            --navy-mid:       #0c233c;
            
            --shadow-sm:      0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-md:      0 4px 16px -2px rgba(2, 132, 199, 0.08), 0 2px 6px rgba(15, 23, 42, 0.04);
            --shadow-lg:      0 12px 32px -4px rgba(2, 132, 199, 0.12), 0 4px 12px rgba(15, 23, 42, 0.06);
            --shadow-hover:   0 20px 40px -8px rgba(2, 132, 199, 0.18), 0 6px 16px rgba(15, 23, 42, 0.06);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; overflow-x: hidden; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }

        /* ═══════════════════════════════════════
           SCROLLBAR
        ═══════════════════════════════════════ */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* ═══════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════ */
        .lnav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 18px 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }
        .lnav.scrolled {
            padding: 12px 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
            border-bottom-color: var(--border-color);
        }
        .lnav .container { display: flex; align-items: center; justify-content: space-between; }
        .lnav-brand {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--text-dark) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .lnav-brand .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 19px;
            color: #ffffff;
            box-shadow: none;
        }
        .lnav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .lnav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .lnav-links a:hover {
            color: var(--primary);
            background: var(--primary-light);
        }
        .lnav-links a.active {
            color: var(--primary);
            background: #f0f9ff;
            font-weight: 700;
        }
        .lnav-cta {
            display: flex; align-items: center; gap: 12px;
        }
        .btn-ghost-med {
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-ghost-med:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--primary);
        }
        .btn-primary-med {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: none;
            transition: all 0.25s;
            cursor: pointer;
        }
        .btn-primary-med:hover {
            transform: translateY(-2px);
            box-shadow: none;
            color: #ffffff;
        }

        /* Hamburger */
        .lnav-toggle {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 6px;
            position: fixed;
            top: 72px; left: 0; right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 16px 20px 24px;
            z-index: 999;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            color: var(--text-body);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .mobile-menu a:hover { background: var(--primary-light); color: var(--primary); }

        /* ═══════════════════════════════════════
           HERO SECTION
        ═══════════════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 130px 0 90px;
            background: 
                radial-gradient(circle at 15% 20%, rgba(2, 132, 199, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 30%, rgba(6, 182, 212, 0.08) 0%, transparent 45%),
                radial-gradient(circle at 50% 85%, rgba(13, 148, 136, 0.05) 0%, transparent 50%),
                #f8fafc;
        }
        /* Subtle clinical mesh pattern */
        .hero-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(rgba(2, 132, 199, 0.12) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, black 20%, transparent 80%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
            padding: 7px 18px;
            border-radius: 50px;
            margin-bottom: 24px;
            letter-spacing: 0.2px;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.1);
        }
        .hero-badge .dot {
            width: 8px; height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse-dot 2s ease infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.6); }
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5.2vw, 4.2rem);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.03em;
            margin-bottom: 22px;
            color: var(--text-dark);
        }
        .hero h1 .grad {
            background: linear-gradient(135deg, #0284c7 0%, #06b6d4 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p.lead {
            font-size: clamp(1.05rem, 1.8vw, 1.2rem);
            color: var(--text-muted);
            line-height: 1.75;
            max-width: 580px;
            margin-bottom: 36px;
        }
        .hero-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 50px;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 15px 32px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 24px -4px rgba(2, 132, 199, 0.4);
            transition: all 0.25s;
        }
        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px -4px rgba(2, 132, 199, 0.55);
            color: #ffffff;
        }
        .btn-hero-secondary {
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            color: var(--text-dark) !important;
            font-weight: 700;
            font-size: 15px;
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
            transition: all 0.25s;
        }
        .btn-hero-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        /* Hero stats bottom */
        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 36px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }
        .h-stat { display: flex; flex-direction: column; gap: 4px; }
        .h-stat-val {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1;
        }
        .h-stat-label { font-size: 13px; color: var(--text-muted); font-weight: 600; }

        /* ═══════════════════════════════════════
           3D LAB SCENE (HERO RIGHT CUBE)
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
            background: radial-gradient(ellipse, rgba(2, 132, 199, 0.3) 0%, transparent 70%);
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
            border-radius: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: 1.5px solid rgba(2, 132, 199, 0.25);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.12), inset 0 0 15px rgba(255, 255, 255, 0.8);
        }
        .cube-face i { font-size: 2.8rem; }
        .cube-face span { font-size: 14px; font-weight: 700; color: #0f172a; letter-spacing: 0.2px; }

        /* face backgrounds */
        .cf-front  { background: rgba(224, 242, 254, 0.85); transform: translateZ(100px); border-color: rgba(2, 132, 199, 0.3); }
        .cf-back   { background: rgba(240, 253, 250, 0.85); transform: rotateY(180deg) translateZ(100px); border-color: rgba(13, 148, 136, 0.3); }
        .cf-right  { background: rgba(236, 254, 255, 0.85); transform: rotateY(90deg) translateZ(100px); border-color: rgba(6, 182, 212, 0.3); }
        .cf-left   { background: rgba(238, 242, 255, 0.85); transform: rotateY(-90deg) translateZ(100px); border-color: rgba(79, 70, 229, 0.3); }
        .cf-top    { background: rgba(254, 243, 199, 0.85); transform: rotateX(90deg) translateZ(100px); border-color: rgba(217, 119, 6, 0.3); }
        .cf-bottom { background: rgba(254, 226, 226, 0.85); transform: rotateX(-90deg) translateZ(100px); border-color: rgba(239, 68, 68, 0.3); }

        /* Floating stat badges around the cube */
        .lab3d-badge {
            position: absolute;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.12), 0 2px 8px rgba(15, 23, 42, 0.05);
            z-index: 10;
            white-space: nowrap;
            transition: transform 0.3s;
        }
        .lab3d-badge:hover {
            transform: scale(1.05);
        }
        .lab3d-badge .b-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }
        .lab3d-badge .b-text { display: flex; flex-direction: column; gap: 2px; }
        .lab3d-badge .b-val  { font-family: 'Plus Jakarta Sans',sans-serif; font-size: 1.15rem; font-weight: 800; line-height: 1; }
        .lab3d-badge .b-lbl  { font-size: 11.5px; color: var(--text-muted); font-weight: 600; }

        /* Badge positions & animations */
        .lb-1 { top: 15px;  left: -15px;  animation: badgeFloat1 4s ease-in-out infinite; }
        .lb-2 { top: 15px;  right: -15px; animation: badgeFloat2 5s 0.5s ease-in-out infinite; }
        .lb-3 { bottom: 40px; left: -15px;  animation: badgeFloat1 4.5s 1s ease-in-out infinite; }
        .lb-4 { bottom: 40px; right: -15px; animation: badgeFloat2 5.5s 1.5s ease-in-out infinite; }

        @keyframes badgeFloat1 {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(-10px); }
        }
        @keyframes badgeFloat2 {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(10px); }
        }

        /* Orbiting ring */
        .orbit-ring {
            position: absolute;
            width: 320px; height: 320px;
            border: 1.5px dashed rgba(2, 132, 199, 0.25);
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
            background: var(--primary);
            border-radius: 50%;
            box-shadow: 0 0 14px var(--primary);
            top: -6px; left: 50%;
            transform: translateX(-50%);
        }
        @keyframes orbitSpin { from{transform:translate(-50%,-50%) rotateX(75deg) rotateZ(0deg);} to{transform:translate(-50%,-50%) rotateX(75deg) rotateZ(360deg);} }

        /* ═══════════════════════════════════════
           SECTION COMMONS
        ═══════════════════════════════════════ */
        section { position: relative; }
        .sec-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: var(--primary);
            font-size: 12px; font-weight: 800;
            padding: 6px 16px; border-radius: 50px;
            letter-spacing: 0.8px; text-transform: uppercase;
            margin-bottom: 16px;
        }
        .sec-title {
            font-size: clamp(2rem, 3.8vw, 2.8rem);
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-dark);
            margin-bottom: 16px;
        }
        .sec-title .grad {
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sec-sub {
            font-size: 1.05rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 540px;
        }

        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════════════
           SECTION: METRICS STRIP
        ═══════════════════════════════════════ */
        .metrics-strip {
            padding: 0;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
        }
        .metrics-inner {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .metric-item {
            flex: 1; min-width: 200px;
            padding: 36px 30px;
            text-align: center;
            border-right: 1px solid #f1f5f9;
            position: relative;
        }
        .metric-item:last-child { border-right: none; }
        .metric-num {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1;
            margin-bottom: 8px;
        }
        .metric-label { font-size: 14px; color: var(--text-muted); font-weight: 600; }

        /* ═══════════════════════════════════════
           SECTION: HOW IT WORKS
        ═══════════════════════════════════════ */
        .how-section {
            padding: 110px 0;
            background: #f8fafc;
        }
        .step-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 38px 32px;
            height: 100%;
            position: relative;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .step-card:hover {
            border-color: #38bdf8;
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }
        .step-num {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: #f1f5f9;
            line-height: 1;
            position: absolute;
            top: 24px; right: 28px;
            transition: color 0.3s;
        }
        .step-card:hover .step-num {
            color: #e0f2fe;
        }
        .step-icon {
            width: 56px; height: 56px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }
        .step-card h4 { font-weight: 800; font-size: 1.2rem; margin-bottom: 12px; color: var(--text-dark); position: relative; z-index: 2; }
        .step-card p { font-size: 14.5px; color: var(--text-muted); line-height: 1.7; margin: 0; position: relative; z-index: 2; }

        /* ═══════════════════════════════════════
           SECTION: WORKFLOW MARQUEE
        ═══════════════════════════════════════ */
        .marquee-section {
            padding: 40px 0;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            overflow: hidden;
        }
        .marquee-track { display: flex; gap: 16px; width: max-content; animation: marquee 35s linear infinite; }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-item {
            display: flex; align-items: center; gap: 10px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 10px 22px;
            white-space: nowrap;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-dark);
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
            transition: all 0.2s;
        }
        .marquee-item:hover {
            border-color: #bae6fd;
            background: #f0f9ff;
            color: var(--primary);
        }
        .marquee-item i { color: var(--primary); font-size: 15px; }
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ═══════════════════════════════════════
           SECTION: FEATURES
        ═══════════════════════════════════════ */
        .features-section {
            padding: 110px 0;
            background: #ffffff;
        }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feat-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 36px 30px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .feat-card:hover {
            border-color: #7dd3fc;
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }
        .feat-card.featured {
            background: #f0f9ff;
            border-color: #bae6fd;
        }
        .feat-icon {
            width: 54px; height: 54px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin-bottom: 22px;
        }
        .feat-card h4 { font-size: 1.15rem; font-weight: 800; margin-bottom: 12px; color: var(--text-dark); }
        .feat-card p { font-size: 14px; color: var(--text-muted); line-height: 1.7; margin: 0; }
        .tag-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 50px;
            margin-top: 16px;
            letter-spacing: 0.3px;
        }

        /* ═══════════════════════════════════════
           SECTION: BENEFITS / STATS
        ═══════════════════════════════════════ */
        .benefits-section {
            padding: 110px 0;
            background: #f8fafc;
            position: relative;
        }
        .benefit-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 38px 28px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }
        .benefit-card:hover {
            border-color: #7dd3fc;
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }
        .benefit-icon {
            width: 64px; height: 64px;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
        }
        .benefit-val {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 8px;
            line-height: 1;
        }
        .benefit-card h5 { font-weight: 800; font-size: 1.1rem; margin-bottom: 10px; color: var(--text-dark); }
        .benefit-card p { font-size: 13.5px; color: var(--text-muted); margin: 0; line-height: 1.6; }

        /* ═══════════════════════════════════════
           CTA SECTION
        ═══════════════════════════════════════ */
        .cta-section {
            padding: 90px 0;
            background: #f8fafc;
        }
        .cta-box {
            background: linear-gradient(135deg, #0369a1 0%, #0284c7 50%, #06b6d4 100%);
            border-radius: 28px;
            padding: 70px 50px;
            text-align: center;
            position: relative;
            overflow: hidden;
            color: #ffffff;
            box-shadow: 0 20px 50px -10px rgba(2, 132, 199, 0.4);
        }
        .cta-box::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.15), transparent 70%);
            top: -100px; left: -100px;
        }
        .cta-box::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.12), transparent 70%);
            bottom: -80px; right: -80px;
        }
        .cta-box h2 {
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 800;
            margin-bottom: 16px;
            color: #ffffff;
            position: relative; z-index: 1;
        }
        .cta-box p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            margin-bottom: 36px;
            max-width: 580px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
        }
        .cta-btns { display: flex; justify-content: center; flex-wrap: wrap; gap: 16px; position: relative; z-index: 1; }
        .btn-cta-white {
            background: #ffffff;
            color: var(--primary-dark) !important;
            font-weight: 800;
            font-size: 15px;
            padding: 15px 34px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transition: all 0.25s;
        }
        .btn-cta-white:hover {
            transform: translateY(-2px);
            background: #f8fafc;
            box-shadow: 0 12px 30px rgba(0,0,0,0.22);
        }
        .btn-cta-ghost {
            background: rgba(255, 255, 255, 0.15);
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 15px 32px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.25s;
            backdrop-filter: blur(10px);
        }
        .btn-cta-ghost:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        /* ═══════════════════════════════════════
           FOOTER (Pristine Medical UI Theme)
        ═══════════════════════════════════════ */
        .lfooter {
            background: #ffffff;
            border-top: 1.5px solid var(--border-color);
            padding: 75px 0 34px;
            color: var(--text-dark);
            position: relative;
        }
        .footer-brand-logo {
            display: flex; align-items: center; gap: 12px;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--text-dark);
            text-decoration: none;
            margin-bottom: 18px;
            transition: color 0.2s;
        }
        .footer-brand-logo:hover {
            color: var(--primary);
        }
        .footer-brand-logo .fb-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 19px;
            color: #ffffff;
            box-shadow: none;
        }
        .lfooter p { color: var(--text-muted); font-size: 14px; line-height: 1.75; max-width: 310px; margin-bottom: 24px; }
        .footer-social { display: flex; gap: 10px; }
        .footer-social a {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            font-size: 15px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .footer-social a:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-color: var(--primary);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: none;
        }
        .footer-col h6 {
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-dark);
            margin-bottom: 22px;
        }
        .footer-col ul { list-style: none; padding: 0; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul li a { color: var(--text-muted); text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s; }
        .footer-col ul li a:hover { color: var(--primary); padding-left: 3px; }
        .contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
        .contact-item i { color: var(--primary); font-size: 15px; margin-top: 3px; flex-shrink: 0; }
        .contact-item span { font-size: 14px; color: var(--text-muted); line-height: 1.55; }
        .contact-item a { color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .contact-item a:hover { color: var(--primary); }
        .footer-bottom {
            margin-top: 50px;
            padding-top: 26px;
            border-top: 1px solid var(--border-color);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .footer-bottom p { color: var(--text-muted); font-size: 13px; margin: 0; }
        .footer-bottom a { color: var(--primary); text-decoration: none; font-weight: 700; }
        .footer-bottom a:hover { text-decoration: underline; }

        /* ═══════════════════════════════════════
           FLOATING ACTION BUTTONS
           - Left: Upper Arrow (Scroll to Top)
           - Right: WhatsApp Chat Widget & Popup
        ═══════════════════════════════════════ */
        /* Left: Upper Arrow (Back to top) */
        .fab-top-left {
            position: fixed;
            bottom: 28px;
            left: 28px;
            z-index: 900;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.08);
            opacity: 0;
            visibility: hidden;
            transform: translateY(12px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .fab-top-left.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .fab-top-left:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(2, 132, 199, 0.35);
        }

        /* Right: WhatsApp Floating Widget */
        .fab-wa-right {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 900;
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: #ffffff;
            padding: 10px 18px 10px 14px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            box-shadow: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
        }
        .fab-wa-right:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: none;
            color: #ffffff;
        }
        .fab-wa-icon {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }
        .fab-wa-text {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.15;
        }
        .fab-wa-title {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.2px;
        }
        .fab-wa-sub {
            font-size: 10.5px;
            opacity: 0.9;
            font-weight: 500;
        }

        /* WhatsApp popup */
        .wa-popup {
            position: fixed;
            bottom: 90px;
            right: 28px;
            width: 320px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            z-index: 901;
            display: none;
            animation: slideUp 0.3s ease;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.15);
        }
        .wa-popup.open { display: block; }
        .wa-popup-head {
            background: linear-gradient(135deg, #128c7e, #075e54);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffff;
        }
        .wa-head-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .wa-head-avatar {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }
        .wa-head-title {
            font-weight: 700;
            font-size: 13.5px;
            line-height: 1.2;
        }
        .wa-head-sub {
            font-size: 11px;
            opacity: 0.85;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .wa-online-dot {
            width: 6px;
            height: 6px;
            background: #4ade80;
            border-radius: 50%;
        }
        .wa-popup-head button {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .wa-popup-head button:hover {
            color: #ffffff;
        }
        .wa-popup-body {
            padding: 20px;
            background: #f8fafc;
        }
        .wa-bubble {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px 16px 16px 16px;
            padding: 14px;
            font-size: 13.5px;
            color: var(--text-body);
            line-height: 1.6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .wa-popup-foot {
            padding: 14px 20px 20px;
            background: #ffffff;
        }
        .wa-popup-foot a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #25d366;
            color: white;
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: none;
        }
        .wa-popup-foot a:hover {
            background: #1da851;
            color: white;
            transform: translateY(-1px);
            box-shadow: none;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ═══════════════════════════════════════
           ENROLL MODAL (Light Medical Theme)
        ═══════════════════════════════════════ */
        .enroll-modal .modal-content {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.15);
        }
        .enroll-modal .modal-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 24px 28px 18px;
        }
        .enroll-modal .modal-title { font-weight: 800; font-size: 1.25rem; color: var(--text-dark); }
        .enroll-modal .modal-body { padding: 20px 28px 30px; }
        .enroll-modal .form-label { font-size: 13px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }
        .enroll-modal .form-control {
            background: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-dark);
            padding: 12px 14px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .enroll-modal .form-control:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
            color: var(--text-dark);
        }
        .enroll-modal .form-control::placeholder { color: #94a3b8; }
        .btn-enroll-submit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
        }
        .btn-enroll-submit:hover {
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.45);
            transform: translateY(-2px);
            color: white;
        }

        /* ═══════════════════════════════════════
           RESPONSIVE BREAKPOINTS
        ═══════════════════════════════════════ */
        @media (max-width: 991px) {
            .lnav-links, .lnav-cta { display: none; }
            .lnav-toggle { display: block; }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
            .metric-item { min-width: 160px; padding: 28px 16px; }
            .showcase-container { margin-top: 40px; }
        }
        @media (max-width: 767px) {
            .hero { padding: 110px 0 60px; text-align: center; }
            .hero p.lead { margin-left: auto; margin-right: auto; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; gap: 24px; }
            .fb-pos-1, .fb-pos-2 { display: none; }
            .feat-grid { grid-template-columns: 1fr; }
            .cta-box { padding: 48px 24px; }
            .metric-item { min-width: 50%; border-right: none; border-bottom: 1px solid #f1f5f9; }
        }
        @media (max-width: 480px) {
            .hero h1 { font-size: 2.2rem; }
            .hero p.lead { font-size: 1rem; }
            .btn-hero-primary, .btn-hero-secondary { width: 100%; justify-content: center; }
            .fab-top-left { bottom: 18px; left: 16px; width: 44px; height: 44px; }
            .fab-wa-right { bottom: 18px; right: 16px; padding: 8px 14px 8px 10px; }
            .wa-popup { right: 16px; bottom: 78px; width: calc(100vw - 32px); }
        }
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
            <a href="#" class="btn-ghost-med" data-bs-toggle="modal" data-bs-target="#enrollModal">Enroll Now</a>
            <a href="{{ route('login') }}" class="btn-primary-med"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        </div>
        <button class="lnav-toggle" id="navToggle" aria-label="Toggle Menu"><i class="fa-solid fa-bars"></i></button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <a href="#home">Home</a>
    <a href="#how">Process</a>
    <a href="#features">Features</a>
    <a href="#benefits">Benefits</a>
    <a href="#contact">Contact</a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#enrollModal" style="color:var(--primary);font-weight:700;">Enroll Now</a>
    <a href="{{ route('login') }}" style="background:var(--primary);color:#fff;margin-top:6px;text-align:center;font-weight:700;border-radius:12px;padding:14px;"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</a>
</div>

<!-- ══════════════════════════════
     HERO
══════════════════════════════ -->
<section id="home" class="hero">
    <div class="hero-pattern"></div>

    <div class="container" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <!-- Left Hero Content -->
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
                    Automate your entire laboratory workflow — from patient registration to instant report delivery — with a powerful, secure, and beautifully crafted LIMS designed for modern diagnostic centers.
                </p>
                <div class="hero-btns">
                    <a href="#how" class="btn-hero-primary">
                        <i class="fa-solid fa-play-circle"></i> See How It Works
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary">
                        <i class="fa-solid fa-right-to-bracket" style="color:var(--primary);"></i> Login Portal
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="h-stat">
                        <span class="h-stat-val">30s</span>
                        <span class="h-stat-label">Report Generation</span>
                    </div>
                    <div class="h-stat" style="padding-left:28px;border-left:1.5px solid var(--border-color);">
                        <span class="h-stat-val">100%</span>
                        <span class="h-stat-label">Digital Workflow</span>
                    </div>
                    <div class="h-stat" style="padding-left:28px;border-left:1.5px solid var(--border-color);">
                        <span class="h-stat-val">500+</span>
                        <span class="h-stat-label">Supported Tests</span>
                    </div>
                </div>
            </div>

            <!-- Right — 3D Lab Cube Scene -->
            <div class="col-lg-6">
                <div class="lab3d-scene">

                    <!-- Ambient glow -->
                    <div class="lab3d-glow"></div>

                    <!-- Orbiting ring -->
                    <div class="orbit-ring"></div>

                    <!-- Floating stat badges -->
                    <div class="lab3d-badge lb-1">
                        <div class="b-icon" style="background:#ecfdf5;color:#059669;"><i class="fa-solid fa-file-medical"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:#059669;">500+</span>
                            <span class="b-lbl">Reports Generated</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-2">
                        <div class="b-icon" style="background:#e0f2fe;color:var(--primary);"><i class="fa-solid fa-clock"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:var(--primary);">30s</span>
                            <span class="b-lbl">Report Time</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-3">
                        <div class="b-icon" style="background:#fef3c7;color:#d97706;"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:#d97706;">100%</span>
                            <span class="b-lbl">Data Secured</span>
                        </div>
                    </div>

                    <div class="lab3d-badge lb-4">
                        <div class="b-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fa-solid fa-hospital"></i></div>
                        <div class="b-text">
                            <span class="b-val" style="color:#4f46e5;font-size:0.95rem;">Awwal Lab</span>
                            <span class="b-lbl">Trusted Partner</span>
                        </div>
                    </div>

                    <!-- 3D Rotating Cube -->
                    <div class="cube-wrap" id="labCube">

                        <!-- Front: Flask -->  
                        <div class="cube-face cf-front">
                            <i class="fa-solid fa-flask" style="color:var(--primary);"></i>
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
                            <i class="fa-solid fa-heart-pulse" style="color:#4f46e5;"></i>
                            <span>Vitals</span>
                        </div>

                        <!-- Top: Report -->
                        <div class="cube-face cf-top">
                            <i class="fa-solid fa-file-medical" style="color:#d97706;"></i>
                            <span>Reports</span>
                        </div>

                        <!-- Bottom: Shield -->
                        <div class="cube-face cf-bottom">
                            <i class="fa-solid fa-shield-halved" style="color:#ef4444;"></i>
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
     HOW IT WORKS (PROCESS)
══════════════════════════════ -->
<section id="how" class="how-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center reveal">
                <div class="sec-tag"><i class="fa-solid fa-diagram-project"></i> Simple Process</div>
                <h2 class="sec-title">Up and running in<br><span class="grad">three easy steps</span></h2>
                <p class="sec-sub mx-auto">Get your diagnostic center fully digitized with zero friction using our streamlined medical onboarding process.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <div class="step-icon" style="background:#e0f2fe;color:var(--primary);">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h4>Consult & Demo</h4>
                    <p>Schedule a personalized walkthrough. Our healthcare specialists demonstrate the platform customized to your diagnostic laboratory’s daily workflow.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.1s;">
                <div class="step-card">
                    <div class="step-num">02</div>
                    <div class="step-icon" style="background:#ecfeff;color:var(--cyan);">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h4>Seamless Setup</h4>
                    <p>Our engineering team handles test master configuration, normal range setup, doctor letterheads, and migration with zero downtime.</p>
                </div>
            </div>
            <div class="col-md-4 reveal" style="transition-delay:.2s;">
                <div class="step-card">
                    <div class="step-num">03</div>
                    <div class="step-icon" style="background:#f0fdfa;color:var(--teal);">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h4>Train & Launch</h4>
                    <p>Full staff training for lab technicians, front-desk receptionists, and pathologists with 24/7 dedicated support from day one.</p>
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
                <div class="sec-tag"><i class="fa-solid fa-sparkles"></i> Core Capabilities</div>
                <h2 class="sec-title">Everything your laboratory<br><span class="grad">needs to excel</span></h2>
                <p class="sec-sub mx-auto">Purpose-built for diagnostic laboratories — covering every critical phase of specimen handling and reporting.</p>
            </div>
        </div>

        <div class="feat-grid">
            <!-- Feature 1 -->
            <div class="feat-card featured reveal">
                <div class="feat-icon" style="background:#e0f2fe;color:var(--primary);">
                    <i class="fa-solid fa-stopwatch"></i>
                </div>
                <h4>30-Second Report Generation</h4>
                <p>Generate fully formatted, clean laboratory reports in under 30 seconds using intelligent templates with pre-configured reference ranges and automated abnormal flagging.</p>
                <div class="tag-pill"><i class="fa-solid fa-bolt"></i> Fast & Accurate</div>
            </div>
            <!-- Feature 2 -->
            <div class="feat-card reveal" style="transition-delay:.1s;">
                <div class="feat-icon" style="background:#ecfdf5;color:#059669;">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h4>Instant WhatsApp Delivery</h4>
                <p>Send finalized PDF reports directly to patients on WhatsApp with one click — eliminating counter queues and physical paper handling.</p>
            </div>
            <!-- Feature 3 -->
            <div class="feat-card reveal" style="transition-delay:.2s;">
                <div class="feat-icon" style="background:#ecfeff;color:var(--cyan);">
                    <i class="fa-solid fa-chart-area"></i>
                </div>
                <h4>Real-Time Clinical Dashboard</h4>
                <p>Monitor patient flow, pending tests, verified samples, and revenue figures in real-time from an intuitive clinical command center.</p>
            </div>
            <!-- Feature 4 -->
            <div class="feat-card reveal" style="transition-delay:.1s;">
                <div class="feat-icon" style="background:#fffbeb;color:#d97706;">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <h4>Patient & Doctor Management</h4>
                <p>Complete patient history, referring doctors, test directories, and recurring appointments — indexed and searchable in milliseconds.</p>
            </div>
            <!-- Feature 5 -->
            <div class="feat-card reveal" style="transition-delay:.2s;">
                <div class="feat-icon" style="background:#f0fdfa;color:var(--teal);">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4>Enterprise Data Security</h4>
                <p>Role-based access control, cryptographic session handling, and audit trails ensure patient confidentiality complies with international medical standards.</p>
            </div>
            <!-- Feature 6 -->
            <div class="feat-card reveal" style="transition-delay:.3s;">
                <div class="feat-icon" style="background:#eef2ff;color:var(--indigo);">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <h4>Billing & Collections</h4>
                <p>Streamline point-of-sale invoicing, daily cash collections, doctor commission calculations, and comprehensive financial reports with single-click accuracy.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     BENEFITS / STATS
══════════════════════════════ -->
<section id="benefits" class="benefits-section">
    <div class="container" style="position:relative;z-index:2;">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center reveal">
                <div class="sec-tag"><i class="fa-solid fa-trophy"></i> Proven Results</div>
                <h2 class="sec-title">Measurable clinical impact<br><span class="grad">from day one</span></h2>
                <p class="sec-sub mx-auto">Our platform delivers real, quantifiable operational improvements across every metric of your medical laboratory.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6 reveal">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:#f0fdfa;color:var(--teal);">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="80">0</span>%</div>
                    <h5>Time Saved</h5>
                    <p>Substantially reduces administrative workload, freeing your staff for patient care.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.1s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:#e0f2fe;color:var(--primary);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="99">0</span>%</div>
                    <h5>Data Accuracy</h5>
                    <p>Standardized templates and automated reference checks prevent transcription mistakes.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.2s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:#fffbeb;color:#d97706;">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="40">0</span>%</div>
                    <h5>Revenue Growth</h5>
                    <p>Instant invoicing, zero missed test charges, and faster patient turnover drive profitability.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal" style="transition-delay:.3s;">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background:#eef2ff;color:var(--indigo);">
                        <i class="fa-solid fa-face-smile-beam"></i>
                    </div>
                    <div class="benefit-val"><span class="counter" data-to="95">0</span>%</div>
                    <h5>Patient Satisfaction</h5>
                    <p>Quick turnaround, online report access, and frictionless service earn five-star reviews.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     CTA BANNER
══════════════════════════════ -->
<section class="cta-section" id="contact">
    <div class="container">
        <div class="cta-box reveal">
            <h2>Ready to transform your<br>laboratory operations?</h2>
            <p>Join premier diagnostic centers operating on {{ config('app.name', 'SUHAIM SOFT LAB') }}. Request a free live demo and experience the clinical difference.</p>
            <div class="cta-btns">
                <a href="#" class="btn-cta-white" data-bs-toggle="modal" data-bs-target="#enrollModal">
                    <i class="fa-solid fa-rocket me-2"></i> Request Free Demo
                </a>
                <a href="https://wa.me/918891479505" target="_blank" class="btn-cta-ghost">
                    <i class="fa-brands fa-whatsapp me-2"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════
     FOOTER (Clinical Deep Navy)
══════════════════════════════ -->
<footer class="lfooter">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <a href="#" class="footer-brand-logo">
                    <div class="fb-icon"><i class="fa-solid fa-flask-vial"></i></div>
                    {{ config('app.name', 'SUHAIM SOFT LAB') }}
                </a>
                <p>A next-generation Laboratory Information Management System built to streamline diagnostics, automate reports, and elevate clinical patient care.</p>
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
                    <li><a href="#">Report Automation</a></li>
                    <li><a href="#">Patient Records</a></li>
                    <li><a href="#">WhatsApp Delivery</a></li>
                    <li><a href="#">Billing & Invoicing</a></li>
                    <li><a href="#">Clinical Analytics</a></li>
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
            <p>&copy; {{ date('Y') }} SUHAIM SOFT LAB. All rights reserved.</p>
            <p>Crafted with clinical excellence by <a href="https://suhaimsoft.com" target="_blank">Suhaim Soft</a></p>
        </div>
    </div>
</footer>

<!-- ══════════════════════════════
     FLOATING ACTION BUTTONS
     - Left: Upper Arrow (Scroll to Top)
     - Right: WhatsApp Chat Button & Popup
══════════════════════════════ -->
<!-- Left: Upper Arrow (Scroll to Top) -->
<button class="fab-top-left" id="fabTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to Top" title="Back to Top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Right: WhatsApp Floating Widget -->
<button class="fab-wa-right" onclick="toggleWaPopup()" aria-label="Chat on WhatsApp" title="Chat on WhatsApp">
    <div class="fab-wa-icon"><i class="fa-brands fa-whatsapp"></i></div>
    <div class="fab-wa-text">
        <span class="fab-wa-title">WhatsApp</span>
        <span class="fab-wa-sub">Online Support</span>
    </div>
</button>

<!-- WhatsApp Popup -->
<div class="wa-popup" id="waPopup">
    <div class="wa-popup-head">
        <div class="wa-head-info">
            <div class="wa-head-avatar"><i class="fa-brands fa-whatsapp"></i></div>
            <div>
                <div class="wa-head-title">{{ config('app.name', 'SUHAIM SOFT LAB') }}</div>
                <div class="wa-head-sub"><span class="wa-online-dot"></span> Online Support</div>
            </div>
        </div>
        <button onclick="toggleWaPopup()" aria-label="Close Popup"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="wa-popup-body">
        <div class="wa-bubble">
            👋 Welcome to <strong>{{ config('app.name', 'SUHAIM SOFT LAB') }}</strong>!<br><br>
            How can we assist your diagnostic center today? Inquire about live demos, setup, or technical support.
        </div>
    </div>
    <div class="wa-popup-foot">
        <a href="https://wa.me/918891479505" target="_blank">
            <i class="fa-brands fa-whatsapp"></i> Start Chat on WhatsApp
        </a>
    </div>
</div>

<!-- ══════════════════════════════
     ENROLL MODAL (Request Free Demo)
══════════════════════════════ -->
<div class="modal fade enroll-modal" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollModalLabel"><i class="fa-solid fa-rocket me-2" style="color:var(--primary);"></i>Request a Free Demo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:22px;">Fill out the form below and our medical software specialists will contact you within 24 hours.</p>
                <form id="enrollForm">
                    <div class="mb-3">
                        <label class="form-label">Full Name / Doctor Name</label>
                        <input type="text" class="form-control" placeholder="e.g. Dr. Ahmed" required autocomplete="off" name="enroll_name" id="enroll_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone / WhatsApp Number</label>
                        <input type="tel" class="form-control" placeholder="+91 00000 00000" required autocomplete="off" name="enroll_phone" id="enroll_phone">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Laboratory Name & Requirements</label>
                        <textarea class="form-control" rows="3" placeholder="Tell us about your diagnostic center..." autocomplete="off" name="enroll_msg" id="enroll_msg"></textarea>
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
        nav.classList.toggle('scrolled', window.scrollY > 30);
        // Back to top
        const fabTop = document.getElementById('fabTop');
        if (fabTop) {
            fabTop.classList.toggle('visible', window.scrollY > 400);
        }
    });

    // Mobile menu toggle
    const navToggle = document.getElementById('navToggle');
    if (navToggle) {
        navToggle.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.toggle('open');
        });
    }

    // Close mobile menu on link click
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            const mm = document.getElementById('mobileMenu');
            if (mm) mm.classList.remove('open');
        });
    });

    // WhatsApp popup
    window.toggleWaPopup = function() {
        const wp = document.getElementById('waPopup');
        if (wp) wp.classList.toggle('open');
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
            if (el && window.scrollY >= el.offsetTop - 120) current = id;
        });
        navLinks.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href') === '#' + current);
        });
    });
    // Enroll Form Submit Handler
    const enrollForm = document.getElementById('enrollForm');
    if (enrollForm) {
        enrollForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('enroll_name').value;
            const phone = document.getElementById('enroll_phone').value;
            const msg = document.getElementById('enroll_msg').value;
            const waText = encodeURIComponent(`Hello Suhaim Soft, I would like to request a free demo.\n\nName: ${name}\nPhone: ${phone}\nDetails: ${msg}`);
            
            // Close modal using bootstrap
            const modalEl = document.getElementById('enrollModal');
            if (modalEl && typeof bootstrap !== 'undefined') {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
            
            // Redirect to WhatsApp
            window.open(`https://wa.me/918891479505?text=${waText}`, '_blank');
        });
    }
})();
</script>
</body>
</html>
