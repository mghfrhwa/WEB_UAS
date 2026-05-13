
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaya Teknik Engineering - Solusi Las & Konstruksi Terpercaya</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

    <style>
        /* ============ RESET & BASE ============ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #8aafa8;
            --primary-dark: #3730a3;
            --primary-light: #3498db;
            --accent: #1abc9c;
            --accent-dark: #12a689;
            --dark: #2c3e50;
            --dark-2: #1e293b;
            --dark-3: #334155;
            --mid: #64748b;
            --light: #f8fafc;
            --light-2: #f1f5f9;
            --white: #ffffff;
            --glass-bg: rgba(255,255,255,0.92);
            --glass-border: rgba(255,255,255,0.6);
            --font-display: 'Sora', sans-serif;
            --font-body: 'DM Sans', sans-serif;
            --radius: 16px;
            --shadow: 0 8px 32px rgba(31,38,135,0.10);
            --shadow-lg: 0 20px 60px rgba(15,23,42,0.18);
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--white);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Styling yang diminta */
        .nav-tabs .nav-link { color: #6c757d; border-bottom: 3px solid transparent; transition: all 0.3s; }
        .nav-tabs .nav-link:hover { color: var(--primary); border-color: transparent; }
        .nav-tabs .nav-link.active { color: var(--primary) !important; background: transparent; border-bottom: 3px solid var(--primary); }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            border-radius: var(--radius);
        }
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(31,38,135,0.15); }
        .icon-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; }
        .text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .custom-table thead th { border-bottom: 2px solid #edf2f7; font-weight: 600; letter-spacing: 0.5px; }
        .custom-table tbody tr { transition: background-color 0.2s; }
        .custom-table tbody tr:hover { background-color: rgba(79,70,229,0.03); }
        .custom-table td { vertical-align: middle; padding-top: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9; }
        .custom-table tr:last-child td { border-bottom: none; }

        /* ============ NAVBAR ============ */
        .navbar-jte {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            transition: all 0.4s ease;
            padding: 0;
        }
        .navbar-jte.scrolled {
            background: rgba(255,255,255,0.96) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(15,23,42,0.10);
        }
        .topbar {
            background: var(--dark);
            color: rgba(255,255,255,0.85);
            font-size: 0.8rem;
            padding: 8px 0;
            font-family: var(--font-body);
        }
        .topbar a { color: rgba(255,255,255,0.75); text-decoration: none; transition: color 0.2s; }
        .topbar a:hover { color: var(--accent); }

        .main-nav {
            background: rgba(255,255,255,0.97);
            padding: 14px 0;
            box-shadow: 0 2px 20px rgba(15,23,42,0.06);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.1rem;
        }
        .brand-text strong {
            display: block;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }
        .brand-text span {
            font-size: 0.72rem;
            color: var(--mid);
            letter-spacing: 0.5px;
        }

        .nav-menu { display: flex; align-items: center; gap: 4px; list-style: none; margin: 0; padding: 0; }
        .nav-menu li a {
            padding: 8px 14px;
            color: var(--dark-3);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
            font-family: var(--font-body);
        }
        .nav-menu li a:hover { background: var(--light-2); color: var(--primary); }
        .nav-menu li a.active { color: var(--primary); background: rgba(79,70,229,0.08); }

        .btn-nav-cta {
            background: var(--primary);
            color: white !important;
            border-radius: 10px !important;
            padding: 9px 20px !important;
            font-weight: 600 !important;
            transition: all 0.2s !important;
        }
        .btn-nav-cta:hover { background: var(--primary-dark) !important; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.35) !important; }

        /* ============ HAMBURGER ============ */
        .nav-toggler {
            display: none;
            background: none; border: none;
            flex-direction: column; gap: 5px; cursor: pointer; padding: 4px;
        }
        .nav-toggler span { width: 24px; height: 2px; background: var(--dark); border-radius: 2px; transition: all 0.3s; display: block; }
        @media (max-width: 992px) {
            .nav-toggler { display: flex; }
            .nav-menu-wrap {
                display: none;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: white;
                padding: 16px 24px 24px;
                box-shadow: 0 8px 24px rgba(15,23,42,0.1);
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-menu-wrap.open { display: flex; }
            .nav-menu { flex-direction: column; width: 100%; gap: 2px; }
            .nav-menu li { width: 100%; }
            .nav-menu li a { display: block; }
        }

        /* ============ SECTION COMMON ============ */
        section { padding: 90px 0; }
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(79,70,229,0.08);
            color: var(--primary);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 50px;
            margin-bottom: 16px;
        }
        .section-badge::before {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--primary);
        }
        .section-title {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
            margin-bottom: 12px;
        }
        .section-sub {
            color: var(--mid);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 560px;
        }

        /* ============ SECTION 1: HERO CAROUSEL ============ */
        #hero {
            padding: 0;
            margin-top: 0;
        }
        .hero-carousel { position: relative; height: 100vh; min-height: 560px; overflow: hidden; }
        .hero-slide {
            position: absolute; inset: 0;
            display: flex; align-items: center;
            opacity: 0; transition: opacity 0.8s ease;
            z-index: 1;
        }
        .hero-slide.active { opacity: 1; z-index: 2; }
        .hero-bg {
            position: absolute; inset: 0;
            background-size: cover;
            background-position: center;
        }
        .hero-bg::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(110deg, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.55) 50%, rgba(15,23,42,0.3) 100%);
        }
        .hero-content {
            position: relative; z-index: 2;
            max-width: 1200px; margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(245,158,11,0.2);
            border: 1px solid rgba(245,158,11,0.4);
            color: var(--accent);
            font-size: 0.8rem; font-weight: 600;
            letter-spacing: 1.2px; text-transform: uppercase;
            padding: 7px 16px; border-radius: 50px;
            margin-bottom: 20px;
        }
        .hero-tag::before { content: '●'; font-size: 0.5rem; }
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 5vw, 4rem);
            font-weight: 800;
            color: white;
            line-height: 1.15;
            margin-bottom: 18px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .hero-title span { color: var(--accent); }
        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.82);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 32px;
        }
        .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-hero-primary {
            background: var(--primary);
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s;
        }
        .btn-hero-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,0.4); color: white; }
        .btn-hero-outline {
            background: transparent;
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: 2px solid rgba(255,255,255,0.5);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s;
        }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.12); border-color: white; color: white; }

        /* Feature cards pada hero */
        .hero-features {
            position: absolute; right: 40px; bottom: 80px;
            display: flex; flex-direction: column; gap: 12px;
            z-index: 3;
        }
        .hero-feat-card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 14px;
            padding: 14px 18px;
            min-width: 220px;
            display: flex; align-items: center; gap: 12px;
            color: white;
            transition: all 0.3s;
        }
        .hero-feat-card:hover { background: rgba(255,255,255,0.2); transform: translateX(-4px); }
        .hero-feat-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .hero-feat-card strong { display: block; font-size: 0.88rem; font-weight: 600; }
        .hero-feat-card small { font-size: 0.76rem; opacity: 0.75; }

        /* Carousel Controls */
        .carousel-controls {
            position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
            z-index: 10; display: flex; align-items: center; gap: 8px;
        }
        .carousel-dot {
            width: 8px; height: 8px;
            border-radius: 50%; background: rgba(255,255,255,0.4);
            cursor: pointer; border: none;
            transition: all 0.3s;
        }
        .carousel-dot.active { width: 24px; border-radius: 4px; background: white; }
        .carousel-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            z-index: 10; background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.25);
            color: white; width: 48px; height: 48px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.3s; font-size: 1rem;
        }
        .carousel-arrow:hover { background: rgba(255,255,255,0.28); }
        .carousel-prev { left: 24px; }
        .carousel-next { right: 24px; }

        @media (max-width: 768px) {
            .hero-features { display: none; }
            .hero-carousel { height: 90vh; }
        }

        /* ============ SECTION 2: STATISTIK ============ */
        #statistik { background: var(--white); }
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 30px 24px;
            border: 1px solid #e2e8f0;
            text-align: center;
            position: relative; overflow: hidden;
            transition: all 0.3s;
        }
        .stat-card::before {
            content: ''; position: absolute;
            bottom: 0; left: 0; right: 0; height: 4px;
        }
        .stat-card:hover { border-color: transparent; box-shadow: var(--shadow); transform: translateY(-4px); }
        .stat-card .stat-icon {
            width: 64px; height: 64px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; margin: 0 auto 16px;
        }
        .stat-card .stat-number {
            font-family: var(--font-display);
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 6px;
        }
        .stat-card .stat-label {
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--mid);
        }

        /* Preview project cards */
        .preview-card {
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            cursor: pointer;
            height: 280px;
        }
        .preview-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .preview-card:hover img { transform: scale(1.05); }
        .preview-card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(0deg, rgba(15,23,42,0.85) 0%, transparent 55%);
            display: flex; flex-direction: column;
            justify-content: flex-end; padding: 20px;
        }
        .preview-card-badge {
            position: absolute; top: 14px; right: 14px;
            padding: 4px 12px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 700; color: white;
        }

        /* ============ SECTION 3: LANGKAH PENGERJAAN ============ */
        #proses { background: var(--light); }
        .step-timeline { position: relative; }
        .step-timeline::before {
            content: '';
            position: absolute;
            left: 50%; top: 0; bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--primary), var(--accent));
            transform: translateX(-50%);
        }
        .step-item {
            display: flex; align-items: center;
            margin-bottom: 40px; position: relative;
        }
        .step-item:nth-child(odd) { flex-direction: row; }
        .step-item:nth-child(even) { flex-direction: row-reverse; }
        .step-content {
            width: calc(50% - 40px);
            padding: 28px;
            border-radius: var(--radius);
            background: white;
            border: 1px solid #e8ecf0;
            transition: all 0.3s;
        }
        .step-content:hover { box-shadow: var(--shadow); border-color: transparent; transform: translateY(-3px); }
        .step-number-wrap {
            position: absolute; left: 50%; transform: translateX(-50%);
            width: 56px; height: 56px; border-radius: 50%;
            background: white;
            border: 3px solid var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display);
            font-weight: 800; font-size: 1.1rem;
            color: var(--primary); z-index: 2;
            box-shadow: 0 0 0 6px var(--light);
        }
        .step-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            background: rgba(79,70,229,0.08);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: var(--primary);
            margin-bottom: 14px;
        }
        .step-content h5 {
            font-family: var(--font-display);
            font-weight: 700; font-size: 1.05rem;
            color: var(--dark); margin-bottom: 8px;
        }
        .step-content p { font-size: 0.9rem; color: var(--mid); line-height: 1.6; margin: 0; }

        @media (max-width: 768px) {
            .step-timeline::before { left: 28px; }
            .step-item, .step-item:nth-child(even) { flex-direction: column; padding-left: 72px; }
            .step-content { width: 100%; }
            .step-number-wrap { left: 0; transform: none; }
        }

        /* ============ SECTION 4: GALERI KATALOG ============ */
        #galeri { background: var(--white); }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .gallery-item {
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 1;
            position: relative; cursor: pointer;
        }
        .gallery-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img { transform: scale(1.08); }
        .gallery-item-overlay {
            position: absolute; inset: 0;
            background: rgba(79,70,229,0.7);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s;
            color: white; font-size: 1.5rem;
        }
        .gallery-item:hover .gallery-item-overlay { opacity: 1; }
        .gallery-item.large { grid-column: span 2; grid-row: span 2; aspect-ratio: auto; }

        @media (max-width: 992px) { .gallery-grid { grid-template-columns: repeat(2, 1fr); } .gallery-item.large { grid-column: span 1; grid-row: span 1; } }
        @media (max-width: 576px) { .gallery-grid { grid-template-columns: 1fr 1fr; } }

        /* ============ SECTION 5: PROFIL PERUSAHAAN ============ */
        #profil { background: var(--light); }
        .profile-image-wrap {
            position: relative;
            border-radius: 20px; overflow: hidden;
        }
        .profile-image-wrap img {
            width: 100%; border-radius: 20px;
            box-shadow: var(--shadow-lg);
        }
        .profile-badge-float {
            position: absolute; bottom: -16px; right: -16px;
            background: var(--primary);
            color: white; border-radius: 16px;
            padding: 16px 20px;
            font-family: var(--font-display);
            box-shadow: 0 8px 24px rgba(79,70,229,0.4);
        }
        .profile-badge-float strong { display: block; font-size: 2rem; font-weight: 800; line-height: 1; }
        .profile-badge-float span { font-size: 0.8rem; opacity: 0.85; }

        .profile-text blockquote {
            border-left: 4px solid var(--primary);
            padding-left: 20px;
            font-style: italic;
            color: var(--mid);
            margin: 20px 0;
            font-size: 1.05rem;
        }
        .timeline-mini { list-style: none; padding: 0; }
        .timeline-mini li {
            display: flex; gap: 12px; margin-bottom: 14px;
            align-items: flex-start;
        }
        .timeline-mini li .yr {
            font-family: var(--font-display);
            font-weight: 700; color: var(--primary);
            font-size: 0.88rem; min-width: 44px;
        }
        .timeline-mini li p { font-size: 0.9rem; color: var(--dark-3); margin: 0; line-height: 1.5; }

        /* ============ SECTION 6: KEUNGGULAN ============ */
        #keunggulan { background: var(--white); }
        .unggulan-card {
            padding: 28px 24px;
            border-radius: var(--radius);
            border: 1.5px solid #e8ecf0;
            text-align: center;
            transition: all 0.35s;
            height: 100%;
            position: relative; overflow: hidden;
        }
        .unggulan-card::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(79,70,229,0.03), rgba(245,158,11,0.03));
            opacity: 0; transition: opacity 0.3s;
        }
        .unggulan-card:hover { border-color: var(--primary-light); transform: translateY(-5px); box-shadow: 0 12px 40px rgba(79,70,229,0.12); }
        .unggulan-card:hover::after { opacity: 1; }
        .unggulan-icon {
            width: 72px; height: 72px;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; margin: 0 auto 16px;
        }
        .unggulan-card h6 {
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 700;
            color: var(--dark); margin-bottom: 8px;
        }
        .unggulan-card p { font-size: 0.86rem; color: var(--mid); line-height: 1.6; margin: 0; }

        /* ============ SECTION 7: LOKASI ============ */
        #lokasi { background: var(--light); }
        .contact-info-card {
            background: white;
            border-radius: var(--radius);
            padding: 32px;
            border: 1px solid #e2e8f0;
            height: 100%;
        }
        .contact-row {
            display: flex; gap: 14px; align-items: flex-start;
            padding: 14px 0; border-bottom: 1px solid #f1f5f9;
        }
        .contact-row:last-of-type { border-bottom: none; }
        .contact-row .ci-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .contact-row strong { display: block; font-size: 0.85rem; font-weight: 600; color: var(--dark); }
        .contact-row p { font-size: 0.85rem; color: var(--mid); margin: 2px 0 0; line-height: 1.5; }
        .map-embed { border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); }
        .map-embed iframe { width: 100%; height: 400px; border: 0; display: block; }

        /* ============ BUTTONS GLOBAL ============ */
        .btn-primary-jte {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600; font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s; cursor: pointer;
        }
        .btn-primary-jte:hover { background: var(--primary-dark); color: white; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(79,70,229,0.35); }
        .btn-outline-jte {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
            padding: 11px 24px;
            border-radius: 10px;
            font-weight: 600; font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s; cursor: pointer;
        }
        .btn-outline-jte:hover { background: var(--primary); color: white; }

        /* ============ SCROLL ANIMATION ============ */
        .reveal {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ============ UTILITIES ============ */
        .text-primary-jte { color: var(--primary) !important; }
        .text-accent { color: var(--accent) !important; }
        .bg-primary-jte { background: var(--primary) !important; }
        .pt-navbar { padding-top: 118px; }
    </style>
</head>
<body>

<!-- ============ NAVBAR ============ -->
<header class="navbar-jte" id="mainNav">
    <div class="main-nav" style="position:relative;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="#hero" class="nav-brand">
                    <div class="brand-icon"><i class="fas fa-tools"></i></div>
                    <div class="brand-text">
                        <strong>Jaya Teknik</strong>
                        <span>Engineering</span>
                    </div>
                </a>

                <div class="nav-menu-wrap" id="navMenu">
                    <ul class="nav-menu">
                        <li><a href="#hero" class="active">Beranda</a></li>
                        <li><a href="#statistik">Statistik</a></li>
                        <li><a href="#proses">Proses</a></li>
                        <li><a href="#galeri">Katalog</a></li>
                        <li><a href="#profil">Profil</a></li>
                        <li><a href="#keunggulan">Keunggulan</a></li>
                        <li><a href="#lokasi">Lokasi</a></li>
                        <li><a href="{{ route('login') }}" class="btn-nav-cta">Pesan Sekarang</a></li>
                    </ul>
                </div>

                <button class="nav-toggler" id="navToggler" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- ============ SECTION 1: HERO CAROUSEL ============ -->
<section id="hero">
    <div class="hero-carousel" id="heroCarousel">

        <!-- Slide 1 -->
        <div class="hero-slide active">
            <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1600');"></div>
            <div class="hero-content">
                <div class="hero-tag">Bengkel Las Profesional</div>
                <h1 class="hero-title">Ahli Las & <span>Konstruksi</span><br>Besi Terpercaya</h1>
                <p class="hero-desc">Jaya Teknik Engineering hadir dengan teknologi modern dan tenaga ahli berpengalaman untuk setiap kebutuhan las dan konstruksi Anda.</p>
                <div class="hero-btns">
                    <a href="#galeri" class="btn-hero-primary"><i class="fas fa-images"></i> Lihat Katalog</a>
                    <a href="#lokasi" class="btn-hero-outline"><i class="fas fa-phone"></i> Hubungi Kami</a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=1600');"></div>
            <div class="hero-content">
                <div class="hero-tag">Kualitas Terjamin</div>
                <h1 class="hero-title">Dari Rancangan <span>hingga</span><br>Produk Jadi</h1>
                <p class="hero-desc">Kami menangani proses lengkap: perancangan, pengerjaan komponen, perakitan mesin, uji coba, hingga finishing berkualitas tinggi.</p>
                <div class="hero-btns">
                    <a href="#proses" class="btn-hero-primary"><i class="fas fa-cogs"></i> Lihat Proses</a>
                    <a href="#profil" class="btn-hero-outline"><i class="fas fa-info-circle"></i> Tentang Kami</a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600');"></div>
            <div class="hero-content">
                <div class="hero-tag">Pengalaman 15+ Tahun</div>
                <h1 class="hero-title">Solusi <span>Engineering</span><br>untuk Industri Anda</h1>
                <p class="hero-desc">Lebih dari 500 proyek berhasil diselesaikan dengan kepuasan pelanggan sebagai prioritas utama kami.</p>
                <div class="hero-btns">
                    <a href="#statistik" class="btn-hero-primary"><i class="fas fa-chart-bar"></i> Lihat Statistik</a>
                    <a href="#keunggulan" class="btn-hero-outline"><i class="fas fa-star"></i> Keunggulan Kami</a>
                </div>
            </div>
        </div>

        <!-- Feature Cards Kanan -->
        <div class="hero-features">
            <div class="hero-feat-card">
                <div class="hero-feat-icon" style="background:rgba(79,70,229,0.25);color:#818cf8;"><i class="fas fa-certificate"></i></div>
                <div><strong>Bersertifikasi Resmi</strong><small>SNI & Kemnaker RI</small></div>
            </div>
            <div class="hero-feat-card">
                <div class="hero-feat-icon" style="background:rgba(245,158,11,0.2);color:#f59e0b;"><i class="fas fa-tools"></i></div>
                <div><strong>Peralatan Modern</strong><small>Teknologi terkini</small></div>
            </div>
            <div class="hero-feat-card">
                <div class="hero-feat-icon" style="background:rgba(16,185,129,0.2);color:#10b981;"><i class="fas fa-headset"></i></div>
                <div><strong>Layanan 24/7</strong><small>Siap melayani Anda</small></div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-arrow carousel-prev" id="heroPrev"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-arrow carousel-next" id="heroNext"><i class="fas fa-chevron-right"></i></button>
        <div class="carousel-controls" id="carouselDots">
            <button class="carousel-dot active"></button>
            <button class="carousel-dot"></button>
            <button class="carousel-dot"></button>
        </div>
    </div>
</section>

<!-- ============ SECTION 2: STATISTIK ============ -->
<section id="statistik">
    <div class="container">
        <!-- Stat Numbers -->
        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3 reveal">
                <div class="stat-card" style="border-top: 4px solid #4f46e5;">
                    <div class="stat-icon" style="background:rgba(79,70,229,0.08);color:#4f46e5;"><i class="fas fa-clipboard-check"></i></div>
                    <div class="stat-number" style="color:#4f46e5;">500+</div>
                    <div class="stat-label">Total Proyek</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal reveal-delay-1">
                <div class="stat-card" style="border-top: 4px solid #f59e0b;">
                    <div class="stat-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-users"></i></div>
                    <div class="stat-number" style="color:#f59e0b;">350+</div>
                    <div class="stat-label">Customer Puas</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal reveal-delay-2">
                <div class="stat-card" style="border-top: 4px solid #10b981;">
                    <div class="stat-icon" style="background:rgba(16,185,129,0.08);color:#10b981;"><i class="fas fa-hard-hat"></i></div>
                    <div class="stat-number" style="color:#10b981;">45</div>
                    <div class="stat-label">Tenaga Ahli</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal reveal-delay-3">
                <div class="stat-card" style="border-top: 4px solid #8b5cf6;">
                    <div class="stat-icon" style="background:rgba(139,92,246,0.08);color:#8b5cf6;"><i class="fas fa-industry"></i></div>
                    <div class="stat-number" style="color:#8b5cf6;">3</div>
                    <div class="stat-label">Bengkel</div>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="text-center mb-5 reveal">
            <div class="section-badge">Kebanggaan Kami</div>
            <h2 class="section-title">Proyek Unggulan</h2>
            <p class="section-sub mx-auto">Karya terbaik yang telah dipercayakan klien kepada kami di berbagai bidang industri</p>
        </div>

        <!-- Project Preview Cards -->
        <div class="row g-4">
            <div class="col-md-3 reveal">
                <div class="preview-card hover-lift">
                    <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600" alt="Konstruksi Baja">
                    <div class="preview-card-overlay">
                        <span class="preview-card-badge" style="background:#4f46e5;"><i class="fas fa-star me-1"></i> Unggulan</span>
                        <div>
                            <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);letter-spacing:1px;text-transform:uppercase;margin-bottom:4px;">Manufaktur · 2024</div>
                            <div style="font-weight:700;color:white;font-size:1rem;">Konstruksi Rangka Baja</div>
                            <div style="font-size:0.82rem;color:rgba(255,255,255,0.75);margin-top:4px;"><i class="fas fa-user me-1"></i> PT. Maju Jaya</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 reveal reveal-delay-1">
                <div class="preview-card hover-lift">
                    <img src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=600" alt="Las TIG">
                    <div class="preview-card-overlay">
                        <span class="preview-card-badge" style="background:#f59e0b;"><i class="fas fa-trophy me-1"></i> Best Work</span>
                        <div>
                            <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);letter-spacing:1px;text-transform:uppercase;margin-bottom:4px;">Las Presisi · 2024</div>
                            <div style="font-weight:700;color:white;font-size:1rem;">Pengelasan TIG Stainless</div>
                            <div style="font-size:0.82rem;color:rgba(255,255,255,0.75);margin-top:4px;"><i class="fas fa-user me-1"></i> CV. Karya Mandiri</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 reveal reveal-delay-2">
                <div class="preview-card hover-lift">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600" alt="Mesin Custom">
                    <div class="preview-card-overlay">
                        <span class="preview-card-badge" style="background:#10b981;"><i class="fas fa-check me-1"></i> Selesai</span>
                        <div>
                            <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);letter-spacing:1px;text-transform:uppercase;margin-bottom:4px;">Mekanikal · 2023</div>
                            <div style="font-weight:700;color:white;font-size:1rem;">Fabrikasi Mesin Custom</div>
                            <div style="font-size:0.82rem;color:rgba(255,255,255,0.75);margin-top:4px;"><i class="fas fa-user me-1"></i> UD. Sejahtera</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 reveal reveal-delay-3">
                <div class="preview-card hover-lift">
                    <img src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=600" alt="Konstruksi">
                    <div class="preview-card-overlay">
                        <span class="preview-card-badge" style="background:#8b5cf6;"><i class="fas fa-medal me-1"></i> Nasional</span>
                        <div>
                            <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);letter-spacing:1px;text-transform:uppercase;margin-bottom:4px;">Konstruksi · 2023</div>
                            <div style="font-weight:700;color:white;font-size:1rem;">Struktur Jembatan Mini</div>
                            <div style="font-size:0.82rem;color:rgba(255,255,255,0.75);margin-top:4px;"><i class="fas fa-user me-1"></i> Dinas PU Kab. Kediri</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 reveal">
            <a href="#galeri" class="btn-outline-jte">Lihat Semua Proyek <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ============ SECTION 3: LANGKAH PENGERJAAN ============ -->
