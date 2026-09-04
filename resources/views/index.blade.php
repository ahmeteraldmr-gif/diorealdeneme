<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">

<head>
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/png" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ time() }}">

    @php
        $locale = get_active_locale();
        $seoData = get_page_seo('home');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/hero_4k.jpg');
        $canonical = $canonical ?? route('home');
        $hreflang_tr = $hreflang_tr ?? route('home');
        $hreflang_en = $hreflang_en ?? route('home');
        $noindex = $noindex ?? false;
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $canonical }}" />

    @if($noindex)
    <meta name="robots" content="noindex, nofollow">
    @else
    <meta name="robots" content="index, follow">
    @endif

    <meta property="og:title" content="{{ $seo_title }}">
    <meta property="og:description" content="{{ $seo_desc }}">
    <meta property="og:image" content="{{ $og_image }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="{{ $og_type ?? 'website' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo_title }}">
    <meta name="twitter:description" content="{{ $seo_desc }}">
    <meta name="twitter:image" content="{{ $og_image }}">

    @if(isset($schema_json))
    {!! $schema_json !!}
    @endif
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Dioreal Dijital",
      "url": "https://dioreal.com",
      "logo": "https://dioreal.com/foto.img/dioreal_beyaz_logo.png",
      "sameAs": [
        "https://www.instagram.com/dioreal",
        "https://www.linkedin.com/company/dioreal"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://dioreal.com",
      "name": "Dioreal Dijital"
    }
    </script>
    @endverbatim
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">
</head>

