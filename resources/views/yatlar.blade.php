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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">

    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v={{ time() }}">
    <style>
        .yacht-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(200, 169, 110, 0.12);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .yacht-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(29, 27, 26, 0.08);
            border-color: rgba(200, 169, 110, 0.35);
        }
        .yacht-img-container {
            width: 100%;
            aspect-ratio: 16/10;
            overflow: hidden;
            position: relative;
        }
        .yacht-img-container .card-img {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .yacht-card:hover .card-img {
            transform: scale(1.08);
        }
        .yacht-card-body {
            padding: 2.2rem 2rem 2rem 2rem !important;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .yacht-card-body .card-tag {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            color: var(--accent);
            letter-spacing: 0.15em;
            margin-bottom: 0.8rem;
            text-transform: uppercase;
        }
        .yacht-card-body .card-title {
            font-family: var(--font-display);
            font-size: 1.8rem;
            color: var(--near-black);
            margin-bottom: 1rem;
            font-weight: 400;
            line-height: 1.3;
        }
        .yacht-card-body .card-desc {
            font-size: 0.95rem;
            color: var(--mid-gray);
            line-height: 1.7;
            margin-bottom: 2rem;
            flex-grow: 1;
        }
        .yacht-card-footer {
            margin-top: auto;
            border-top: 1px solid rgba(200, 169, 110, 0.1);
            padding-top: 1.5rem;
        }
        .btn-yacht-detail {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            background: transparent;
            color: var(--near-black);
            border: 1px solid rgba(26, 24, 22, 0.15);
            padding: 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-size: 0.8rem;
            transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            cursor: pointer;
        }
        .btn-yacht-detail i {
            font-size: 0.75rem;
            transition: transform 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        }
        .btn-yacht-detail:hover {
            background: var(--near-black);
            color: var(--white);
            border-color: var(--near-black);
        }
        .btn-yacht-detail:hover i {
            transform: translateX(5px);
        }
    </style>
    @php
        $locale = get_active_locale();
        $seoData = get_page_seo('yatlar');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/yat_manzara.jpg');
        $canonical = $canonical ?? route('yatlar');
        $hreflang_tr = $hreflang_tr ?? route('yatlar');
        $hreflang_en = $hreflang_en ?? route('yatlar');
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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">
</head>
<body>

    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" class="active-page" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('urunler') }}">Ürünler</a></li>
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
                <span id="lang-tr" class="lang-btn active">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>

    </nav>

    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('urunler') }}" data-i18n="nav_products">Ürünler</a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
            <li style="font-size: 1.5rem; font-family: var(--font-display); margin-top: 2rem;">
                <span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>


    <div class="page-hero" style="background-image: url('{{ dioreal_img($settings["yat_hero_img"] ?? "", "foto.img/yat_manzara.jpg") }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">{{ $settings['yat_hero_eyebrow_tr'] ?? 'Akdeniz\'de Özgürlük' }}</span>
                <span class="lang-text-en">{{ $settings['yat_hero_eyebrow_en'] ?? 'Freedom in the Mediterranean' }}</span>
            </span>
            <h1 class="page-title lang-text-tr">{!! nl2br(e($settings['yat_hero_title_tr'] ?? "Özel Yatlar")) !!}</h1>
            <h1 class="page-title lang-text-en">{!! nl2br(e($settings['yat_hero_title_en'] ?? "Private Yachts")) !!}</h1>
        </div>
    </div>

    <section class="content-section">
        <div class="content-grid">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['yat_intro_eyebrow_tr'] ?? 'Yat Tatili' }}</span>
                    <span class="lang-text-en">{{ $settings['yat_intro_eyebrow_en'] ?? 'Yacht Holiday' }}</span>
                </span>
                <h2 class="content-title lang-text-tr">{{ $settings['yat_intro_title_tr'] ?? 'Koydan koya, özgürce' }}</h2>
                <h2 class="content-title lang-text-en">{{ $settings['yat_intro_title_en'] ?? 'From bay to bay, freely' }}</h2>

                <p class="content-body lang-text-tr">{{ $settings['yat_intro_text_tr'] ?? "Kendi rotanızı belirleyin, kendi hızınızda ilerleyin. Türkiye'nin turquoise kıyılarından Yunan adalarına, İtalyan rivieralarından Hırvatistan koylarına uzanan yolculuklarda lüks ve özgürlüğü bir arada yaşayın." }}</p>
                <p class="content-body lang-text-en">{{ $settings['yat_intro_text_en'] ?? "Set your own course and pace. Experience luxury and freedom across Turkey's turquoise coasts, Aegean islands, and Italian rivieras." }}</p>

                <a href="#yatlar" class="btn btn-primary">
                    <span class="lang-text-tr">Yatları İncele</span>
                    <span class="lang-text-en">Explore Yachts</span>
                </a>
            </div>
            <div class="reveal" style="transition-delay: 0.2s;">
                <img src="{{ dioreal_img($settings['yat_intro_img'] ?? '', 'foto.img/yat_ozgur.jpg') }}" alt="Özel Yat" style="width:100%; aspect-ratio: 4/3; object-fit: cover;">
            </div>
        </div>
    </section>

    <section class="content-section alt" id="yatlar">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span class="content-eyebrow" style="display: block;">
                <span class="lang-text-tr">{{ $settings['yacht_fleet_eyebrow_tr'] ?? 'Filo' }}</span>
                <span class="lang-text-en">{{ $settings['yacht_fleet_eyebrow_en'] ?? 'Fleet' }}</span>
            </span>
            <h2 class="content-title" style="font-size: clamp(2rem, 4vw, 3rem);">
                <span class="lang-text-tr">{!! $settings['yacht_fleet_title_tr'] ?? 'Premium <em>Yat Filomuz</em>' !!}</span>
                <span class="lang-text-en">{!! $settings['yacht_fleet_title_en'] ?? 'Our Premium <em>Yacht Fleet</em>' !!}</span>
            </h2>
        </div>
        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
            @foreach($yatlar as $y)
                <div class="card yacht-card reveal visible">
                    <div class="yacht-img-container">
                        <img src="{{ dioreal_img($y->img, 'foto.img/yat_ozgur.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/yat_ozgur.jpg') }}';" alt="{{ $y->name['tr'] ?? '' }}" class="card-img" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body yacht-card-body">
                        <span class="card-tag lang-text-tr">{{ $y->tag["tr"] ?? "" }}</span>
                        <span class="card-tag lang-text-en">{{ $y->tag["en"] ?? "" }}</span>
                        
                        <h3 class="card-title lang-text-tr">{{ $y->name["tr"] ?? "" }}</h3>
                        <h3 class="card-title lang-text-en">{{ $y->name["en"] ?? "" }}</h3>
                        
                        <p class="card-desc lang-text-tr">{{ $y->desc["tr"] ?? "" }}</p>
                        <p class="card-desc lang-text-en">{{ $y->desc["en"] ?? "" }}</p>
                        
                        <div class="yacht-card-footer">
                            <a href="{{ route('yat.detay', $y->slug_tr ?: ($y->slug_en ?: $y->id)) }}" class="btn-yacht-detail">
                                <span class="lang-text-tr">Detayları İncele</span>
                                <span class="lang-text-en">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid reverse">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['yat_route_eyebrow_tr'] ?? 'Güzergah Planlaması' }}</span>
                    <span class="lang-text-en">{{ $settings['yat_route_eyebrow_en'] ?? 'Route Planning' }}</span>
                </span>
                <h2 class="content-title lang-text-tr">{{ $settings['yat_route_title_tr'] ?? 'Her yolculuk size özel' }}</h2>
                <h2 class="content-title lang-text-en">{{ $settings['yat_route_title_en'] ?? 'Every voyage tailored for you' }}</h2>

                <p class="content-body lang-text-tr">{{ $settings['yat_route_text_tr'] ?? "Bodrum'dan Marmaris'e mavi yolculuk, Ege adaları turu ya da Akdeniz'den Adriyatik'e uzanan epik rotalar — siz hayal edin, biz planlayalım. Deneyimli kaptanlarımız ve özel aşçılarımızla konfor ve lüks güvencesinde." }}</p>
                <p class="content-body lang-text-en">{{ $settings['yat_route_text_en'] ?? "Blue voyages from Bodrum to Marmaris, Aegean island tours, or epic routes stretching from the Mediterranean to the Adriatic." }}</p>

                @php
                    $routeLink = !empty($settings['yat_route_btn_link']) ? $settings['yat_route_btn_link'] : 'https://wa.me/' . format_whatsapp($settings['whatsapp'] ?? '905449157011');
                @endphp
                <a href="{{ $routeLink }}" target="_blank" class="btn btn-outline">
                    <span class="lang-text-tr">{{ $settings['yat_route_btn_tr'] ?? 'Rota Planlat' }}</span>
                    <span class="lang-text-en">{{ $settings['yat_route_btn_en'] ?? 'Plan Your Route' }}</span>
                </a>
            </div>
            <div class="reveal" style="transition-delay: 0.2s;">
                <img src="{{ dioreal_img($settings['yat_route_img'] ?? '', 'foto.img/yat_rota.jpg') }}" alt="Yat Rotası" style="width:100%; aspect-ratio: 4/3; object-fit: cover;">
            </div>
        </div>
    </section>


    @include('partials.footer')

    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>
</body>
</html>



