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
        $seoData = get_page_seo('hakkimizda');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/hero_4k.jpg');
        $canonical = $canonical ?? route('hakkimizda');
        $hreflang_tr = $hreflang_tr ?? route('hakkimizda');
        $hreflang_en = $hreflang_en ?? route('hakkimizda');
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
            <li><a href="{{ route('hakkimizda') }}" class="active-page"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About Us</span></a></li>
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
            <li><a href="{{ route('hakkimizda') }}"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About Us</span></a></li>
            <li><a href="{{ route('oteller') }}"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="{{ route('urunler') }}"><span class="lang-text-tr">Ürünler</span><span class="lang-text-en">Products</span></a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="{{ route('etkinlikler') }}"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="{{ route('journal') }}"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>


    <div class="page-hero" style="background-image:url('{{ dioreal_img($settings['about_hero_img'] ?? '', 'foto.img/hero_4k.jpg') }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">{{ $settings['about_hero_eyebrow_tr'] ?? 'Biz Kimiz' }}</span>
                <span class="lang-text-en">{{ $settings['about_hero_eyebrow_en'] ?? 'Who We Are' }}</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">{!! $settings['about_hero_title_tr'] ?? 'Seyahate Başka Bir Yerden Bakmak' !!}</span>
                <span class="lang-text-en">{!! $settings['about_hero_title_en'] ?? 'A Different Perspective on Travel' !!}</span>
            </h1>
        </div>
    </div>

    <section class="content-section">
        <div class="content-grid">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['about_story_eyebrow_tr'] ?? 'Hikayemiz' }}</span>
                    <span class="lang-text-en">{{ $settings['about_story_eyebrow_en'] ?? 'Our Story' }}</span>
                </span>
                <h2 class="content-title">
                    <span class="lang-text-tr">{!! $settings['about_story_title_tr'] ?? 'Türk Rivierası’ndan Dünyaya Açılan Bir Seyahat Seçkisi' !!}</span>
                    <span class="lang-text-en">{!! $settings['about_story_title_en'] ?? 'A Travel Selection Born on the Turkish Riviera' !!}</span>
                </h2>
                <div class="lang-text-tr">
                    <p class="content-body">{!! nl2br(e($settings['about_story_p1_tr'] ?? 'DIOREAL, Türkiye’nin eşsiz kıyı kültürünü uluslararası bir bakış açısıyla dünyaya anlatmak ve seyahati yalnızca gidilecek yerlerin ötesinde, bütüncül bir deneyim olarak ele almak amacıyla kuruldu.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_story_p2_tr'] ?? 'Türk Rivierası çıkış noktamız; dünya ise rotamız. Otelleri, restoranları, yatları ve destinasyonları yalnızca tanıtmıyor; her birini kültürü, mimarisi, gastronomisi, doğası ve taşıdığı hikâyeyle birlikte editoryal bir seçkinin parçası olarak ele alıyoruz.')) !!}</p>
                </div>
                <div class="lang-text-en">
                    <p class="content-body">{!! nl2br(e($settings['about_story_p1_en'] ?? 'DIOREAL was founded to introduce Türkiye’s distinctive coastal culture to the world through an international perspective and to approach travel as a complete experience extending far beyond the places we visit.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_story_p2_en'] ?? 'The Turkish Riviera is our starting point; the world is our route. We do more than present hotels, restaurants, yachts and destinations—we explore each through its culture, architecture, gastronomy, natural setting and story, bringing them together within a carefully considered editorial selection.')) !!}</p>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <img src="{{ dioreal_img($settings['about_story_img'] ?? '', 'uploads/settings/1785331414_6a69fed6944c8.png') }}" alt="Hakkımızda" style="width:100%;aspect-ratio:4/3;object-fit:cover;">
            </div>
        </div>
    </section>

    <section class="content-section alt">
        <div style="text-align:center;max-width:800px;margin:0 auto 4rem;" class="reveal">
            <span class="content-eyebrow" style="display:block;">
                <span class="lang-text-tr">Rakamlarla</span>
                <span class="lang-text-en">By Numbers</span>
            </span>
            <h2 class="content-title">
                <span class="lang-text-tr">{!! $settings['about_stats_title_tr'] ?? 'DIOREAL Dünyası' !!}</span>
                <span class="lang-text-en">{!! $settings['about_stats_title_en'] ?? 'The World of DIOREAL' !!}</span>
            </h2>
        </div>
        <div class="stat-row reveal" style="justify-content:center;">
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat1_num'] ?? '150+' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat1_label_tr'] ?? 'Destinasyon' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat1_label_en'] ?? 'Destinations' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat2_num'] ?? '1M' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat2_label_tr'] ?? 'Aylık Okuyucu' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat2_label_en'] ?? 'Monthly Readers' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat3_num'] ?? '100+' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat3_label_tr'] ?? 'Marka Ortağı' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat3_label_en'] ?? 'Brand Partners' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat4_num'] ?? '10' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat4_label_tr'] ?? 'Yıllık Deneyim' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat4_label_en'] ?? 'Years of Experience' }}</span>
                </span>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid reverse">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['about_mission_eyebrow_tr'] ?? 'Misyonumuz' }}</span>
                    <span class="lang-text-en">{{ $settings['about_mission_eyebrow_en'] ?? 'Our Mission' }}</span>
                </span>
                <h2 class="content-title">
                    <span class="lang-text-tr">{!! $settings['about_mission_title_tr'] ?? 'Anlamlı deneyimler için' !!}</span>
                    <span class="lang-text-en">{!! $settings['about_mission_title_en'] ?? 'For meaningful experiences' !!}</span>
                </h2>
                <div class="lang-text-tr">
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p1_tr'] ?? 'DIOREAL, seyahati yalnızca gidilecek yerlerin toplamı olarak değil; kültürün, mimarinin, gastronominin, tarihin ve insan hikâyelerinin bir araya geldiği bütüncül bir deneyim olarak ele alır.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p2_tr'] ?? 'Misyonumuz, Türkiye’nin eşsiz kıyı kültürünü ve Türk Rivierası’nı uluslararası bir bakış açısıyla dünyaya anlatırken, dünyanın en ilham verici destinasyonlarını da aynı editoryal özen ve estetik anlayışla keşfetmektir.')) !!}</p>
                </div>
                <div class="lang-text-en">
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p1_en'] ?? 'DIOREAL approaches travel not simply as a collection of places to visit, but as a complete experience shaped by culture, architecture, gastronomy, history and human stories.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p2_en'] ?? 'Our mission is to bring Türkiye’s distinctive coastal culture and the Turkish Riviera to the world through an international perspective, while exploring the world’s most inspiring destinations with the same editorial care and aesthetic vision.')) !!}</p>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <img src="{{ dioreal_img($settings['about_mission_img'] ?? '', 'foto.img/about_safari.jpg') }}" alt="Misyon" style="width:100%;aspect-ratio:4/3;object-fit:cover;">
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