<section id="proses">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 reveal">
                <div class="section-badge">Alur Kerja</div>
                <h2 class="section-title">Langkah Pengerjaan</h2>
            </div>
            <div class="col-md-6 reveal reveal-delay-1">
                <p class="section-sub mt-md-4">Setiap proyek kami kerjakan dengan alur yang terstruktur dan terstandarisasi untuk memastikan hasil terbaik dan tepat waktu.</p>
            </div>
        </div>

        <div class="step-timeline">
            <div class="step-item reveal">
                <div class="step-content">
                    <div class="step-icon"><i class="fas fa-drafting-compass"></i></div>
                    <h5>Perancangan</h5>
                    <p>Tim engineer kami membuat desain teknis, gambar kerja, dan kalkulasi material sesuai kebutuhan dan spesifikasi klien.</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <span style="background:rgba(79,70,229,0.08);color:#4f46e5;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">CAD Design</span>
                        <span style="background:rgba(79,70,229,0.08);color:#4f46e5;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Kalkulasi Beban</span>
                    </div>
                </div>
                <div class="step-number-wrap">01</div>
            </div>

            <div class="step-item reveal reveal-delay-1">
                <div class="step-content">
                    <div class="step-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-cut"></i></div>
                    <h5>Pengerjaan Komponen</h5>
                    <p>Pemotongan, pembentukan, dan pengerjaan komponen menggunakan mesin CNC dan peralatan presisi tinggi.</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <span style="background:rgba(245,158,11,0.08);color:#f59e0b;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">CNC Cutting</span>
                        <span style="background:rgba(245,158,11,0.08);color:#f59e0b;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Bending & Rolling</span>
                    </div>
                </div>
                <div class="step-number-wrap" style="border-color:#f59e0b;color:#f59e0b;">02</div>
            </div>

            <div class="step-item reveal">
                <div class="step-content">
                    <div class="step-icon" style="background:rgba(16,185,129,0.08);color:#10b981;"><i class="fas fa-industry"></i></div>
                    <h5>Perakitan Mesin</h5>
                    <p>Semua komponen dirakit oleh teknisi bersertifikat dengan mengikuti standar keselamatan kerja yang ketat.</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <span style="background:rgba(16,185,129,0.08);color:#10b981;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Assembly</span>
                        <span style="background:rgba(16,185,129,0.08);color:#10b981;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Welding Presisi</span>
                    </div>
                </div>
                <div class="step-number-wrap" style="border-color:#10b981;color:#10b981;">03</div>
            </div>

            <div class="step-item reveal reveal-delay-1">
                <div class="step-content">
                    <div class="step-icon" style="background:rgba(139,92,246,0.08);color:#8b5cf6;"><i class="fas fa-clipboard-check"></i></div>
                    <h5>Uji Coba</h5>
                    <p>Setiap produk melewati serangkaian pengujian kualitas, uji beban, dan verifikasi terhadap spesifikasi desain awal.</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <span style="background:rgba(139,92,246,0.08);color:#8b5cf6;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Quality Control</span>
                        <span style="background:rgba(139,92,246,0.08);color:#8b5cf6;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Load Testing</span>
                    </div>
                </div>
                <div class="step-number-wrap" style="border-color:#8b5cf6;color:#8b5cf6;">04</div>
            </div>

            <div class="step-item reveal">
                <div class="step-content">
                    <div class="step-icon" style="background:rgba(239,68,68,0.08);color:#ef4444;"><i class="fas fa-paint-roller"></i></div>
                    <h5>Finishing</h5>
                    <p>Pengecatan anti karat, sandblasting, dan treatment akhir untuk memastikan ketahanan dan estetika produk jangka panjang.</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <span style="background:rgba(239,68,68,0.08);color:#ef4444;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Sandblasting</span>
                        <span style="background:rgba(239,68,68,0.08);color:#ef4444;padding:4px 10px;border-radius:6px;font-size:0.78rem;font-weight:600;">Anti-Rust Coating</span>
                    </div>
                </div>
                <div class="step-number-wrap" style="border-color:#ef4444;color:#ef4444;">05</div>
            </div>
        </div>

        <!-- Login SIMAS style side card - Login Konsultasi -->
        <div class="row justify-content-center mt-5 reveal">
            <div class="col-md-8">
                <div style="background:linear-gradient(135deg,#4f46e5,#3730a3);border-radius:20px;padding:36px;color:white;text-align:center;">
                    <div style="width:64px;height:64px;background:rgba(255,255,255,0.15);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 16px;"><i class="fas fa-comments"></i></div>
                    <h4 style="font-family:var(--font-display);font-weight:700;margin-bottom:8px;">Konsultasikan Proyek Anda</h4>
                    <p style="opacity:0.85;margin-bottom:24px;font-size:0.95rem;">Tim engineer kami siap membantu merencanakan dan mewujudkan kebutuhan konstruksi & las Anda</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="https://wa.me/6285646712902" target="_blank" style="background:rgba(255,255,255,0.18);border:1px solid rgba(255,255,255,0.3);color:white;padding:10px 20px;border-radius:10px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        <a href="{{ route('login') }}" style="background:white;color:#4f46e5;padding:10px 20px;border-radius:10px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fas fa-phone"></i> Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 4: GALERI KATALOG ============ -->
