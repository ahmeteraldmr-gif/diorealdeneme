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
    @php
        $locale = get_active_locale();
        $seoData = get_page_seo('gezi-rehberi');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/kapadokya.jpg');
        $canonical = $canonical ?? route('gezi-rehberi');
        $hreflang_tr = $hreflang_tr ?? route('gezi-rehberi');
        $hreflang_en = $hreflang_en ?? route('gezi-rehberi');
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
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('urunler') }}">Ürünler</a></li>
            <li><a href="{{ route('gezi-rehberi') }}" class="active-page" data-i18n="nav_guide">Gezi Rehberi</a></li>

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
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>


    <div class="page-hero" style="background-image:url('{{ dioreal_img($settings["guide_hero_img"] ?? "", "foto.img/kapadokya.jpg") }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">{{ $settings['guide_hero_eyebrow_tr'] ?? 'Keşfet & Öğren' }}</span>
                <span class="lang-text-en">{{ $settings['guide_hero_eyebrow_en'] ?? 'Discover & Learn' }}</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">{!! $settings['guide_hero_title_tr'] ?? 'Destinasyon<em>lar</em>' !!}</span>
                <span class="lang-text-en">{!! $settings['guide_hero_title_en'] ?? 'Destinat<em>ions</em>' !!}</span>
            </h1>
        </div>
    </div>

    <style>
        .card-desc-container {
            max-height: 4.8em; /* Roughly 3 lines of text */
            overflow: hidden;
            transition: max-height 0.4s ease;
            position: relative;
        }
        .card-desc-container.expanded {
            max-height: 1000px;
        }
        .read-more-btn {
            background: none;
            border: none;
            color: var(--accent, #c8a96e);
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 0.5rem;
            padding: 0;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .read-more-btn:hover {
            color: var(--near-black, #1a1816);
        }
    </style>
    <section class="content-section">
        <div style="text-align:center;max-width:700px;margin:0 auto 5rem;" class="reveal">
            <span class="content-eyebrow" style="display:block;">
                <span class="lang-text-tr">{{ $settings['guide_exp_eyebrow_tr'] ?? 'Uzman Tavsiyeleri' }}</span>
                <span class="lang-text-en">{{ $settings['guide_exp_eyebrow_en'] ?? 'Expert Advice' }}</span>
            </span>
            <h2 class="content-title">
                <span class="lang-text-tr">{!! $settings['guide_exp_title_tr'] ?? 'Doğru kararları <em>kolayca</em> verin' !!}</span>
                <span class="lang-text-en">{!! $settings['guide_exp_title_en'] ?? 'Make informed decisions <em>with ease</em>' !!}</span>
            </h2>
            <p class="content-body">
                <span class="lang-text-tr">{{ $settings['guide_exp_text_tr'] ?? 'Deneyimli seyahat editörlerimizin hazırladığı destinasyon rehberleri, pratik ipuçları ve sezonluk önerilerle seyahat planlamanızı kolaylaştırıyoruz.' }}</span>
                <span class="lang-text-en">{{ $settings['guide_exp_text_en'] ?? 'We simplify your travel planning with destination guides, practical tips, and seasonal recommendations prepared by our experienced travel editors.' }}</span>
            </p>
        </div>
        <div class="card-grid">
            @foreach($rehberler as $g)
                <div class="card reveal visible">
                    <div class="card-img" style="position: relative; overflow: hidden;">
                        <img src="{{ dioreal_img($g->img, 'foto.img/bodrum.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/bodrum.jpg') }}';" alt="{{ $g->title['tr'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body">

                        <span class="card-tag lang-text-tr">{{ !empty($g->tag["tr"]) ? $g->tag["tr"] : ($g->tag["en"] ?? "") }}</span>
                        <span class="card-tag lang-text-en">{{ !empty($g->tag["en"]) ? $g->tag["en"] : ($g->tag["tr"] ?? "") }}</span>
                        
                        <h3 class="card-title lang-text-tr">{{ !empty($g->title["tr"]) ? $g->title["tr"] : ($g->title["en"] ?? "") }}</h3>
                        <h3 class="card-title lang-text-en">{{ !empty($g->title["en"]) ? $g->title["en"] : ($g->title["tr"] ?? "") }}</h3>
                        
                        <div class="card-desc-container">
                            <p class="card-desc lang-text-tr">{{ !empty($g->desc["tr"]) ? $g->desc["tr"] : ($g->desc["en"] ?? "") }}</p>
                            <p class="card-desc lang-text-en">{{ !empty($g->desc["en"]) ? $g->desc["en"] : ($g->desc["tr"] ?? "") }}</p>
                        </div>
                        <div class="card-btn-wrapper" style="margin-top: 1.25rem;">
                            <a href="{{ route('rehber.detay', $g->slug_tr ?: ($g->slug_en ?: $g->id)) }}" class="read-more-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <span class="lang-text-tr">Detayları İncele</span>
                                <span class="lang-text-en">View Details</span>
                                <i class="fas fa-chevron-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @include('partials.footer')
    <script>
        function toggleReadMore(button) {
            const container = button.previousElementSibling;
            if (container.classList.contains('expanded')) {
                container.classList.remove('expanded');
                button.querySelector('.lang-text-tr').textContent = 'Devamını Oku';
                button.querySelector('.lang-text-en').textContent = 'Read More';
            } else {
                container.classList.add('expanded');
                button.querySelector('.lang-text-tr').textContent = 'Kapat';
                button.querySelector('.lang-text-en').textContent = 'Read Less';
            }
        }
    </script>
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>
</body>
</html>

