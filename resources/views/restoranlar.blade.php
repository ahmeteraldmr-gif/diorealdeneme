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
        $seoData = get_page_seo('restoranlar');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/rest_hero.jpg');
        $canonical = $canonical ?? route('restoranlar');
        $hreflang_tr = $hreflang_tr ?? route('restoranlar');
        $hreflang_en = $hreflang_en ?? route('restoranlar');
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
            <li><a href="{{ route('restoranlar') }}" class="active-page" data-i18n="nav_restaurants">Restoranlar</a></li>
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
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>


    <div class="page-hero" style="background-image: url('{{ dioreal_img($settings["rest_hero_img"] ?? "", "foto.img/rest_hero.jpg") }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">{{ $settings['rest_hero_eyebrow_tr'] ?? 'Gastronomi Deneyimi' }}</span>
                <span class="lang-text-en">{{ $settings['rest_hero_eyebrow_en'] ?? 'Gastronomic Experience' }}</span>
            </span>
            <h1 class="page-title lang-text-tr">{!! nl2br(e($settings['rest_hero_title_tr'] ?? "Seçkin Restoranlar")) !!}</h1>
            <h1 class="page-title lang-text-en">{!! nl2br(e($settings['rest_hero_title_en'] ?? "Exclusive Restaurants")) !!}</h1>
        </div>
    </div>

    <section class="content-section">
        <div class="content-grid">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['rest_intro_eyebrow_tr'] ?? 'Lezzet & Atmosfer' }}</span>
                    <span class="lang-text-en">{{ $settings['rest_intro_eyebrow_en'] ?? 'Flavor & Atmosphere' }}</span>
                </span>
                <h2 class="content-title lang-text-tr">{{ $settings['rest_intro_title_tr'] ?? 'Yemek bir sanattır' }}</h2>
                <h2 class="content-title lang-text-en">{{ $settings['rest_intro_title_en'] ?? 'Dining is an art' }}</h2>

                <p class="content-body lang-text-tr">{{ $settings['rest_intro_text_tr'] ?? 'Michelin yıldızlı şeflerden yerel lezzet ustalarına, deniz kenarı balık restoranlarından dağ başı gurme deneyimlerine uzanan koleksiyonumuzla her damak tadına hitap eden masaları keşfedin.' }}</p>
                <p class="content-body lang-text-en">{{ $settings['rest_intro_text_en'] ?? 'Discover curated dining experiences ranging from Michelin-starred chefs to coastal seafood sanctuaries and mountain gourmet retreats.' }}</p>

                <a href="{{ !empty($settings['rest_btn_link']) ? $settings['rest_btn_link'] : '#restoranlar' }}" class="btn btn-primary">
                    <span class="lang-text-tr">{{ $settings['rest_btn_tr'] ?? 'Masaları Keşfet' }}</span>
                    <span class="lang-text-en">{{ $settings['rest_btn_en'] ?? 'Explore Tables' }}</span>
                </a>

            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <img src="{{ dioreal_img($settings['rest_intro_img'] ?? '', 'foto.img/rest_intro.jpg') }}" alt="Restaurant" style="width:100%;aspect-ratio:4/3;object-fit:cover;">
            </div>
        </div>
    </section>


    <section class="content-section alt" id="restoranlar">
        <div style="text-align:center;margin-bottom:4rem;">
            <span class="content-eyebrow" style="display:block;" data-i18n="rest_col_eye">Koleksiyon</span>
            <h2 class="content-title" style="font-size:clamp(2rem,4vw,3rem);" data-i18n="rest_col_title">Öne Çıkan <em>Masalar</em></h2>
        </div>
        <div class="card-grid" id="restCardsGrid">
            @foreach($restoranlar as $r)
                <div class="card reveal visible">
                    <div class="card-img" style="position: relative; overflow: hidden; background-image: none;">
                        @if($r->show_video_on_cover && (!empty($r->video_file) || !empty($r->video_url)))
                            @if(!empty($r->video_file))
                                <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;">
                                    <source src="{{ asset($r->video_file) }}" type="video/mp4">
                                </video>
                            @elseif(!empty($r->video_url))
                                @php
                                    $embedUrl = $r->video_url;
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $r->video_url, $matches)) {
                                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3';
                                    }
                                @endphp
                                <iframe src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none; transform: scale(1.35); position: absolute; inset: 0; border: none;"></iframe>
                            @endif
                        @else
                            <img src="{{ dioreal_img($r->img, 'foto.img/rest_intro.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/rest_intro.jpg') }}';" alt="{{ $r->name['tr'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;">
                        @endif


                    </div>
                    <div class="card-body">
                        <span class="card-tag lang-text-tr">{{ $r->tag["tr"] ?? "" }}</span>
                        <span class="card-tag lang-text-en">{{ $r->tag["en"] ?? "" }}</span>
                        
                        <h3 class="card-title lang-text-tr">{{ $r->name["tr"] ?? "" }}</h3>
                        <h3 class="card-title lang-text-en">{{ $r->name["en"] ?? "" }}</h3>
                        
                        <p class="card-desc lang-text-tr">{{ $r->desc["tr"] ?? "" }}</p>
                        <p class="card-desc lang-text-en">{{ $r->desc["en"] ?? "" }}</p>
                        
                        <a href="{{ route('restoran.detay', $r->slug_tr ?: ($r->slug_en ?: $r->id)) }}" class="btn btn-primary" style="margin-top:1rem; padding: 0.5rem 1rem;">
                            <span class="lang-text-tr">Detayları İncele</span>
                            <span class="lang-text-en">View Details</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>
</body>
</html>