<body>

    <!-- Desktop Nav -->
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('hakkimizda') }}"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About Us</span></a></li>
            <li><a href="{{ route('oteller') }}"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="{{ route('urunler') }}"><span class="lang-text-tr">Ürünler</span><span class="lang-text-en">Products</span></a></li>
            <li><a href="{{ route('gezi-rehberi') }}"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="{{ route('etkinlikler') }}"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="{{ route('journal') }}"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
        </ul>
        <div class="nav-right" style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="{{ route('sepet') }}" class="cart-nav-link" title="Sepetiniz">
                <div class="cart-icon-wrapper">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #c5a059;">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="cart-badge">0</span>
                </div>
            </a>
            <div class="lang-switch desk-lang">
                <span id="lang-tr" class="lang-btn active">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>

    </nav>

    <!-- Fullscreen Nav -->
    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="{{ route('hakkimizda') }}"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About Us</span></a></li>
            <li><a href="{{ route('oteller') }}"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="{{ route('urunler') }}"><span class="lang-text-tr">Ürünler</span><span class="lang-text-en">Products</span></a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="{{ route('etkinlikler') }}"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="{{ route('journal') }}"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>


    <!-- DYNAMIC HERO AREA -->
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide active"
                style="background-image:url('{{ dioreal_img($settings['hero_slide_1'] ?? '', 'foto.img/hero_4k.jpg') }}')">
            </div>
            <div class="hero-slide"
                style="background-image:url('{{ dioreal_img($settings['hero_slide_2'] ?? '', 'foto.img/hero_slide_2.jpg') }}')">
            </div>
            <div class="hero-slide"
                style="background-image:url('{{ dioreal_img($settings['hero_slide_3'] ?? '', 'foto.img/hero_slide_3.jpg') }}')">
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title reveal">
                <span class="lang-text-tr">{{ $settings['hero_title_tr'] ?? 'DIOREAL' }}</span>
                <span class="lang-text-en">{{ $settings['hero_title_en'] ?? 'DIOREAL' }}</span>
            </h1>
            <div class="hero-cta-group reveal" style="transition-delay: 0.2s;">
                <a href="https://wa.me/{{ format_whatsapp($settings['whatsapp'] ?? '905449157011') }}" target="_blank" class="btn btn-outline whatsapp-cta" style="background:transparent!important;border:2px solid rgba(255,255,255,0.75)!important;color:#fff!important;box-shadow:0 4px 20px rgba(0,0,0,0.18)!important;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);">
                    <span class="lang-text-tr">İletişime Geç</span>
                    <span class="lang-text-en">Get in Touch</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Marquee - Clickable Cities -->
    <div class="marquee" style="position:relative;z-index:2;">
        <div class="marquee-track" style="pointer-events:auto;">
            @for($set = 0; $set < 4; $set++)
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'istanbul') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">İstanbul</span><span class="lang-text-en" style="color: inherit !important;">Istanbul</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'bodrum') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Bodrum</span><span class="lang-text-en" style="color: inherit !important;">Bodrum</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'fethiye') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Fethiye</span><span class="lang-text-en" style="color: inherit !important;">Fethiye</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'kapadokya') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Kapadokya</span><span class="lang-text-en" style="color: inherit !important;">Cappadocia</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'cesme') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Çeşme</span><span class="lang-text-en" style="color: inherit !important;">Cesme</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'kas') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Kaş</span><span class="lang-text-en" style="color: inherit !important;">Kas</span></a> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><a href="{{ route('destinasyon.detay', 'datca') }}" class="marquee-link" style="color: rgba(255, 255, 255, 0.22) !important; text-decoration: none !important;"><span class="lang-text-tr" style="color: inherit !important;">Datça</span><span class="lang-text-en" style="color: inherit !important;">Datca</span></a> <span class="marquee-dot">◆</span></div>
            @endfor
        </div>
    </div>

    <!-- ABOUT SECTION (BU AYIN SEÇKİSİ) -->
    <section class="bt-about-section" id="hakkimizda" style="padding: 7rem 5rem; text-align: center; background: var(--white);">
        <div style="max-width: 800px; margin: 0 auto 5rem;">
            <h2 style="font-family: var(--font-display); font-size: 3rem; font-weight: 400; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 2rem; color: var(--near-black);">
                <span class="lang-text-tr">{{ $settings['man_eyebrow_tr'] ?? 'BU AYIN SEÇKİSİ' }}</span>
                <span class="lang-text-en">{{ $settings['man_eyebrow_en'] ?? "THIS MONTH'S SELECTION" }}</span>
            </h2>
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark-gray);">
                <span class="lang-text-tr">{{ $settings['man_p1_tr'] ?? 'Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin.' }}</span>
                <span class="lang-text-en">{{ $settings['man_p1_en'] ?? "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you." }}</span>
            </p>
        </div>

        <div class="bt-about-grid" style="display: grid; gap: 2rem; text-align: left;">
            <!-- Trend Otel -->
            <a href="{{ route('oteller') }}" class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s; text-decoration: none; display: block;">
                <img src="{{ dioreal_img($settings['trend_otel_img'] ?? '', 'foto.img/about_safari.webp') }}" alt="Trend Otel" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Otel</span>
                        <span class="lang-text-en">Trending Hotel</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_otel_title_tr'] ?? 'Kassandra Villa' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_otel_title_en'] ?? 'Kassandra Villa' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_otel_desc_tr'] ?? 'Ege\'nin gizli kalmış koylarında uyanmanın eşsiz hissi.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_otel_desc_en'] ?? 'The unique feeling of waking up in the hidden bays of the Aegean.' }}</span>
                    </p>
                </div>
            </a>
            <!-- Trend Restoran -->
            <a href="{{ route('restoranlar') }}" class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s; text-decoration: none; display: block;">
                <img src="{{ dioreal_img($settings['trend_rest_img'] ?? '', 'foto.img/rest_mikla.webp') }}" alt="Trend Restoran" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Restoran</span>
                        <span class="lang-text-en">Trending Restaurant</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_rest_title_tr'] ?? 'Melengeç' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_rest_title_en'] ?? 'Melengeç' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_rest_desc_tr'] ?? 'Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_rest_desc_en'] ?? 'An unforgettable gastronomic journey with fresh seafood.' }}</span>
                    </p>
                </div>
            </a>
            <!-- Trend Yat -->
            <a href="{{ route('yatlar') }}" class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s; text-decoration: none; display: block;">
                <img src="{{ dioreal_img($settings['trend_yat_img'] ?? '', 'foto.img/about_yacht.webp') }}" alt="Trend Yat" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Yat</span>
                        <span class="lang-text-en">Trending Yacht</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_yat_title_tr'] ?? 'Blue Voyage' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_yat_title_en'] ?? 'Blue Voyage' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_yat_desc_tr'] ?? 'Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_yat_desc_en'] ?? 'Routes in infinite blue. Nothing but the sound of the wind.' }}</span>
                    </p>
                </div>
            </a>
            <!-- Trend Beach -->
            <a href="{{ route('gezi-rehberi') }}" class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s; text-decoration: none; display: block;">
                <img src="{{ dioreal_img($settings['trend_beach_img'] ?? '', 'foto.img/bodrum.webp') }}" alt="Trend Beach" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Beach</span>
                        <span class="lang-text-en">Trending Beach</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_beach_title_tr'] ?? 'Rups Beach' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_beach_title_en'] ?? 'Rups Beach' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_beach_desc_tr'] ?? 'Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_beach_desc_en'] ?? 'Golden sands and crystal waters. Moments accompanying the rhythm of the music.' }}</span>
                    </p>
                </div>
            </a>
        </div>
    </section>
    

    
    <!-- Destinations (Türkiye) -->
    <section class="dest-section bt-horizontal-scroll" id="turkiye" style="background: var(--white); padding: 4rem 0 5rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <div class="dest-section-header">
            <div style="text-align: left;">
                <span style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--mid-gray);">
                    <span class="lang-text-tr">SEYAHATLERİMİZİ KEŞFEDİN</span>
                    <span class="lang-text-en">EXPLORE OUR JOURNEYS</span>
                </span>
                <h2 style="font-family: var(--font-display); font-size: 3rem; color: var(--near-black); margin-top: 0.5rem; font-weight: 400;">
                    <span class="lang-text-tr">Türkiye'nin <em style="font-style: italic; font-weight: 300;">Ruhu</em></span>
                    <span class="lang-text-en">The Soul of <em style="font-style: italic; font-weight: 300;">Turkey</em></span>
                </h2>
            </div>
            <p class="dest-section-desc">
                <span class="lang-text-tr">Benzersiz deneyimlerin ilham veren hikayesi</span>
                <span class="lang-text-en">The inspiring story of unique experiences</span>
            </p>
        </div>

        @if(isset($destinations['turkiye']) && count($destinations['turkiye']) > 0)
            <div class="marquee-container">
                <div class="marquee-track">
                    <div class="marquee-content">
                        @foreach($destinations['turkiye'] as $dest)
                            <a href="{{ route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id)) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <img src="{{ dioreal_img($dest->img ?? '', 'foto.img/amalfi.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/amalfi.jpg') }}';" alt="{{ $dest->name['tr'] ?? '' }}" class="dest-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-text-tr">{{ $dest->region['tr'] ?? '' }}</span>
                                        <span class="lang-text-en">{{ $dest->region['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-text-tr">{{ $dest->name['tr'] ?? '' }}</span>
                                        <span class="lang-text-en">{{ $dest->name['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                        <span class="btn-dest-explore">
                                            <span class="lang-text-tr">İncele</span>
                                            <span class="lang-text-en">View</span>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="marquee-content" aria-hidden="true">
                        @foreach($destinations['turkiye'] as $dest)
                            <a href="{{ route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id)) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <img src="{{ dioreal_img($dest->img ?? '', 'foto.img/amalfi.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/amalfi.jpg') }}';" alt="{{ $dest->name['tr'] ?? '' }}" class="dest-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-text-tr">{{ $dest->region['tr'] ?? '' }}</span>
                                        <span class="lang-text-en">{{ $dest->region['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-text-tr">{{ $dest->name['tr'] ?? '' }}</span>
                                        <span class="lang-text-en">{{ $dest->name['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                        <span class="btn-dest-explore">
                                            <span class="lang-text-tr">İncele</span>
                                            <span class="lang-text-en">View</span>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div style="color: var(--mid-gray); padding: 2rem;">
                <span class="lang-text-tr">Henüz destinasyon eklenmedi.</span>
                <span class="lang-text-en">No destinations added yet.</span>
            </div>
        @endif
    </section>

    <!-- Destinations (Yurtdışı) -->
    <section class="dest-section bt-horizontal-scroll" id="yurtdisi" style="background: var(--white); padding: 7rem 0 7rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <h2 class="dest-main-title">
            <span class="lang-text-tr">YOLCULUĞUNUZA BAŞLAYIN</span>
            <span class="lang-text-en">START YOUR JOURNEY</span>
        </h2>
        
        <ul class="bt-tabs-nav">
            <li class="active" data-type="yurtdisi_popular">
                <span class="lang-text-tr">EN POPÜLER</span>
                <span class="lang-text-en">MOST POPULAR</span>
            </li>
            <li data-type="yurtdisi_traveller">
                <span class="lang-text-tr">GEZGİNE GÖRE</span>
                <span class="lang-text-en">BY TRAVELLER</span>
            </li>
            <li data-type="yurtdisi_month">
                <span class="lang-text-tr">AYA GÖRE</span>
                <span class="lang-text-en">BY MONTH</span>
            </li>
            <li data-type="yurtdisi_spotlight">
                <span class="lang-text-tr">VİTRİNDEKİLER</span>
                <span class="lang-text-en">SPOTLIGHT</span>
            </li>
        </ul>

        @php
            $types = [
                'yurtdisi_popular',
                'yurtdisi_traveller',
                'yurtdisi_month',
                'yurtdisi_spotlight'
            ];
        @endphp

        @foreach($types as $type)
            <div id="panel-{{ $type }}" class="yurtdisi-pane" style="{{ $type === 'yurtdisi_popular' ? '' : 'display: none;' }}">
                @if(isset($destinations[$type]) && count($destinations[$type]) > 0)
                    <div class="marquee-container">
                        <div class="marquee-track">
                            <div class="marquee-content">
                                @foreach($destinations[$type] as $dest)
                                    <a href="{{ route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id)) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <img src="{{ dioreal_img($dest->img ?? '', 'foto.img/amalfi.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/amalfi.jpg') }}';" alt="{{ $dest->name['tr'] ?? '' }}" class="dest-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-text-tr">{{ $dest->region['tr'] ?? '' }}</span>
                                                <span class="lang-text-en">{{ $dest->region['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-text-tr">{{ $dest->name['tr'] ?? '' }}</span>
                                                <span class="lang-text-en">{{ $dest->name['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                                <span class="btn-dest-explore">
                                                    <span class="lang-text-tr">İncele</span>
                                                    <span class="lang-text-en">View</span>
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="marquee-content" aria-hidden="true">
                                @foreach($destinations[$type] as $dest)
                                    <a href="{{ route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id)) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <img src="{{ dioreal_img($dest->img ?? '', 'foto.img/amalfi.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/amalfi.jpg') }}';" alt="{{ $dest->name['tr'] ?? '' }}" class="dest-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-text-tr">{{ $dest->region['tr'] ?? '' }}</span>
                                                <span class="lang-text-en">{{ $dest->region['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-text-tr">{{ $dest->name['tr'] ?? '' }}</span>
                                                <span class="lang-text-en">{{ $dest->name['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                                <span class="btn-dest-explore">
                                                    <span class="lang-text-tr">İncele</span>
                                                    <span class="lang-text-en">View</span>
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div style="color: var(--mid-gray); padding: 2rem;">
                        <span class="lang-text-tr">Henüz destinasyon eklenmedi.</span>
                        <span class="lang-text-en">No destinations added yet.</span>
                    </div>
                @endif
            </div>
        @endforeach
    </section>

    <!-- Collaborations Grid -->
    <style>
        .bt-logos-wrapper {
            margin-top: 4rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 5rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .bt-logo-img {
            max-width: 140px;
            height: auto;
            opacity: 0.8;
            transition: all 0.4s ease;
            cursor: pointer;
        }
        .bt-logo-img:hover {
            opacity: 1;
            transform: scale(1.05);
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .bt-logos-wrapper { gap: 2.5rem; }
            .bt-logo-img { max-width: 100px; }
        }
    </style>
    <section class="collabs" id="referanslar" style="text-align: center; padding: 7rem 5rem; background: var(--white); border-top: 1px solid rgba(0,0,0,0.05);">
        <div class="section-header reveal" style="justify-content: center; margin-bottom: 2rem;">
            <div>
                <h2 class="section-title" style="font-family: var(--font-condensed); font-size: 2.5rem; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1rem; color: var(--near-black); text-align: center;">
                    <span class="lang-text-tr">MARKA & İŞ BİRLİKLERİ</span>
                    <span class="lang-text-en">BRANDS & PARTNERSHIPS</span>
                </h2>
                <p style="color: var(--mid-gray); font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase;">
                    <span class="lang-text-tr">Güvenilir Partnerlerimiz</span>
                    <span class="lang-text-en">Our Trusted Partners</span>
                </p>
            </div>
        </div>
        <div class="bt-logos-wrapper reveal" id="refsGrid" style="transition-delay: 0.2s;">
            @if(isset($settings['brands']) && is_array($settings['brands']))
                @foreach($settings['brands'] as $brand)
                    <img class="bt-logo-img" src="{{ asset($brand['img']) }}" alt="{{ $brand['name'] }}" title="{{ $brand['name'] }}">
                @endforeach
            @endif
        </div>
    </section>

    <!-- Process (Süreç) -->
    <section class="process">
        <div class="section-header reveal">
            <div>
                <span class="section-label">
                    <span class="lang-text-tr">Metodoloji</span>
                    <span class="lang-text-en">Methodology</span>
                </span>
                <h2 class="section-title">
                    <span class="lang-text-tr">Nasıl <em>Çalışıyoruz?</em></span>
                    <span class="lang-text-en">How We <em>Work</em></span>
                </h2>
            </div>
        </div>
        <div class="process-steps">
            <div class="process-step reveal">
                <div class="step-dot"></div>
                <div class="step-n">01</div>
                <h3 class="step-h">
                    <span class="lang-text-tr">Hayal Kurun</span>
                    <span class="lang-text-en">Dream Big</span>
                </h3>
                <p class="step-p">
                    <span class="lang-text-tr">Bize rüya seyahatinizi anlatın. Hayallerinizi özgürce paylaşın.</span>
                    <span class="lang-text-en">Tell us about your dream trip. Share your desires freely.</span>
                </p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.1s;">
                <div class="step-dot"></div>
                <div class="step-n">02</div>
                <h3 class="step-h">
                    <span class="lang-text-tr">Tasarlayalım</span>
                    <span class="lang-text-en">We Design</span>
                </h3>
                <p class="step-p">
                    <span class="lang-text-tr">Uzman ekibimiz size özel, detaylı bir program hazırlar.</span>
                    <span class="lang-text-en">Our expert team creates a bespoke, detailed itinerary for you.</span>
                </p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.2s;">
                <div class="step-dot"></div>
                <div class="step-n">03</div>
                <h3 class="step-h">
                    <span class="lang-text-tr">Mükemmelleştirin</span>
                    <span class="lang-text-en">Perfect It</span>
                </h3>
                <p class="step-p">
                    <span class="lang-text-tr">Her detayı birlikte gözden geçiririz. Tamamı ince ayrıntısına kadar planlanır.</span>
                    <span class="lang-text-en">We review every detail together until it matches your vision.</span>
                </p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.3s;">
                <div class="step-dot"></div>
                <div class="step-n">04</div>
                <h3 class="step-h">
                    <span class="lang-text-tr">Yola Çıkın</span>
                    <span class="lang-text-en">Set Off</span>
                </h3>
                <p class="step-p">
                    <span class="lang-text-tr">Tüm organizasyon hazır. Geri kalanı tamamen bizde.</span>
                    <span class="lang-text-en">Everything is prepared. Simply enjoy your journey.</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="testi">
        <div class="reveal">
            <blockquote class="testi-quote">
                <span class="lang-text-tr">"Dioreal Dijital ile yaptığımız iş birliği, markamızın global vizyonunu tam olarak yansıtan benzersiz bir deneyimdi. Detaylara gösterilen özen büyüleyiciydi."</span>
                <span class="lang-text-en">"Collaborating with Dioreal Digital was a unique experience reflecting our brand's global vision. The attention to detail was fascinating."</span>
            </blockquote>
            <p class="testi-author">
                <span class="lang-text-tr">— Seçkin İş Ortakları</span>
                <span class="lang-text-en">— Exclusive Partners</span>
            </p>
        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/home.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>
</body>


</html>
