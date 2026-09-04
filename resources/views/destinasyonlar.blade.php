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
            <li><a href="{{ route('hakkimizda') }}"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About Us</span></a></li>
            <li><a href="{{ route('oteller') }}"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="{{ route('urunler') }}"><span class="lang-text-tr">Ürünler</span><span class="lang-text-en">Products</span></a></li>
            <li><a href="{{ route('gezi-rehberi') }}" class="active-page"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
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
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            margin-top: 4rem;
            margin-bottom: 2rem;
        }
        .pagination-btn {
            padding: 0.6rem 1.4rem;
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 30px;
            color: var(--near-black, #1a1816);
            text-decoration: none;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }
        .pagination-btn:hover:not(.disabled) {
            background: var(--near-black, #1a1816);
            color: #fff;
            border-color: var(--near-black, #1a1816);
        }
        .pagination-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
        .pagination-numbers {
            display: flex;
            gap: 0.5rem;
        }
        .pagination-number {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--near-black, #1a1816);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .pagination-number.active, .pagination-number:hover {
            background: var(--accent, #c8a96e);
            color: #fff;
        }
        .btn-guide-explore {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent, #c8a96e);
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: color 0.3s;
        }
        .btn-guide-explore:hover {
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
                @php
                    $imgUrl = dioreal_img($g->img, 'foto.img/bodrum.jpg');
                    $slug = $g->slug_tr ?: ($g->slug_en ?: $g->id);
                    $tagTr = !empty($g->tag["tr"]) ? $g->tag["tr"] : ($g->tag["en"] ?? "");
                    $tagEn = !empty($g->tag["en"]) ? $g->tag["en"] : ($g->tag["tr"] ?? "");
                    $titleTr = !empty($g->title["tr"]) ? $g->title["tr"] : ($g->title["en"] ?? "");
                    $titleEn = !empty($g->title["en"]) ? $g->title["en"] : ($g->title["tr"] ?? "");
                    $rawDescTr = !empty($g->desc["tr"]) ? $g->desc["tr"] : ($g->desc["en"] ?? "");
                    $rawDescEn = !empty($g->desc["en"]) ? $g->desc["en"] : ($g->desc["tr"] ?? "");
                    $cleanDescTr = trim(preg_replace('/\s+/', ' ', strip_tags($rawDescTr)));
                    $cleanDescEn = trim(preg_replace('/\s+/', ' ', strip_tags($rawDescEn)));
                    $descTr = \Illuminate\Support\Str::limit($cleanDescTr, 220);
                    $descEn = \Illuminate\Support\Str::limit($cleanDescEn, 220);
                @endphp
                <div class="card reveal visible" style="display: flex; flex-direction: column;">
                    <a href="{{ route('rehber.detay', $slug) }}" style="display: block; overflow: hidden; text-decoration: none;">
                        <div class="card-img" style="background-image:url('{{ $imgUrl }}'); height: 260px; background-size: cover; background-position: center;"></div>
                    </a>
                    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1; padding: 2rem 1.5rem;">
                        <span class="card-tag lang-text-tr" style="margin-bottom: 0.5rem;">{{ $tagTr }}</span>
                        <span class="card-tag lang-text-en" style="margin-bottom: 0.5rem;">{{ $tagEn }}</span>
                        
                        <a href="{{ route('rehber.detay', $slug) }}" style="text-decoration: none; color: inherit;">
                            <h3 class="card-title lang-text-tr" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;">{{ $titleTr }}</h3>
                            <h3 class="card-title lang-text-en" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;">{{ $titleEn }}</h3>
                        </a>
                        
                        <div style="margin-bottom: 1.5rem; flex-grow: 1;">
                            <p class="card-desc lang-text-tr" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;">{{ $descTr }}</p>
                            <p class="card-desc lang-text-en" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;">{{ $descEn }}</p>
                        </div>
                        
                        <div class="card-btn-wrapper" style="margin-top: auto; padding-top: 0.5rem;">
                            <a href="{{ route('rehber.detay', $slug) }}" class="btn-guide-explore">
                                <span class="lang-text-tr">Rehberi İncele</span>
                                <span class="lang-text-en">View Guide</span>
                                <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($rehberler instanceof \Illuminate\Pagination\LengthAwarePaginator && $rehberler->hasPages())
            <div class="custom-pagination">
                @if ($rehberler->onFirstPage())
                    <span class="pagination-btn disabled">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></span>
                @else
                    <a href="{{ $rehberler->previousPageUrl() }}" class="pagination-btn">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></a>
                @endif
                
                <div class="pagination-numbers">
                    @for ($i = 1; $i <= $rehberler->lastPage(); $i++)
                        @if ($i == $rehberler->currentPage())
                            <span class="pagination-number active">{{ $i }}</span>
                        @else
                            <a href="{{ $rehberler->url($i) }}" class="pagination-number">{{ $i }}</a>
                        @endif
                    @endfor
                </div>

                @if ($rehberler->hasMorePages())
                    <a href="{{ $rehberler->nextPageUrl() }}" class="pagination-btn"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</a>
                @else
                    <span class="pagination-btn disabled"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</span>
                @endif
            </div>
        @endif
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