<section id="galeri">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3 reveal">
            <div>
                <div class="section-badge">Galeri</div>
                <h2 class="section-title mb-1">Galeri Katalog Produk</h2>
                <p class="section-sub">Momen dan karya terbaik dari berbagai proyek kami</p>
            </div>
            <a href="#" class="btn-outline-jte">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
        </div>

        <div class="gallery-grid reveal">
            <div class="gallery-item large">
                <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=800" alt="Las Konstruksi">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=400" alt="Las TIG">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400" alt="Mesin">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=400" alt="Konstruksi">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1563906267088-b029e7101114?w=400" alt="Fabrikasi">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1536240478700-b869ad10e128?w=400" alt="Workshop">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400" alt="Finishing">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=400" alt="Produk Las">
                <div class="gallery-item-overlay"><i class="fas fa-expand"></i></div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 5: PROFIL PERUSAHAAN ============ -->
<section id="profil">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 reveal">
                <div class="profile-image-wrap" style="padding-bottom:24px;padding-right:24px;">
                    <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=700" alt="Profil Bengkel">
                    <div class="profile-badge-float">
                        <strong>15+</strong>
                        <span>Tahun Pengalaman</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 reveal reveal-delay-1">
                <div class="section-badge">Sambutan</div>
                <h2 class="section-title">Profil &<br>Sejarah Perusahaan</h2>

                <blockquote class="profile-text">
                    "Bismillah, dengan niat yang tulus kami mendirikan Jaya Teknik Engineering untuk memberikan solusi konstruksi dan las terbaik bagi masyarakat industri Indonesia."
                </blockquote>

                <p style="color:var(--dark-3);line-height:1.8;margin-bottom:16px;">
                    <strong>Jaya Teknik Engineering</strong> adalah perusahaan bengkel las dan fabrikasi logam yang berdiri sejak 2009 di Kediri, Jawa Timur. Kami memulai perjalanan sebagai bengkel kecil dengan 3 orang tenaga ahli, dan kini telah berkembang menjadi perusahaan engineering terpercaya dengan lebih dari 45 tenaga profesional bersertifikat.
                </p>

                <p style="color:var(--mid);line-height:1.8;margin-bottom:28px;">
                    Dengan dukungan peralatan modern seperti mesin CNC, plasma cutting, dan welding robot, kami mampu menangani proyek dari skala kecil hingga industri besar. Kepuasan klien dan kualitas hasil kerja selalu menjadi komitmen utama kami.
                </p>

                <ul class="timeline-mini mb-4">
                    <li>
                        <span class="yr">2009</span>
                        <p>Berdiri sebagai bengkel las rumahan di Kediri dengan 3 tenaga ahli</p>
                    </li>
                    <li>
                        <span class="yr">2013</span>
                        <p>Ekspansi ke fabrikasi komponen industri, meraih sertifikasi SNI</p>
                    </li>
                    <li>
                        <span class="yr">2018</span>
                        <p>Pembukaan bengkel ke-2 dan ke-3, investasi mesin CNC & plasma cutting</p>
                    </li>
                    <li>
                        <span class="yr">2024</span>
                        <p>500+ proyek selesai, 350+ pelanggan aktif, ekspansi ke Jawa Tengah</p>
                    </li>
                </ul>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="#lokasi" class="btn-primary-jte"><i class="fas fa-envelope"></i> Hubungi Kami</a>
                    <a href="#galeri" class="btn-outline-jte">Lihat Katalog <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 6: KEUNGGULAN ============ -->
