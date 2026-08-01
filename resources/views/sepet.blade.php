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

            @php
                $hasItems = !empty($cart) && count($cart) > 0;
                $serverSubtotal = 0;
                if ($hasItems) {
                    foreach ($cart as $cItem) {
                        $serverSubtotal += ((float)($cItem['price'] ?? 0)) * ((int)($cItem['quantity'] ?? 1));
                    }
                }
                $serverServiceFee = $serverSubtotal > 0 ? $serverSubtotal * 0.08 : 0;
                $serverGrandTotal = $serverSubtotal + $serverServiceFee;
            @endphp

            <div class="cart-grid">
                <!-- Cart Items List (Left Side) -->
                <div class="cart-items-list reveal visible" style="transition-delay: 0.1s; opacity: 1; visibility: visible; {{ !$hasItems ? 'display: none;' : 'display: flex;' }}" id="cartItemsList">
                    @if($hasItems)
                        @foreach($cart as $item)
                            @php
                                $pPrice = (float)($item['price'] ?? 0);
                                $pQty = (int)($item['quantity'] ?? 1);
                                $pSubtotal = $pPrice * $pQty;
                            @endphp
                            <div class="cart-item">
                                <div class="cart-item-left-block">
                                    <div class="cart-item-img-wrap">
                                        <img src="{{ asset($item['image'] ?? 'foto.img/hero_4k.jpg') }}" alt="{{ $item['name'] ?? '' }}" class="cart-item-img">
                                    </div>
                                    <div class="cart-item-details">
                                        <span class="cart-item-tag">{{ $item['type'] ?? 'Lüks Koleksiyon' }}</span>
                                        <a href="#" class="cart-item-name">{{ $item['name'] ?? '' }}</a>
                                        <span class="cart-item-price-unit">{{ $item['details'] ?? '' }} • ₺{{ number_format($pPrice, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="cart-item-right-block">
                                    <div class="quantity-control">
                                        <button type="button" class="qty-btn btn-minus" data-id="{{ $item['id'] }}">-</button>
                                        <span class="qty-val">{{ $pQty }}</span>
                                        <button type="button" class="qty-btn btn-plus" data-id="{{ $item['id'] }}">+</button>
                                    </div>

                                    <div class="cart-item-subtotal">₺{{ number_format($pSubtotal, 0, ',', '.') }}</div>

                                    <button type="button" class="remove-btn" data-id="{{ $item['id'] }}" title="Ürünü Kaldır">
                                        <i class="fa-regular fa-trash-can" style="font-size: 1rem;"></i>
                                        <span>Sil</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


                <!-- Empty Cart Fallback -->
                <div class="empty-cart-state" id="emptyCartState" style="{{ $hasItems ? 'display: none;' : 'display: block;' }}">
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
                <div class="order-summary-card reveal" style="transition-delay: 0.2s; {{ !$hasItems ? 'display: none;' : 'display: block;' }}" id="summaryCard">

                    <h3 class="summary-title" data-i18n="cart_title">Rezervasyon Özeti</h3>
                    
                    <div class="summary-row">
                        <span>Seçilen Deneyimler</span>
                        <span id="cartSubtotal">₺{{ number_format($serverSubtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row" id="discountRow" style="display: none; color: #4caf50;">
                        <span>İndirim</span>
                        <span id="cartDiscount">-₺0</span>
                    </div>

                    <div class="summary-row">
                        <span>Hizmet & KDV Bedeli (%8)</span>
                        <span id="cartServiceFee">₺{{ number_format($serverServiceFee, 0, ',', '.') }}</span>
                    </div>

                    <div class="promo-box">
                        <input type="text" id="promoInput" class="promo-input" placeholder="Promosyon / VIP Kodu">
                        <button type="button" id="applyPromoBtn" class="promo-btn">Uygula</button>
                    </div>
                    <div id="promoMsg" style="font-size: 0.78rem; margin-top: -0.8rem; margin-bottom: 1rem; min-height: 18px;"></div>

                    <div class="summary-row total">
                        <span data-i18n="cart_total">Toplam Tutar</span>
                        <span class="summary-total-price" id="cartGrandTotal">₺{{ number_format($serverGrandTotal, 0, ',', '.') }}</span>
                    </div>

                    <button type="button" id="checkoutBtn" class="checkout-btn" style="background: #111111; color: #ffffff; border: none; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s ease; padding: 1.1rem; border-radius: 40px; font-weight: 600; width: 100%; cursor: pointer;">
                        <i class="fa-solid fa-credit-card" style="font-size: 1.2rem; color: #c8a96e;"></i>
                        <span>Kredi Kartı ile Güvenli Öde</span>
                    </button>


                    <!-- E-Commerce Payment Security Badges -->
                    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-top: 1.2rem; opacity: 0.85;">
                        <i class="fa-brands fa-cc-visa" style="font-size: 1.8rem; color: #1a1f71;"></i>
                        <i class="fa-brands fa-cc-mastercard" style="font-size: 1.8rem; color: #eb001b;"></i>
                        <span style="font-size: 0.75rem; font-weight: 700; background: #e8f5e9; color: #2e7d32; padding: 0.2rem 0.6rem; border-radius: 12px; display: inline-flex; align-items: center; gap: 0.2rem;">
                            <i class="fa-solid fa-shield-halved"></i> 256-Bit SSL 3D SECURE
                        </span>
                    </div>

                    <p class="checkout-notes" style="text-align: center; margin-top: 1rem; font-size: 0.8rem; color: #777;">
                        Ödemeniz 256-Bit SSL şifreleme altyapısı ile güvence altındadır.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <!-- 💳 E-COMMERCE CREDIT CARD PAYMENT MODAL -->
    <div class="mojea-modal-backdrop" id="creditCardModal">
        <div class="mojea-modal-box" style="max-width: 550px; grid-template-columns: 1fr; padding: 2.5rem; border-radius: 20px; margin: auto !important;">
            <button type="button" class="mojea-modal-close-btn" onclick="closeCreditCardModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 1.8rem;">
                <span style="font-size: 0.75rem; letter-spacing: 0.2em; color: #c8a96e; font-weight: 600; text-transform: uppercase;">GÜVENLİ ÖDEME NOKTASI</span>
                <h2 style="font-family: var(--font-display, 'Cormorant Garamond', serif); font-size: 2rem; color: #111; margin-top: 0.4rem;">Kredi Kartı ile Ödeme</h2>
                <div style="font-size: 1.8rem; font-weight: 700; color: #111; margin-top: 0.5rem;" id="modalPayAmount">₺0</div>
            </div>

            <form onsubmit="processCreditCardPayment(event)" style="display: flex; flex-direction: column; gap: 1.2rem;">
                <div class="form-group">
                    <label style="font-size: 0.82rem; font-weight: 600; color: #333; display: block; margin-bottom: 0.4rem;">Kart Üzerindeki İsim ve Soyisim</label>
                    <input type="text" id="cardName" required placeholder="Örn: AHMET ERALDEMİR" style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; outline: none;">
                </div>

                <div class="form-group">
                    <label style="font-size: 0.82rem; font-weight: 600; color: #333; display: block; margin-bottom: 0.4rem;">Kart Numarası</label>
                    <div style="position: relative;">
                        <input type="text" id="cardNumber" required placeholder="0000 0000 0000 0000" oninput="formatCardNumber(this)" maxlength="19" style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1.05rem; letter-spacing: 0.1em; outline: none;">
                        <i class="fa-solid fa-credit-card" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label style="font-size: 0.82rem; font-weight: 600; color: #333; display: block; margin-bottom: 0.4rem;">Son Kullanma (AA/YY)</label>
                        <input type="text" id="cardExp" required placeholder="08/28" maxlength="5" style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; text-align: center; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 0.82rem; font-weight: 600; color: #333; display: block; margin-bottom: 0.4rem;">CVC / CVV</label>
                        <input type="password" id="cardCvc" required placeholder="***" maxlength="4" style="width: 100%; padding: 0.85rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; text-align: center; outline: none;">
                    </div>
                </div>

                <button type="submit" id="paySubmitBtn" style="background: #111111; color: #ffffff; border: none; padding: 1.1rem; border-radius: 40px; font-size: 0.9rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; cursor: pointer; transition: all 0.3s ease; margin-top: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <span>3D SECURE İLE ÖDEMEYİ TAMAMLA</span>
                </button>
            </form>
        </div>
    </div>

    <!-- 🎉 ORDER SUCCESS RECEIPT MODAL -->
    <div class="mojea-modal-backdrop" id="orderSuccessModal">
        <div class="mojea-modal-box" style="max-width: 500px; grid-template-columns: 1fr; padding: 3rem 2rem; border-radius: 20px; text-align: center; margin: auto !important;">

            <div style="width: 70px; height: 70px; background: #e8f5e9; color: #2e7d32; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto 1.5rem;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            
            <h2 style="font-family: var(--font-display, 'Cormorant Garamond', serif); font-size: 2.2rem; color: #111; margin-bottom: 0.5rem;">Ödemeniz Alındı!</h2>
            <p style="font-size: 0.95rem; color: #666; margin-bottom: 1.5rem;">Siparişiniz başarıyla onaylandı. Onay belgeniz e-posta adresinize gönderilmiştir.</p>

            <div style="background: #f9f9f9; border: 1px solid #eee; padding: 1.2rem; border-radius: 12px; margin-bottom: 2rem; text-align: left;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.85rem; color: #777;">Sipariş Kodu:</span>
                    <strong style="font-size: 0.9rem; color: #111;" id="successOrderCode">#DIO-000000</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #777;">Ödenen Tutar:</span>
                    <strong style="font-size: 1.1rem; color: #c8a96e;" id="successOrderTotal">₺0</strong>
                </div>
            </div>

            <button type="button" onclick="closeOrderSuccessModal()" style="background: #111; color: #fff; border: none; padding: 1rem 2rem; border-radius: 30px; font-weight: 600; cursor: pointer; text-transform: uppercase; letter-spacing: 0.08em;">
                Alışverişe Devam Et
            </button>
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
        const SERVER_CART = @json(array_values($cart ?? []));
        if (SERVER_CART && SERVER_CART.length > 0) {
            try {
                let localCart = [];
                try { localCart = JSON.parse(localStorage.getItem('dioreal_cart_items') || '[]'); } catch(e) {}
                if (!Array.isArray(localCart) || localCart.length === 0) {
                    localStorage.setItem('dioreal_cart_items', JSON.stringify(SERVER_CART));
                }
            } catch(e) {}
        }
        if (typeof window.renderCart === 'function') {
            window.renderCart();
        }
        if (window.DiorealCart && typeof window.DiorealCart.updateBadge === 'function') {
            window.DiorealCart.updateBadge();
        }
    </script>



</body>
</html>


