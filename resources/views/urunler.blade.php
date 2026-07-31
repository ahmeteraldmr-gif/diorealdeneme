<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">

<head>
    <link rel="icon" type="image/png" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600;700&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">

    @php
        $locale = get_active_locale();
        $seo_title = $seo['title_' . $locale] ?? 'MOJEA Style Luxury Collection — Dioreal';
        $seo_desc = $seo['desc_' . $locale] ?? 'Dioreal özel koleksiyon ürünlerini, VIP seyahat paketlerini ve lüks konaklama ayrıcalıklarını keşfedin.';
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" />

    <style>
        /* ── MOJEA HOME DECOR LUXURY STYLE SYSTEM ── */
        
        /* 1. Top Announcement Marquee Ticker Bar */
        .mojea-ticker-bar {
            background: #11100f;
            color: #ffffff;
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.65rem 0;
            overflow: hidden;
            position: relative;
            z-index: 1001;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .mojea-ticker-track {
            display: flex;
            gap: 4rem;
            width: max-content;
            animation: mojeaTicker 35s linear infinite;
        }

        .mojea-ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 1.5rem;
            white-space: nowrap;
        }

        .mojea-ticker-item span.highlight {
            color: var(--accent, #c8a96e);
            font-weight: 600;
        }

        @keyframes mojeaTicker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* 2. Shop Hero Header */
        .mojea-shop-hero {
            padding: 12rem 2rem 3.5rem;
            text-align: center;
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
        }

        .mojea-hero-brand {
            font-size: 0.78rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--accent, #c8a96e);
            margin-bottom: 0.8rem;
            display: inline-block;
            font-weight: 600;
        }

        .mojea-hero-title {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: clamp(2.8rem, 5vw, 4.8rem);
            font-weight: 300;
            color: #111111;
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .mojea-hero-title em {
            font-style: italic;
            color: var(--accent, #c8a96e);
        }

        .mojea-hero-desc {
            max-width: 650px;
            margin: 0 auto;
            color: #666666;
            font-size: 1.02rem;
            line-height: 1.7;
            font-weight: 300;
        }

        /* 3. Mojea Toolbar (Filters + Sort + Count) */
        .mojea-toolbar-wrap {
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
            position: sticky;
            top: 76px;
            z-index: 99;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }


        .mojea-toolbar {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Category Filter Pills */
        .mojea-pills {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .mojea-pill-btn {
            background: #f7f7f7;
            border: 1px solid #e5e5e5;
            color: #333333;
            padding: 0.6rem 1.4rem;
            border-radius: 30px;
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .mojea-pill-btn:hover {
            background: #ffffff;
            border-color: #111111;
            color: #111111;
        }

        .mojea-pill-btn.active {
            background: #111111;
            color: #ffffff;
            border-color: #111111;
        }

        .mojea-pill-count {
            font-size: 0.72rem;
            opacity: 0.7;
        }

        /* Right Control Toolbar */
        .mojea-toolbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .mojea-product-count {
            font-size: 0.85rem;
            color: #777777;
            font-weight: 400;
        }

        .mojea-sort-select {
            background: #f7f7f7;
            border: 1px solid #e5e5e5;
            color: #222222;
            padding: 0.55rem 1.2rem;
            border-radius: 20px;
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.82rem;
            font-weight: 500;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mojea-sort-select:focus {
            border-color: var(--accent, #c8a96e);
        }

        /* 4. Products Catalogue Grid - Mojea Editorial Asymmetric Layout */
        .mojea-products-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3.5rem 2rem 7rem;
        }

        .mojea-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.2rem;
        }

        .mojea-card.is-featured {
            grid-column: span 2;
        }

        .mojea-card.is-featured .mojea-card-img-box {
            aspect-ratio: 16 / 9;
        }

        .mojea-card.is-featured .mojea-card-heading {
            font-size: 2.1rem;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .mojea-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .mojea-card.is-featured {
                grid-column: span 2;
            }
        }

        /* ── MOJEA MOBILE 2-COLUMN LAYOUT (MATCHING MOJEAHOME SCREENSHOT) ── */
        @media (max-width: 768px) {
            .mojea-shop-hero {
                padding: 7.5rem 1.2rem 2rem;
            }
            .mojea-hero-brand {
                font-size: 0.7rem;
                letter-spacing: 0.25em;
            }
            .mojea-hero-title {
                font-size: 2.2rem;
            }
            .mojea-hero-desc {
                font-size: 0.9rem;
            }
            .mojea-toolbar {
                padding: 0.75rem 1rem;
            }
            .mojea-pills {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 0.4rem;
                scrollbar-width: none;
                -webkit-overflow-scrolling: touch;
            }
            .mojea-pill-btn {
                white-space: nowrap;
                flex-shrink: 0;
                padding: 0.45rem 1rem;
                font-size: 0.78rem;
            }
            .mojea-products-container {
                padding: 1.5rem 1rem 4rem;
            }
            .mojea-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1.2rem 0.8rem !important;
            }
            .mojea-card {
                border-radius: 6px;
            }
            .mojea-card.is-featured {
                grid-column: span 2 !important;
            }
            .mojea-card.is-featured .mojea-card-img-box {
                aspect-ratio: 16 / 10;
            }
            .mojea-card-info {
                padding: 0.8rem 0.6rem;
            }
            .mojea-card-cat {
                font-size: 0.65rem;
                margin-bottom: 0.25rem;
            }
            .mojea-card-heading {
                font-family: var(--font-body, 'Jost', sans-serif);
                font-size: 0.88rem;
                font-weight: 400;
                color: #222222;
                margin-bottom: 0.35rem;
                line-height: 1.35;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .mojea-card-text {
                display: none;
            }
            .mojea-card-price-tag {
                font-family: var(--font-body, 'Jost', sans-serif);
                font-size: 0.95rem;
                font-weight: 700;
                color: #111111;
            }
            .mojea-add-circle {
                display: none;
            }
            .mojea-slide-overlay {
                display: none;
            }
            .mojea-outline-cart-btn {
                display: block !important;
            }
            .mojea-wish-btn {
                opacity: 1;
                transform: scale(0.85);
                top: 0.5rem;
                right: 0.5rem;
                width: 32px;
                height: 32px;
            }
            .mojea-badge {
                top: 0.5rem;
                left: 0.5rem;
                padding: 0.25rem 0.5rem;
                font-size: 0.62rem;
            }
        }

        .mojea-outline-cart-btn {
            display: none;
            width: 100%;
            background: #ffffff;
            border: 1px solid #111111;
            color: #111111;
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.55rem 0.5rem;
            margin-top: 0.6rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .mojea-outline-cart-btn:hover,
        .mojea-outline-cart-btn:active {
            background: #111111;
            color: #ffffff;
        }



        /* 5. Mojea Product Card */
        .mojea-card {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .mojea-card:hover {
            transform: translateY(-8px);
            border-color: #dddddd;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        /* Square / Portrait Image Container */
        .mojea-card-img-box {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #fdfdfd;
        }

        .mojea-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s cubic-bezier(0.25, 1, 0.5, 1), transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            z-index: 1;
        }

        .mojea-card-img-hover {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s cubic-bezier(0.25, 1, 0.5, 1), transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
            z-index: 1;
        }

        .mojea-card:hover .mojea-card-img {
            opacity: 0;
            transform: scale(1.08);
        }

        .mojea-card:hover .mojea-card-img-hover {
            opacity: 1;
            transform: scale(1.08);
        }


        /* Top Left Discount / Feature Badge */
        .mojea-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #111111;
            color: #ffffff;
            padding: 0.35rem 0.8rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            z-index: 2;
        }

        .mojea-badge.accent {
            background: var(--accent, #c8a96e);
        }

        /* Top Right Wishlist Action */
        .mojea-wish-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid #e0e0e0;
            color: #333333;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 2;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .mojea-card:hover .mojea-wish-btn {
            opacity: 1;
            transform: scale(1);
        }

        .mojea-wish-btn:hover {
            background: #111111;
            color: #ffffff;
            border-color: #111111;
        }

        /* Bottom Slide-Up Hover Overlay Button Bar */
        .mojea-slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 100%);
            display: flex;
            gap: 0.5rem;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            z-index: 3;
        }

        .mojea-card:hover .mojea-slide-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        .mojea-action-btn {
            flex: 1;
            padding: 0.75rem 1rem;
            border-radius: 30px;
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.3s ease;
        }

        .mojea-btn-black {
            background: #111111;
            color: #ffffff;
        }

        .mojea-btn-black:hover {
            background: var(--accent, #c8a96e);
            color: #ffffff;
        }

        .mojea-btn-white {
            background: #ffffff;
            color: #111111;
        }

        .mojea-btn-white:hover {
            background: #111111;
            color: #ffffff;
        }

        /* Card Content Body */
        .mojea-card-info {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .mojea-card-cat {
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--accent, #c8a96e);
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .mojea-card-heading {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 1.5rem;
            font-weight: 400;
            color: #111111;
            margin-bottom: 0.5rem;
            line-height: 1.25;
        }

        .mojea-card-text {
            font-size: 0.88rem;
            color: #666666;
            line-height: 1.55;
            margin-bottom: 1.2rem;
            flex: 1;
            font-weight: 300;
        }

        .mojea-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
        }

        .mojea-card-price-tag {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 1.75rem;
            font-weight: 600;
            color: #111111;
        }

        .mojea-add-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f7f7f7;
            border: 1px solid #e0e0e0;
            color: #111111;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mojea-add-circle:hover {
            background: #111111;
            color: #ffffff;
            border-color: #111111;
            transform: scale(1.08);
        }

        /* 6. Mojea Trust Badges Bar (Footer Top) */
        .mojea-trust-section {
            background: #ffffff;
            border-top: 1px solid #eeeeee;
            padding: 4rem 2rem;
        }

        .mojea-trust-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            text-align: center;
        }

        .mojea-trust-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .mojea-trust-icon {
            font-size: 2.2rem;
            color: var(--accent, #c8a96e);
        }

        .mojea-trust-title {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 1.35rem;
            font-weight: 500;
            color: #111111;
        }

        .mojea-trust-desc {
            font-size: 0.85rem;
            color: #777777;
            max-width: 260px;
            line-height: 1.5;
        }

        /* Mojea Quick View Modal */
        .mojea-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .mojea-modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .mojea-modal-box {
            background: #ffffff;
            border-radius: 20px;
            max-width: 900px;
            width: 100%;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 30px 70px rgba(0,0,0,0.25);
            position: relative;
            transform: scale(0.92);
            transition: all 0.4s ease;
        }

        .mojea-modal-backdrop.active .mojea-modal-box {
            transform: scale(1);
        }

        .mojea-modal-close-btn {
            position: absolute;
            top: 1.2rem;
            right: 1.2rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #ddd;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .mojea-modal-close-btn:hover {
            background: #111;
            color: #fff;
        }

        .mojea-modal-img-container {
            height: 100%;
            min-height: 400px;
            background: #f9f9f9;
        }

        .mojea-modal-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mojea-modal-info {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mojea-modal-badge {
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent, #c8a96e);
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        .mojea-modal-h2 {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 2.2rem;
            color: #111;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .mojea-modal-price-tag {
            font-family: var(--font-display, 'Cormorant Garamond', serif);
            font-size: 2.4rem;
            font-weight: 600;
            color: #111;
            margin-bottom: 1.5rem;
        }

        .mojea-modal-text {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .mojea-modal-add-btn {
            background: #111;
            color: #fff;
            border: none;
            padding: 1.1rem 2rem;
            border-radius: 40px;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.35s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .mojea-modal-add-btn:hover {
            background: var(--accent, #c8a96e);
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(200, 169, 110, 0.3);
        }

        @media (max-width: 768px) {
            .mojea-modal-box {
                grid-template-columns: 1fr;
                max-height: 90vh;
                overflow-y: auto;
            }
            .mojea-modal-img-container {
                min-height: 240px;
            }
            .mojea-modal-info {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body style="background-color: #ffffff; color: #111111;">

    @php
        $t1_text = \App\Models\Setting::get('ticker_text1_' . $locale, '✦ DIOREAL LUXURY SELECTIONS');
        $t1_high = \App\Models\Setting::get('ticker_high1_' . $locale, '%100 ÖZEL CONCIERGE GARANTİSİ');
        $t2_text = \App\Models\Setting::get('ticker_text2_' . $locale, '✦ 100.000 ₺ ÜZERİ REZERVASYONLARDA');
        $t2_high = \App\Models\Setting::get('ticker_high2_' . $locale, 'VIP HELİKOPTER & YAT TRANSFERİ HEDİYE');
        $t3_text = \App\Models\Setting::get('ticker_text3_' . $locale, '✦ SEÇKİN VİLLA & YAT PAKETLERİNDE');
        $t3_high = \App\Models\Setting::get('ticker_high3_' . $locale, 'ERKEN REZERVASYON AYRICALIKLARI');
    @endphp

    <!-- Top Announcement Marquee Ticker Bar (Mojea Style) -->
    <div class="mojea-ticker-bar">
        <div class="mojea-ticker-track">
            <div class="mojea-ticker-item">
                <span>{{ $t1_text }}</span>
                <span class="highlight">{{ $t1_high }}</span>
            </div>
            <div class="mojea-ticker-item">
                <span>{{ $t2_text }}</span>
                <span class="highlight">{{ $t2_high }}</span>
            </div>
            <div class="mojea-ticker-item">
                <span>{{ $t3_text }}</span>
                <span class="highlight">{{ $t3_high }}</span>
            </div>
            <div class="mojea-ticker-item">
                <span>{{ $t1_text }}</span>
                <span class="highlight">{{ $t1_high }}</span>
            </div>
            <div class="mojea-ticker-item">
                <span>{{ $t2_text }}</span>
                <span class="highlight">{{ $t2_high }}</span>
            </div>
        </div>
    </div>


    <!-- Navigation Header -->
    <nav id="mainNav" class="light-nav" style="top: 36px;">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('urunler') }}" class="active-page">Ürünler</a></li>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
        </ul>
        <div class="nav-right" style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="{{ route('sepet') }}" class="cart-nav-link" title="Sepetiniz">
                <div class="cart-icon-wrapper">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #c8a96e;">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="cart-badge">0</span>
                </div>
            </a>

            <div class="lang-switch desk-lang">
                <span id="lang-tr" class="lang-btn {{ $locale === 'tr' ? 'active' : '' }}">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn {{ $locale === 'en' ? 'active' : '' }}">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Fullscreen Mobile Menu -->
    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('urunler') }}" style="color: #c8a96e;">Ürünler & Paketler</a></li>
            <li><a href="{{ route('sepet') }}">Sepetiniz (<span class="cart-badge" style="position:static; display:inline-flex;">0</span>)</a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
        </ul>
    </div>

    <!-- Spacing under navbar -->
    <div style="height: 120px;"></div>


    <!-- 🏷️ MOJEA CATEGORY SHOWCASE BANNER GRID -->
    <section style="max-width: 1350px; margin: 0 auto 3.5rem; padding: 0 2rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            
            <div onclick="filterMojeaProducts('cat-1', document.querySelector('.mojea-pill-btn'))" style="position: relative; border-radius: 12px; overflow: hidden; height: 170px; cursor: pointer; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                <img src="{{ asset('foto.img/hero_4k.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1.0)'">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%); padding: 1.2rem; display: flex; flex-direction: column; justify-content: flex-end; color: #fff;">
                    <span style="font-size: 0.68rem; letter-spacing: 0.15em; color: #c8a96e; font-weight: 700; text-transform: uppercase;">MUTFAK & YEMEK</span>
                    <h3 style="font-size: 1.2rem; font-weight: 400; font-family: var(--font-display, serif); margin-top: 0.2rem;">Porselen & Çatal Bıçak</h3>
                    <span style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.2rem;">Yemek Takımları • Kristal Kadehler</span>
                </div>
            </div>

            <div onclick="filterMojeaProducts('cat-2', document.querySelector('.mojea-pill-btn'))" style="position: relative; border-radius: 12px; overflow: hidden; height: 170px; cursor: pointer; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                <img src="{{ asset('foto.img/otel_hero.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1.0)'">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%); padding: 1.2rem; display: flex; flex-direction: column; justify-content: flex-end; color: #fff;">
                    <span style="font-size: 0.68rem; letter-spacing: 0.15em; color: #c8a96e; font-weight: 700; text-transform: uppercase;">EV DEKORASYON</span>
                    <h3 style="font-size: 1.2rem; font-weight: 400; font-family: var(--font-display, serif); margin-top: 0.2rem;">İpek Kırlent & Vazo</h3>
                    <span style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.2rem;">Murano Cam Vazo • Özel Üretim</span>
                </div>
            </div>

            <div onclick="filterMojeaProducts('cat-3', document.querySelector('.mojea-pill-btn'))" style="position: relative; border-radius: 12px; overflow: hidden; height: 170px; cursor: pointer; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                <img src="{{ asset('foto.img/bodrum.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1.0)'" onerror="this.src='{{ asset('foto.img/hero_4k.jpg') }}'">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%); padding: 1.2rem; display: flex; flex-direction: column; justify-content: flex-end; color: #fff;">
                    <span style="font-size: 0.68rem; letter-spacing: 0.15em; color: #c8a96e; font-weight: 700; text-transform: uppercase;">LÜKS PAKETLER</span>
                    <h3 style="font-size: 1.2rem; font-weight: 400; font-family: var(--font-display, serif); margin-top: 0.2rem;">VIP Villa & Balon Turu</h3>
                    <span style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.2rem;">Bodrum Sunset Villa • Kapadokya</span>
                </div>
            </div>

            <div onclick="filterMojeaProducts('cat-4', document.querySelector('.mojea-pill-btn'))" style="position: relative; border-radius: 12px; overflow: hidden; height: 170px; cursor: pointer; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                <img src="{{ asset('foto.img/fethiye.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1.0)'" onerror="this.src='{{ asset('foto.img/hero_4k.jpg') }}'">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%); padding: 1.2rem; display: flex; flex-direction: column; justify-content: flex-end; color: #fff;">
                    <span style="font-size: 0.68rem; letter-spacing: 0.15em; color: #c8a96e; font-weight: 700; text-transform: uppercase;">MAVİ YOLCULUK</span>
                    <h3 style="font-size: 1.2rem; font-weight: 400; font-family: var(--font-display, serif); margin-top: 0.2rem;">Lüks Yat & Charter</h3>
                    <span style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.2rem;">Özel Mavi Tur • Kaptanlı</span>
                </div>
            </div>

        </div>
    </section>



    <!-- Sticky Mojea Toolbar (Left Hamburger Dropdown + Search + Sort + Count) -->
    <div class="mojea-toolbar-wrap">
        <div class="mojea-toolbar" style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            
            <!-- Left Hamburger Dropdown Container -->
            <div style="position: relative; z-index: 100;">
                <button type="button" id="leftHambBtn" onclick="toggleLeftDropdown(event)" style="background: #111111; color: #ffffff; border: none; padding: 0.65rem 1.3rem; border-radius: 30px; font-size: 0.82rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.65rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <i class="fa-solid fa-bars" style="color: #c8a96e; font-size: 0.95rem;"></i>
                    <span id="selectedCatLabel">KATEGORİLER</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.3s ease; margin-left: 0.2rem;" id="hambChevron"></i>
                </button>

                <!-- Clean Left Dropdown Menu (No Full Screen Backdrop) -->
                <div id="leftCatDropdown" onclick="event.stopPropagation()" style="position: absolute; top: calc(100% + 8px); left: 0; background: #ffffff; border: 1px solid #e0e0e0; border-radius: 16px; box-shadow: 0 15px 35px rgba(0,0,0,0.12); width: 280px; padding: 0.6rem; display: none; flex-direction: column; gap: 0.3rem;">
                    <button class="left-dropdown-item active" onclick="selectCategory('all', 'Tüm Ürünler & Paketler', this)" style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-radius: 10px; border: none; background: #111; color: #fff; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-align: left;">
                        <span>Tüm Ürünler & Paketler</span>
                        <span style="font-size: 0.75rem; opacity: 0.8;">({{ count($products) }})</span>
                    </button>

                    @if(isset($categories) && count($categories) > 0)
                        @foreach($categories as $cat)
                            @php
                                $catName = $cat->name[$locale] ?? ($cat->name['tr'] ?? $cat->slug);
                                $catCount = $cat->products_count ?? count($cat->products);
                            @endphp
                            <button class="left-dropdown-item" onclick="selectCategory('cat-{{ $cat->id }}', '{{ addslashes($catName) }}', this)" style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-radius: 10px; border: none; background: transparent; color: #333; font-size: 0.85rem; font-weight: 500; cursor: pointer; text-align: left; transition: background 0.2s ease;">
                                <span>{{ $catName }}</span>
                                <span style="font-size: 0.75rem; color: #888;">({{ $catCount }})</span>
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Toolbar Right Controls (Search + Sort + Count) -->
            <div class="mojea-toolbar-right" style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; flex: 1; justify-content: flex-end;">
                <div class="ecom-search-box" style="position: relative; min-width: 220px; flex: 1; max-width: 320px;">
                    <input type="text" id="ecomSearchInput" oninput="searchMojeaProducts(this.value)" placeholder="🔍 Ürün veya paket ara..." style="width: 100%; padding: 0.6rem 1rem 0.6rem 2.3rem; border-radius: 20px; border: 1px solid #e5e5e5; background: #f7f7f7; font-size: 0.82rem; outline: none;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #999; font-size: 0.8rem;"></i>
                </div>

                <span class="mojea-product-count" id="visibleProductCount">{{ count($products) }} Ürün Listeleniyor</span>
                
                <select class="mojea-sort-select" onchange="sortMojeaProducts(this.value)">
                    <option value="default">Sıralama: Önerilen</option>
                    <option value="price-asc">Fiyat: Düşükten Yükseğe</option>
                    <option value="price-desc">Fiyat: Yüksekten Düşüğe</option>
                    <option value="name-asc">A-Z Alfabetik</option>
                </select>
            </div>
        </div>
    </div>




    <!-- Mojea Products Catalogue Grid -->
    <section class="mojea-products-container">
        <div class="mojea-grid" id="mojeaGrid">

            @if(isset($products) && count($products) > 0)
                @foreach($products as $index => $p)
                    @php
                        $pName = $p->name[$locale] ?? ($p->name['tr'] ?? '');
                        $pTag = $p->tag[$locale] ?? ($p->tag['tr'] ?? ($p->category->name[$locale] ?? ($p->category->name['tr'] ?? 'Lüks Paket')));
                        $pDesc = $p->desc[$locale] ?? ($p->desc['tr'] ?? '');
                        $pDetails = $p->details[$locale] ?? ($p->details['tr'] ?? '');
                        $pImg = asset($p->image ?: 'foto.img/hero_4k.jpg');
                        $hoverImgs = ['foto.img/hero_slide_2.jpg', 'foto.img/hero_slide_3.jpg', 'foto.img/otel_hero.jpg', 'foto.img/bodrum.jpg', 'foto.img/fethiye.jpg', 'foto.img/dest_istanbul.jpg'];
                        $pHoverImg = asset(!empty($p->image_hover) ? $p->image_hover : $hoverImgs[$index % count($hoverImgs)]);
                        $isFeatured = ($index === 1 || $index === 5 || $index === 8);
                    @endphp

                    <div class="mojea-card {{ $isFeatured ? 'is-featured' : '' }} reveal" style="transition-delay: {{ 0.08 * (($index % 4) + 1) }}s" data-category="cat-{{ $p->category_id }}" data-price="{{ $p->price }}" data-name="{{ $pName }}">

                        
                        <div class="mojea-card-img-box">
                            <!-- Primary Normal Image -->
                            <img src="{{ $pImg }}" alt="{{ $pName }}" class="mojea-card-img" onerror="this.src='{{ asset('foto.img/hero_4k.jpg') }}'">
                            <!-- Secondary Hover Image (Mouse Over Reveal) -->
                            <img src="{{ $pHoverImg }}" alt="{{ $pName }} - Detay Görseli" class="mojea-card-img-hover" onerror="this.src='{{ asset('foto.img/hero_slide_2.jpg') }}'">
                            
                            <!-- Category Badge -->

                            <span class="mojea-badge {{ $index % 2 === 0 ? 'accent' : '' }}">{{ $pTag }}</span>

                            <!-- Top-Right Wishlist Button -->
                            <button type="button" class="mojea-wish-btn" title="Favorilere Ekle" onclick="alert('Favorilerinize eklendi!');">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <!-- Slide-Up Hover Overlay Button Bar -->
                            <div class="mojea-slide-overlay">
                                <button type="button" class="mojea-action-btn mojea-btn-white" onclick="openQuickView({
                                    id: 'product-{{ $p->id }}',
                                    name: '{{ addslashes($pName) }}',
                                    tag: '{{ addslashes($pTag) }}',
                                    price: {{ $p->price }},
                                    image: '{{ $pImg }}',
                                    desc: '{{ addslashes($pDesc) }}',
                                    details: '{{ addslashes($pDetails) }}'
                                })">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Hızlı İncele</span>
                                </button>

                                <button type="button" class="mojea-action-btn mojea-btn-black" onclick="addToCart({
                                    id: 'product-{{ $p->id }}',
                                    type: '{{ addslashes($pTag) }}',
                                    name: '{{ addslashes($pName) }}',
                                    price: {{ $p->price }},
                                    image: '{{ $pImg }}',
                                    details: '{{ addslashes($pDetails) }}'
                                })">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    <span>Hızlı Ekle</span>
                                </button>
                            </div>
                        </div>

                        <!-- Card Info -->
                        <div class="mojea-card-info">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
                                <span class="mojea-card-cat">{{ $pTag }}</span>
                                <div style="color: #ffb400; font-size: 0.75rem; display: flex; align-items: center; gap: 0.2rem;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <span style="color: #777; font-size: 0.7rem; font-family: var(--font-body), sans-serif; margin-left: 0.2rem;">({{ 12 + ($index * 7) % 35 }})</span>
                                </div>
                            </div>

                            <h3 class="mojea-card-heading">{{ $pName }}</h3>
                            <p class="mojea-card-text">{{ $pDesc }}</p>
                            
                            <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                                <span style="font-size: 0.68rem; font-weight: 600; background: #e8f5e9; color: #2e7d32; padding: 0.2rem 0.5rem; border-radius: 4px; display: inline-flex; align-items: center; gap: 0.2rem;">
                                    <i class="fa-solid fa-circle-check" style="font-size: 0.65rem;"></i> Stokta Var
                                </span>
                                <span style="font-size: 0.68rem; font-weight: 600; background: #fff8e1; color: #f57f17; padding: 0.2rem 0.5rem; border-radius: 4px; display: inline-flex; align-items: center; gap: 0.2rem;">
                                    <i class="fa-solid fa-truck-fast" style="font-size: 0.65rem;"></i> Hızlı Kargo
                                </span>
                            </div>

                            <div class="mojea-card-bottom">
                                <div style="display: flex; flex-direction: column;">
                                    @php
                                        $oldPrice = round($p->price * 1.15);
                                    @endphp
                                    <span style="text-decoration: line-through; color: #999; font-size: 0.85rem; font-family: var(--font-body), sans-serif;">₺{{ number_format($oldPrice, 0, ',', '.') }}</span>
                                    <span class="mojea-card-price-tag">₺{{ number_format($p->price, 0, ',', '.') }}</span>
                                </div>
                                
                                <button type="button" class="mojea-add-circle" title="Sepete Ekle" onclick="addToCart({
                                    id: 'product-{{ $p->id }}',
                                    type: '{{ addslashes($pTag) }}',
                                    name: '{{ addslashes($pName) }}',
                                    price: {{ $p->price }},
                                    image: '{{ $pImg }}',
                                    details: '{{ addslashes($pDetails) }}'
                                })">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>


                            <!-- Mobile Mojea Outline SEPETE EKLE Button -->
                            <button type="button" class="mojea-outline-cart-btn" onclick="addToCart({
                                id: 'product-{{ $p->id }}',
                                type: '{{ addslashes($pTag) }}',
                                name: '{{ addslashes($pName) }}',
                                price: {{ $p->price }},
                                image: '{{ $pImg }}',
                                details: '{{ addslashes($pDetails) }}'
                            })">
                                <span data-i18n="prod_modal_add">SEPETE EKLE</span>
                            </button>
                        </div>
                    </div>


                @endforeach
            @endif

        </div>
    </section>





    <!-- Mojea Quick View Modal -->
    <div class="mojea-modal-backdrop" id="mojeaModal">

        <div class="mojea-modal-box">
            <button type="button" class="mojea-modal-close-btn" onclick="closeQuickView()">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="mojea-modal-img-container">
                <img src="" id="modalImg" alt="" class="mojea-modal-img">
            </div>
            <div class="mojea-modal-info">
                <span class="mojea-modal-badge" id="modalTag">KATEGORİ</span>
                <h2 class="mojea-modal-h2" id="modalTitle">Ürün Başlığı</h2>
                <div class="mojea-modal-price-tag" id="modalPrice">₺0</div>
                <p class="mojea-modal-text" id="modalDesc">Açıklama alanı...</p>

                <button type="button" class="mojea-modal-add-btn" id="modalAddBtn">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>SEPETE EKLE</span>
                </button>
            </div>
        </div>
    </div>





    <!-- Footer -->
    @include('partials.footer')


    <!-- Core Scripts -->
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>



    <script>
        let currentModalItem = null;

        function toggleLeftDropdown(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('leftCatDropdown');
            const chevron = document.getElementById('hambChevron');
            if (!dropdown) return;
            const isOpen = dropdown.style.display === 'flex';
            
            dropdown.style.display = isOpen ? 'none' : 'flex';
            if (chevron) chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        document.addEventListener('click', function() {
            const dropdown = document.getElementById('leftCatDropdown');
            const chevron = document.getElementById('hambChevron');
            if (dropdown) dropdown.style.display = 'none';
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        });

        function selectCategory(category, label, btn) {
            document.querySelectorAll('.left-dropdown-item').forEach(b => {
                b.style.background = 'transparent';
                b.style.color = '#333';
                b.style.fontWeight = '500';
            });
            btn.style.background = '#111111';
            btn.style.color = '#ffffff';
            btn.style.fontWeight = '600';

            const labelEl = document.getElementById('selectedCatLabel');
            if (labelEl) labelEl.textContent = label;

            const dropdown = document.getElementById('leftCatDropdown');
            if (dropdown) dropdown.style.display = 'none';

            const cards = document.querySelectorAll('.mojea-card');
            let visibleCount = 0;
            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('visibleProductCount').textContent = visibleCount + ' Ürün Listeleniyor';
        }

        function searchMojeaProducts(query) {


            query = query.toLowerCase().trim();
            const cards = document.querySelectorAll('.mojea-card');
            let visibleCount = 0;
            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                if (name.includes(query)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            document.getElementById('visibleProductCount').textContent = visibleCount + ' Ürün Bulundu';
        }

        function filterMojeaProducts(category, btn) {

            document.querySelectorAll('.mojea-pill-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.mojea-card');
            let visibleCount = 0;
            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('visibleProductCount').textContent = visibleCount + ' Ürün Listeleniyor';
        }

        function sortMojeaProducts(sortType) {
            const grid = document.getElementById('mojeaGrid');
            const cards = Array.from(grid.querySelectorAll('.mojea-card'));

            cards.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price')) || 0;
                const priceB = parseFloat(b.getAttribute('data-price')) || 0;
                const nameA = a.getAttribute('data-name') || '';
                const nameB = b.getAttribute('data-name') || '';

                if (sortType === 'price-asc') return priceA - priceB;
                if (sortType === 'price-desc') return priceB - priceA;
                if (sortType === 'name-asc') return nameA.localeCompare(nameB);
                return 0;
            });

            cards.forEach(card => grid.appendChild(card));
        }

        function addToCart(item) {
            if (window.DiorealCart) {
                window.DiorealCart.addItem(item);
                showToast(item.name + ' sepetinize eklendi!');
            }
        }

        function openQuickView(item) {
            currentModalItem = item;
            document.getElementById('modalImg').src = item.image;
            document.getElementById('modalTag').textContent = item.tag;
            document.getElementById('modalTitle').textContent = item.name;
            document.getElementById('modalPrice').textContent = '₺' + item.price.toLocaleString('tr-TR');
            document.getElementById('modalDesc').textContent = item.desc || item.details;
            
            const btn = document.getElementById('modalAddBtn');
            btn.onclick = function() {
                addToCart(currentModalItem);
                closeQuickView();
            };

            document.getElementById('mojeaModal').classList.add('active');
        }

        function closeQuickView() {
            document.getElementById('mojeaModal').classList.remove('active');
        }

        document.getElementById('mojeaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuickView();
            }
        });
    </script>
</body>
</html>