<section id="keunggulan">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="section-badge">Keunggulan Kami</div>
            <h2 class="section-title">Mengapa Memilih<br>Jaya Teknik?</h2>
            <p class="section-sub mx-auto">Kami hadir dengan komitmen penuh menghadirkan solusi engineering yang <strong style="color:var(--primary);">tepat, cepat, dan terpercaya</strong></p>
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-4 col-lg-2 reveal">
                <div class="unggulan-card hover-lift">
                    <div class="unggulan-icon" style="background:rgba(79,70,229,0.08);color:#4f46e5;"><i class="fas fa-medal"></i></div>
                    <h6>Bengkel Terpercaya</h6>
                    <p>Reputasi terbaik di Jawa Timur sejak 2009</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 reveal reveal-delay-1">
                <div class="unggulan-card hover-lift">
                    <div class="unggulan-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-user-tie"></i></div>
                    <h6>Teknisi Bersertifikat</h6>
                    <p>Tenaga ahli berpengalaman & tersertifikasi</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 reveal reveal-delay-2">
                <div class="unggulan-card hover-lift">
                    <div class="unggulan-icon" style="background:rgba(16,185,129,0.08);color:#10b981;"><i class="fas fa-shield-alt"></i></div>
                    <h6>Bergaransi Resmi</h6>
                    <p>Garansi mutu untuk setiap hasil pekerjaan</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 reveal reveal-delay-3">
                <div class="unggulan-card hover-lift">
                    <div class="unggulan-icon" style="background:rgba(239,68,68,0.08);color:#ef4444;"><i class="fas fa-bolt"></i></div>
                    <h6>Pengerjaan Cepat</h6>
                    <p>Tepat waktu sesuai jadwal yang disepakati</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 reveal reveal-delay-1">
                <div class="unggulan-card hover-lift">
                    <div class="unggulan-icon" style="background:rgba(236,72,153,0.08);color:#ec4899;"><i class="fas fa-heart"></i></div>
                    <h6>Pelayanan Prima</h6>
                    <p>Customer service responsif & profesional</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 reveal reveal-delay-2">
                <div class="unggulan-card hover-lift" style="background:linear-gradient(135deg,rgba(79,70,229,0.05),rgba(245,158,11,0.05));">
                    <div class="unggulan-icon" style="background:rgba(139,92,246,0.08);color:#8b5cf6;"><i class="fas fa-tools"></i></div>
                    <h6>Fasilitas Modern</h6>
                    <p>Peralatan CNC & teknologi terkini</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 7: LOKASI ============ -->
