<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">

<head>
    <link rel="icon" type="image/png" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="whatsapp-number" content="{{ format_whatsapp(\App\Models\Setting::get('whatsapp')) }}">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">

    @php
        $locale = get_active_locale();
        $seo_title = $seo['title_' . $locale] ?? 'Sepetiniz — Dioreal Dijital';
        $seo_desc = $seo['desc_' . $locale] ?? 'Dioreal sepetinizdeki seçkin konaklama, yat kiralama ve gurme rezervasyonlarınızı inceleyin.';
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" />
</head>

<body style="background-color: var(--off-white, #fcfbf9); color: var(--near-black, #1a1816);">

    <!-- Navigation Header -->
    <nav id="mainNav" class="light-nav">
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
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>

            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
        </ul>
        <div class="nav-right" style="display: flex; align-items: center; gap: 1.5rem;">
            <!-- Cart Icon Header Button -->
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
            <li><a href="{{ route('sepet') }}" style="color: #c5a059;">Sepetiniz (<span class="cart-badge" style="position:static; display:inline-flex;">0</span>)</a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
        </ul>
    </div>

    <!-- Main Shopping Cart Section -->
    <section class="cart-section">
        <div class="cart-container">
            <div class="cart-header reveal">
                <span class="cart-header-subtitle">DIOREAL LUXURY RESERVATIONS</span>
                <h1 class="cart-title" data-i18n="cart_title">Sepetiniz</h1>
            </div>

            <div class="cart-grid">
                <!-- Cart Items List (Left Side) -->
                <div class="cart-items-list reveal" style="transition-delay: 0.1s" id="cartItemsList">
                    <!-- Items rendered dynamically via cart.js -->
                </div>

                <!-- Empty Cart Fallback -->
                <div class="empty-cart-state" id="emptyCartState" style="display: none;">
                    <div class="empty-icon">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h2 class="empty-title" data-i18n="cart_empty">Sepetiniz Henüz Boş</h2>
                    <p class="empty-desc" data-i18n="cart_empty_sub">Dioreal'in ayrıcalıklı ürün koleksiyonunu, konaklama paketlerini ve özel deneyimlerini inceleyerek sepetinize ekleyebilirsiniz.</p>
                    <a href="{{ route('urunler') }}" class="btn-explore">
                        <span data-i18n="cart_btn_products">Ürünleri Keşfet</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Summary Box (Right Side) -->
                <div class="order-summary-card reveal" style="transition-delay: 0.2s" id="summaryCard">

                    <h3 class="summary-title" data-i18n="cart_title">Rezervasyon Özeti</h3>
                    
                    <div class="summary-row">
                        <span>Seçilen Deneyimler</span>
                        <span id="cartSubtotal">₺0</span>
                    </div>

                    <div class="summary-row" id="discountRow" style="display: none; color: #4caf50;">
                        <span>İndirim</span>
                        <span id="cartDiscount">-₺0</span>
                    </div>

                    <div class="summary-row">
                        <span>Hizmet & KDV Bedeli (%8)</span>
                        <span id="cartServiceFee">₺0</span>
                    </div>

                    <div class="promo-box">
                        <input type="text" id="promoInput" class="promo-input" placeholder="Promosyon / VIP Kodu">
                        <button type="button" id="applyPromoBtn" class="promo-btn">Uygula</button>
                    </div>
                    <div id="promoMsg" style="font-size: 0.78rem; margin-top: -0.8rem; margin-bottom: 1rem; min-height: 18px;"></div>

                    <div class="summary-row total">
                        <span data-i18n="cart_total">Toplam Tutar</span>
                        <span class="summary-total-price" id="cartGrandTotal">₺0</span>
                    </div>

                    <button type="button" id="checkoutBtn" class="checkout-btn" style="background: #25D366; color: #ffffff; border: none; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s ease;">
                        <i class="fa-brands fa-whatsapp" style="font-size: 1.4rem;"></i>
                        <span data-i18n="cart_checkout_wa">WhatsApp ile Sipariş Ver</span>
                    </button>

                    <p class="checkout-notes">
                        <i class="fa-solid fa-shield-halved" style="color: #c5a059; margin-right: 4px;"></i>
                        Siparişiniz doğrudan WhatsApp hattımıza aktarılacak ve özel temsilcimiz anında yardımcı olacaktır.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Core Scripts -->
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>

</body>
</html>