<section id="lokasi">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="section-badge">Lokasi</div>
            <h2 class="section-title">Temukan Kami</h2>
            <p class="section-sub mx-auto">Jaya Teknik Engineering, Kediri, Jawa Timur</p>
        </div>

        <div class="row g-4 align-items-stretch reveal">
            <div class="col-lg-4">
                <div class="contact-info-card">
                    <h5 style="font-family:var(--font-display);font-weight:700;margin-bottom:20px;display:flex;align-items:center;gap:10px;"><span style="width:36px;height:36px;background:rgba(79,70,229,0.08);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#4f46e5;"><i class="fas fa-map-marker-alt"></i></span> Info Kontak</h5>

                    <div class="contact-row">
                        <div class="ci-icon" style="background:rgba(79,70,229,0.08);color:#4f46e5;"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <strong>Alamat</strong>
                            <p>Jl. Bulusan, Desa Bulu, Kec. Semen<br>Kabupaten Kediri, Jawa Timur</p>
                        </div>
                    </div>
                    <div class="contact-row">
                        <div class="ci-icon" style="background:rgba(16,185,129,0.08);color:#10b981;"><i class="fas fa-phone"></i></div>
                        <div>
                            <strong>Telepon / WhatsApp</strong>
                            <p>0856-4671-2902</p>
                        </div>
                    </div>
                    <div class="contact-row">
                        <div class="ci-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-envelope"></i></div>
                        <div>
                            <strong>Email</strong>
                            <p>jayateknikenginering@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-row">
                        <div class="ci-icon" style="background:rgba(139,92,246,0.08);color:#8b5cf6;"><i class="fas fa-clock"></i></div>
                        <div>
                            <strong>Jam Operasional</strong>
                            <p>Senin – Jumat: 08.00 – 17.00<br>Sabtu: 08.00 – 14.00</p>
                        </div>
                    </div>

                    <a href="https://maps.google.com" target="_blank" class="btn-primary-jte w-100 justify-content-center mt-4">
                        <i class="fas fa-map"></i> Buka di Google Maps
                    </a>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="map-embed">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126763.04799780737!2d111.91870!3d-7.81473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79592f19f3b08b%3A0x9b453d1bb60bb85c!2sKediri%2C%20Kota%20Kediri%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1234567890"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ FOOTER ============ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    // ============ NAVBAR SCROLL ============
    const mainNav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) mainNav.classList.add('scrolled');
        else mainNav.classList.remove('scrolled');
    });

    // ============ NAVBAR TOGGLE ============
    document.getElementById('navToggler').addEventListener('click', () => {
        document.getElementById('navMenu').classList.toggle('open');
    });

    // ============ HERO CAROUSEL ============
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    let current = 0, timer;

    function goTo(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function startAuto() { timer = setInterval(() => goTo(current + 1), 5000); }
    function resetAuto() { clearInterval(timer); startAuto(); }

    document.getElementById('heroPrev').addEventListener('click', () => { goTo(current - 1); resetAuto(); });
    document.getElementById('heroNext').addEventListener('click', () => { goTo(current + 1); resetAuto(); });
    dots.forEach((d, i) => d.addEventListener('click', () => { goTo(i); resetAuto(); }));
    startAuto();

    // ============ SCROLL REVEAL ============
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
    }, { threshold: 0.12 });
    reveals.forEach(r => observer.observe(r));

    // ============ ACTIVE NAV LINK ============
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-menu a');
    window.addEventListener('scroll', () => {
        let pos = window.scrollY + 140;
        sections.forEach(s => {
            if (pos >= s.offsetTop && pos < s.offsetTop + s.offsetHeight) {
                navLinks.forEach(l => l.classList.remove('active'));
                const link = document.querySelector(`.nav-menu a[href="#${s.id}"]`);
                if (link) link.classList.add('active');
            }
        });
    });

    // ============ COUNTER ANIMATION ============
    function animateCounter(el, target) {
        let start = 0;
        const step = target / 60;
        const interval = setInterval(() => {
            start += step;
            if (start >= target) { el.textContent = target + '+'; clearInterval(interval); }
            else el.textContent = Math.floor(start) + '+';
        }, 25);
    }

    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const nums = e.target.querySelectorAll('.stat-number');
                nums.forEach(n => {
                    const val = parseInt(n.textContent);
                    if (!isNaN(val)) animateCounter(n, val);
                });
                statObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });

    const statSection = document.getElementById('statistik');
    if (statSection) statObserver.observe(statSection);
</script>

@include('layout.footer')
</body>
</html>
