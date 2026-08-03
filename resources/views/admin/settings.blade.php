@extends('admin.layouts.app')

@section('title', 'Genel Ayarlar')

@section('page_title', 'Genel Ayarlar')
@section('page_subtitle', 'Sitenin iletişim bilgileri, sosyal ağ entegrasyonları, hero başlıkları, anasayfa/hakkımızda içerikleri ve marka referanslarının yönetimi.')

@section('content')
<style>
    .tab-btn {
        background: none;
        border: none;
        padding: 0.75rem 1.5rem;
        font-family: var(--font-body), sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.5) !important;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s ease;
    }
    .tab-btn:hover {
        color: #ffffff !important;
    }
    .tab-btn.active {
        color: var(--primary, #c8a96e) !important;
        border-bottom-color: var(--primary, #c8a96e) !important;
    }
    .setting-tab-pane {
        display: none;
    }
    .setting-tab-pane.active {
        display: block;
    }
    .img-preview-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-color);
        padding: 1rem;
        border-radius: var(--radius-md);
        margin-top: 0.5rem;
    }
    .img-preview {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        background: #111;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .form-section-title {
        color: var(--primary, #c8a96e);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        font-weight: 500;
    }
</style>

<div style="display: grid; grid-template-columns: 1fr; gap: 2.5rem;">
    
    <!-- General settings form -->
    <div class="panel-card">
        <div class="panel-card-header" style="flex-direction: column; align-items: flex-start; gap: 1rem; border-bottom: none; padding-bottom: 0;">
            <h3 class="panel-card-title">
                <i class="fas fa-sliders-h" style="color: var(--primary); margin-right: 0.5rem;"></i> Genel Ayarları Güncelle
            </h3>
            
            <div class="tabs-navigation" style="display: flex; gap: 0.5rem; border-bottom: 2px solid var(--border-color); width: 100%; flex-wrap: wrap;">
                <button type="button" class="tab-btn active" onclick="switchSettingTab(event, 'tab-general')">İletişim & Genel</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-ticker')">Duyuru Bandı (Marquee)</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-homepage')">Anasayfa İçeriği</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-about')">Hakkımızda İçeriği</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-pages')">Sayfa Başlıkları & Görselleri</button>
            </div>


        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem;">
            @csrf

            <!-- ── TAB 1: GENERAL & CONTACT ── -->
            <div id="tab-general" class="setting-tab-pane active">
                
                <h4 class="form-section-title" style="margin-top: 0;">Hero Giriş Başlığı</h4>
                <div class="lang-tabs-container">
                    <button type="button" class="lang-tab active" data-lang="tr" onclick="switchLanguageTab('tr')">Türkçe</button>
                    <button type="button" class="lang-tab" data-lang="en" onclick="switchLanguageTab('en')">English</button>
                </div>

                <div class="lang-pane active" data-lang="tr">
                    <div class="form-group">
                        <label class="form-label" for="hero_title_tr">Ana Başlık (TR)</label>
                        <textarea class="form-control" name="hero_title_tr" id="hero_title_tr" rows="2" placeholder="Örn: Türkiye ve dünyada seçkin&#10;deneyimlerin kapısını aralıyoruz.">{{ $settings['hero_title_tr'] ?? '' }}</textarea>
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Satır atlamak istediğiniz yerlerde normal Enter tuşuna basabilirsiniz.</small>
                    </div>
                </div>

                <div class="lang-pane" data-lang="en">
                    <div class="form-group">
                        <label class="form-label" for="hero_title_en">Ana Başlık (EN)</label>
                        <textarea class="form-control" name="hero_title_en" id="hero_title_en" rows="2" placeholder="Örn: Opening doors to exclusive&#10;experiences globally.">{{ $settings['hero_title_en'] ?? '' }}</textarea>
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Satır atlamak istediğiniz yerlerde normal Enter tuşuna basabilirsiniz.</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-top: 1.5rem;">
                    <!-- Contact Info Section -->
                    <div>
                        <h4 class="form-section-title" style="margin-top: 0;">İletişim Bilgileri</h4>
                        
                        <div class="form-group">
                            <label class="form-label" for="contact_email">E-posta Adresi</label>
                            <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@diorealdijital.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_phone">Telefon Numarası</label>
                            <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+90 212 555 0100">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_address_tr">Adres (TR)</label>
                            <input type="text" class="form-control" name="contact_address_tr" id="contact_address_tr" value="{{ $settings['contact_address_tr'] ?? '' }}" placeholder="İstanbul, Türkiye">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_address_en">Adres (EN)</label>
                            <input type="text" class="form-control" name="contact_address_en" id="contact_address_en" value="{{ $settings['contact_address_en'] ?? '' }}" placeholder="Istanbul, Turkey">
                        </div>
                    </div>

                    <!-- Social Media & Integrations -->
                    <div>
                        <h4 class="form-section-title" style="margin-top: 0;">Sosyal Ağlar & Entegrasyonlar</h4>

                        <div class="form-group">
                            <label class="form-label" for="instagram">Instagram Profili</label>
                            <input type="url" class="form-control" name="instagram" id="instagram" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/kullanici">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="linkedin">LinkedIn Profili</label>
                            <input type="url" class="form-control" name="linkedin" id="linkedin" value="{{ $settings['linkedin'] ?? '' }}" placeholder="https://linkedin.com/company/sirket">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="whatsapp">WhatsApp Buton Numarası</label>
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="905320000000">
                            <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Numaranın başına + veya 0 koymadan, ülke koduyla bitişik yazın (Örn: 905321234567).</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="footer_copy">Footer Telif Yazısı (Copyright)</label>
                            <input type="text" class="form-control" name="footer_copy" id="footer_copy" value="{{ $settings['footer_copy'] ?? '' }}" placeholder="© 2026 Dioreal Dijital. All Rights Reserved.">
                        </div>

                        <h4 class="form-section-title">Google & Analitik Entegrasyonları</h4>
                        <div class="form-group">
                            <label class="form-label" for="google_analytics">Google Analytics (GA4) Kodu / Ölçüm Kimliği</label>
                            <input type="text" class="form-control" name="google_analytics" id="google_analytics" value="{{ $settings['google_analytics'] ?? '' }}" placeholder="Örn: G-XXXXXXXXXX">
                            <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Google Analytics 4 Ölçüm Kimliğinizi (G-XXXXXXXXXX) buraya yapıştırabilirsiniz.</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="google_search_console">Google Search Console Meta Etiketi</label>
                            <input type="text" class="form-control" name="google_search_console" id="google_search_console" value="{{ $settings['google_search_console'] ?? '' }}" placeholder="Örn: google-site-verification koda ait içerik">
                            <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Search Console site doğrulama kodunuzu buraya ekleyebilirsiniz.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── TAB: MARQUEE TICKER ANNOUNCEMENT BAR ── -->
            <div id="tab-ticker" class="setting-tab-pane">
                <h4 class="form-section-title" style="margin-top: 0;">Üst Kayan Duyuru Bandı (Marquee Ticker)</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                    Sayfanın en üstünde kesintisiz kayan duyuru bandındaki metinleri ve vurulacak altın renkli vurgulu metinleri buradan yönetebilirsiniz.
                </p>

                <!-- Duyuru 1 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                    <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-bullhorn"></i> Duyuru 1</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Normal Metin (TR)</label>
                            <input type="text" class="form-control" name="ticker_text1_tr" value="{{ $settings['ticker_text1_tr'] ?? '✦ DIOREAL LUXURY SELECTIONS' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (TR)</label>
                            <input type="text" class="form-control" name="ticker_high1_tr" value="{{ $settings['ticker_high1_tr'] ?? '%100 ÖZEL CONCIERGE GARANTİSİ' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Normal Metin (EN)</label>
                            <input type="text" class="form-control" name="ticker_text1_en" value="{{ $settings['ticker_text1_en'] ?? '✦ DIOREAL LUXURY SELECTIONS' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (EN)</label>
                            <input type="text" class="form-control" name="ticker_high1_en" value="{{ $settings['ticker_high1_en'] ?? '100% PRIVATE CONCIERGE GUARANTEE' }}">
                        </div>
                    </div>
                </div>

                <!-- Duyuru 2 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                    <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-bullhorn"></i> Duyuru 2</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Normal Metin (TR)</label>
                            <input type="text" class="form-control" name="ticker_text2_tr" value="{{ $settings['ticker_text2_tr'] ?? '✦ 100.000 ₺ ÜZERİ REZERVASYONLARDA' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (TR)</label>
                            <input type="text" class="form-control" name="ticker_high2_tr" value="{{ $settings['ticker_high2_tr'] ?? 'VIP HELİKOPTER & YAT TRANSFERİ HEDİYE' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Normal Metin (EN)</label>
                            <input type="text" class="form-control" name="ticker_text2_en" value="{{ $settings['ticker_text2_en'] ?? '✦ FOR RESERVATIONS OVER 100,000 TRY' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (EN)</label>
                            <input type="text" class="form-control" name="ticker_high2_en" value="{{ $settings['ticker_high2_en'] ?? 'FREE VIP HELICOPTER & YACHT TRANSFER' }}">
                        </div>
                    </div>
                </div>

                <!-- Duyuru 3 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                    <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-bullhorn"></i> Duyuru 3</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Normal Metin (TR)</label>
                            <input type="text" class="form-control" name="ticker_text3_tr" value="{{ $settings['ticker_text3_tr'] ?? '✦ SEÇKİN VİLLA & YAT PAKETLERİNDE' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (TR)</label>
                            <input type="text" class="form-control" name="ticker_high3_tr" value="{{ $settings['ticker_high3_tr'] ?? 'ERKEN REZERVASYON AYRICALIKLARI' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Normal Metin (EN)</label>
                            <input type="text" class="form-control" name="ticker_text3_en" value="{{ $settings['ticker_text3_en'] ?? '✦ ON EXCLUSIVE VILLA & YACHT PACKAGES' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Altın Vurgulu Yazı (EN)</label>
                            <input type="text" class="form-control" name="ticker_high3_en" value="{{ $settings['ticker_high3_en'] ?? 'EARLY BOOKING PRIVILEGES' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── TAB 2: HOMEPAGE CONTENT ── -->

            <div id="tab-homepage" class="setting-tab-pane">
                
                <!-- Hero Background Slides -->
                <h4 class="form-section-title" style="margin-top: 0;">Anasayfa Hero Slayt Görselleri</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Slayt 1 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_1'] ?? 'foto.img/hero_4k.jpg') }}" alt="Slide 1">
                            <input type="file" name="hero_slide_1" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slayt 2 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_2'] ?? 'foto.img/hero_slide_2.jpg') }}" alt="Slide 2">
                            <input type="file" name="hero_slide_2" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slayt 3 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_3'] ?? 'foto.img/hero_slide_3.jpg') }}" alt="Slide 3">
                            <input type="file" name="hero_slide_3" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Manifesto Selection -->
                <h4 class="form-section-title">Bu Ayın Seçkinleri (Manifesto Başlığı)</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label" for="man_eyebrow_tr">Üst Başlık (TR)</label>
                        <input type="text" class="form-control" name="man_eyebrow_tr" id="man_eyebrow_tr" value="{{ $settings['man_eyebrow_tr'] ?? 'BU AYIN SEÇKİNLERİ' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="man_eyebrow_en">Üst Başlık (EN)</label>
                        <input type="text" class="form-control" name="man_eyebrow_en" id="man_eyebrow_en" value="{{ $settings['man_eyebrow_en'] ?? "THIS MONTH'S SELECTION" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="man_p1_tr">Açıklama Metni (TR)</label>
                    <textarea class="form-control" name="man_p1_tr" id="man_p1_tr" rows="3">{{ $settings['man_p1_tr'] ?? 'Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin.' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="man_p1_en">Açıklama Metni (EN)</label>
                    <textarea class="form-control" name="man_p1_en" id="man_p1_en" rows="3">{{ $settings['man_p1_en'] ?? "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you." }}</textarea>
                </div>

                <!-- Trends Cards Grid -->
                <h4 class="form-section-title">Seçkin Trend Lokasyon Kartları</h4>
                <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                    
                    <!-- Trend 1: Otel -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-hotel"></i> Trend 1: Otel Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_otel_title_tr" value="{{ $settings['trend_otel_title_tr'] ?? 'Kassandra Villa' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_otel_title_en" value="{{ $settings['trend_otel_title_en'] ?? 'Kassandra Villa' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_otel_desc_tr" value="{{ $settings['trend_otel_desc_tr'] ?? 'Ege\'nin gizli kalmış koylarında uyanmanın eşsiz hissi.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_otel_desc_en" value="{{ $settings['trend_otel_desc_en'] ?? 'The unique feeling of waking up in the hidden bays of the Aegean.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_otel_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Trend Otel">
                                    <input type="file" name="trend_otel_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 2: Restoran -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-utensils"></i> Trend 2: Restoran Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_rest_title_tr" value="{{ $settings['trend_rest_title_tr'] ?? 'Melengeç' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_rest_title_en" value="{{ $settings['trend_rest_title_en'] ?? 'Melengeç' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_rest_desc_tr" value="{{ $settings['trend_rest_desc_tr'] ?? 'Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_rest_desc_en" value="{{ $settings['trend_rest_desc_en'] ?? 'An unforgettable gastronomic journey with fresh seafood.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_rest_img'] ?? 'foto.img/rest_mikla.jpg') }}" alt="Trend Restoran">
                                    <input type="file" name="trend_rest_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 3: Yat -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-ship"></i> Trend 3: Yat Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_yat_title_tr" value="{{ $settings['trend_yat_title_tr'] ?? 'Blue Voyage' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_yat_title_en" value="{{ $settings['trend_yat_title_en'] ?? 'Blue Voyage' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_yat_desc_tr" value="{{ $settings['trend_yat_desc_tr'] ?? 'Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_yat_desc_en" value="{{ $settings['trend_yat_desc_en'] ?? 'Routes in infinite blue. Nothing but the sound of the wind.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_yat_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Trend Yat">
                                    <input type="file" name="trend_yat_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 4: Beach -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-umbrella-beach"></i> Trend 4: Plaj Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_beach_title_tr" value="{{ $settings['trend_beach_title_tr'] ?? 'Rups Beach' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_beach_title_en" value="{{ $settings['trend_beach_title_en'] ?? 'Rups Beach' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_beach_desc_tr" value="{{ $settings['trend_beach_desc_tr'] ?? 'Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_beach_desc_en" value="{{ $settings['trend_beach_desc_en'] ?? 'Golden sands and crystal waters. Moments accompanying the rhythm of the music.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_beach_img'] ?? 'foto.img/bodrum.jpg') }}" alt="Trend Beach">
                                    <input type="file" name="trend_beach_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── TAB 3: ABOUT PAGE CONTENT ── -->
            <div id="tab-about" class="setting-tab-pane">
                
                <!-- Hero Section -->
                <h4 class="form-section-title" style="margin-top: 0;">Hakkımızda Hero Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık / Eyebrow (TR)</label>
                                <input type="text" class="form-control" name="about_hero_eyebrow_tr" value="{{ $settings['about_hero_eyebrow_tr'] ?? 'Biz Kimiz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık / Eyebrow (EN)</label>
                                <input type="text" class="form-control" name="about_hero_eyebrow_en" value="{{ $settings['about_hero_eyebrow_en'] ?? 'Who We Are' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Ana Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_hero_title_tr" value="{{ $settings['about_hero_title_tr'] ?? 'Dioreal Dijital' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ana Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_hero_title_en" value="{{ $settings['about_hero_title_en'] ?? 'Dioreal Digital' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hero Arka Plan Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_hero_img'] ?? 'foto.img/hero_4k.jpg') }}" alt="About Hero">
                            <input type="file" name="about_hero_img" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Story Section -->
                <h4 class="form-section-title">Hikayemiz Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_story_eyebrow_tr" value="{{ $settings['about_story_eyebrow_tr'] ?? 'Hikayemiz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_story_eyebrow_en" value="{{ $settings['about_story_eyebrow_en'] ?? 'Our Story' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hikaye Başlığı (TR)</label>
                                <input type="text" class="form-control" name="about_story_title_tr" value="{{ $settings['about_story_title_tr'] ?? '15 yıldır lüks seyahatin sesi' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hikaye Başlığı (EN)</label>
                                <input type="text" class="form-control" name="about_story_title_en" value="{{ $settings['about_story_title_en'] ?? 'Voice of luxury travel for 15 years' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (TR)</label>
                            <textarea class="form-control" name="about_story_p1_tr" rows="2">{{ $settings['about_story_p1_tr'] ?? '2010 yılında İstanbul\'da kurulan Dioreal Dijital, Türkiye\'nin öncü lüks seyahat ve yaşam tarzı medya platformuna dönüşmüştür.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (EN)</label>
                            <textarea class="form-control" name="about_story_p1_en" rows="2">{{ $settings['about_story_p1_en'] ?? 'Founded in Istanbul in 2010, Dioreal Digital has evolved into Turkey\'s leading luxury travel and lifestyle media platform.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (TR)</label>
                            <textarea class="form-control" name="about_story_p2_tr" rows="2">{{ $settings['about_story_p2_tr'] ?? 'Her destinasyonda bizzat bulunarak, her oteli bizatihi deneyimleyerek ve her markayı özenle seçerek güvenilir bir referans noktası haline geldik.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (EN)</label>
                            <textarea class="form-control" name="about_story_p2_en" rows="2">{{ $settings['about_story_p2_en'] ?? 'By personally visiting every destination and experiencing every hotel firsthand, we\'ve become a trusted reference.' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hikayemiz Bölüm Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_story_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Story Image">
                            <input type="file" name="about_story_img" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <h4 class="form-section-title">İstatistikler & Rakamlar</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Bölüm Başlığı (TR)</label>
                        <input type="text" class="form-control" name="about_stats_title_tr" value="{{ $settings['about_stats_title_tr'] ?? '15 Yılın Mirası' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bölüm Başlığı (EN)</label>
                        <input type="text" class="form-control" name="about_stats_title_en" value="{{ $settings['about_stats_title_en'] ?? 'Legacy of 15 Years' }}">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
                    <!-- Stat 1 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 1</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat1_num" value="{{ $settings['about_stat1_num'] ?? '150+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat1_label_tr" value="{{ $settings['about_stat1_label_tr'] ?? 'Destinasyon' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat1_label_en" value="{{ $settings['about_stat1_label_en'] ?? 'Destinations' }}">
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 2</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat2_num" value="{{ $settings['about_stat2_num'] ?? '2M+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat2_label_tr" value="{{ $settings['about_stat2_label_tr'] ?? 'Aylık Okuyucu' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat2_label_en" value="{{ $settings['about_stat2_label_en'] ?? 'Monthly Readers' }}">
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 3</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat3_num" value="{{ $settings['about_stat3_num'] ?? '300+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat3_label_tr" value="{{ $settings['about_stat3_label_tr'] ?? 'Marka Ortağı' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat3_label_en" value="{{ $settings['about_stat3_label_en'] ?? 'Brand Partners' }}">
                        </div>
                    </div>
                    <!-- Stat 4 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 4</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat4_num" value="{{ $settings['about_stat4_num'] ?? '15' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat4_label_tr" value="{{ $settings['about_stat4_label_tr'] ?? 'Yıllık Deneyim' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat4_label_en" value="{{ $settings['about_stat4_label_en'] ?? 'Years of Experience' }}">
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <h4 class="form-section-title">Misyonumuz Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_mission_eyebrow_tr" value="{{ $settings['about_mission_eyebrow_tr'] ?? 'Misyonumuz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_mission_eyebrow_en" value="{{ $settings['about_mission_eyebrow_en'] ?? 'Our Mission' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Misyon Başlığı (TR)</label>
                                <input type="text" class="form-control" name="about_mission_title_tr" value="{{ $settings['about_mission_title_tr'] ?? 'Anlamlı deneyimler için' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Misyon Başlığı (EN)</label>
                                <input type="text" class="form-control" name="about_mission_title_en" value="{{ $settings['about_mission_title_en'] ?? 'For meaningful experiences' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (TR)</label>
                            <textarea class="form-control" name="about_mission_p1_tr" rows="2">{{ $settings['about_mission_p1_tr'] ?? 'Sadece güzel yerler göstermiyoruz. Seyahatin ruhunu, bir destinasyonun gerçek özünü, yerel kültürün derinliğini aktarıyoruz.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (EN)</label>
                            <textarea class="form-control" name="about_mission_p1_en" rows="2">{{ $settings['about_mission_p1_en'] ?? 'We don\'t just show beautiful places. We convey the true essence of a destination.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (TR)</label>
                            <textarea class="form-control" name="about_mission_p2_tr" rows="2">{{ $settings['about_mission_p2_tr'] ?? 'Okuyucularımız bize güvenir, markalarımız bize inanır, destinasyonlar bizi ortaklık arar çünkü söylediğimiz her şey gerçek.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (EN)</label>
                            <textarea class="form-control" name="about_mission_p2_en" rows="2">{{ $settings['about_mission_p2_en'] ?? 'Our readers trust us, our brands believe in us, and destinations seek partnerships because everything we say is authentic.' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Misyon Bölüm Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_mission_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Mission Image">
                            <input type="file" name="about_mission_img" accept="image/*">
                        </div>
                    </div>
                </div>

            </div>

            <!-- ── TAB 5: PAGES (OTELLER, RESTORANLAR, YATLAR) ── -->
            <div id="tab-pages" class="setting-tab-pane">
                
                <!-- 🏨 OTELLER SAYFASI -->
                <h4 class="form-section-title" style="margin-top: 0;">🏨 Oteller Sayfası İçerikleri & Üst Görsel</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (TR)</label>
                                <input type="text" class="form-control" name="otel_hero_eyebrow_tr" value="{{ $settings['otel_hero_eyebrow_tr'] ?? 'Premium Konaklama' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (EN)</label>
                                <input type="text" class="form-control" name="otel_hero_eyebrow_en" value="{{ $settings['otel_hero_eyebrow_en'] ?? 'Premium Stay' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (TR)</label>
                                <input type="text" class="form-control" name="otel_hero_title_tr" value="{{ $settings['otel_hero_title_tr'] ?? 'Seçkin Oteller' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (EN)</label>
                                <input type="text" class="form-control" name="otel_hero_title_en" value="{{ $settings['otel_hero_title_en'] ?? 'Exclusive Hotels' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (TR)</label>
                                <input type="text" class="form-control" name="otel_intro_title_tr" value="{{ $settings['otel_intro_title_tr'] ?? 'Her konaklamanın bir hikayesi vardır.' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (EN)</label>
                                <input type="text" class="form-control" name="otel_intro_title_en" value="{{ $settings['otel_intro_title_en'] ?? 'Every luxury stay has a story to tell.' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (TR)</label>
                            <textarea class="form-control" name="otel_intro_text_tr" rows="3">{{ $settings['otel_intro_text_tr'] ?? 'Dünyaca ünlü butik oteller, tarihi yapılar ve ultra-lüks resort\'lardan oluşan koleksiyonumuz, seyahatinizin her anını unutulmaz kılmak için özenle seçilmiştir. Sadece konaklama değil; bir vizyon, bir tutku sunuyoruz.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (EN)</label>
                            <textarea class="form-control" name="otel_intro_text_en" rows="3">{{ $settings['otel_intro_text_en'] ?? 'Our curated collection of world-renowned boutique hotels, historic estates, and ultra-luxury resorts is selected to make every moment unforgettable.' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Oteller Sayfası Üst Kapak Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                            <img class="img-preview" src="{{ asset($settings['otel_hero_img'] ?? 'foto.img/otel_hero.jpg') }}" alt="Oteller Hero Image" style="width: 100%; height: 160px; object-fit: cover;">
                            <input type="file" name="otel_hero_img" accept="image/*" style="margin-top: 0.8rem;">
                            <small style="color: var(--text-muted); margin-top: 0.4rem;">Oteller sayfasının en üstündeki dev arka plan görseli.</small>
                        </div>
                    </div>
                </div>

                <!-- 🍽️ RESTORANLAR SAYFASI -->
                <h4 class="form-section-title">🍽️ Restoranlar Sayfası İçerikleri & Üst Görsel</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (TR)</label>
                                <input type="text" class="form-control" name="rest_hero_eyebrow_tr" value="{{ $settings['rest_hero_eyebrow_tr'] ?? 'Gastronomi Deneyimi' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (EN)</label>
                                <input type="text" class="form-control" name="rest_hero_eyebrow_en" value="{{ $settings['rest_hero_eyebrow_en'] ?? 'Gastronomic Experience' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (TR)</label>
                                <input type="text" class="form-control" name="rest_hero_title_tr" value="{{ $settings['rest_hero_title_tr'] ?? 'Seçkin Restoranlar' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (EN)</label>
                                <input type="text" class="form-control" name="rest_hero_title_en" value="{{ $settings['rest_hero_title_en'] ?? 'Exclusive Restaurants' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (TR)</label>
                                <input type="text" class="form-control" name="rest_intro_title_tr" value="{{ $settings['rest_intro_title_tr'] ?? 'Yemek bir sanattır' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (EN)</label>
                                <input type="text" class="form-control" name="rest_intro_title_en" value="{{ $settings['rest_intro_title_en'] ?? 'Dining is an art' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (TR)</label>
                            <textarea class="form-control" name="rest_intro_text_tr" rows="3">{{ $settings['rest_intro_text_tr'] ?? 'Michelin yıldızlı şeflerden yerel lezzet ustalarına, deniz kenarı balık restoranlarından dağ başı gurme deneyimlerine uzanan koleksiyonumuzla her damak tadına hitap eden masaları keşfedin.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (EN)</label>
                            <textarea class="form-control" name="rest_intro_text_en" rows="3">{{ $settings['rest_intro_text_en'] ?? 'Discover curated dining experiences ranging from Michelin-starred chefs to coastal seafood sanctuaries and mountain gourmet retreats.' }}</textarea>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Buton Yazısı (TR)</label>
                                <input type="text" class="form-control" name="rest_btn_tr" value="{{ $settings['rest_btn_tr'] ?? 'Masaları Keşfet' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Buton Yazısı (EN)</label>
                                <input type="text" class="form-control" name="rest_btn_en" value="{{ $settings['rest_btn_en'] ?? 'Explore Tables' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Buton Tıklama Linki (URL / WhatsApp / İletişim)</label>
                            <input type="text" class="form-control" name="rest_btn_link" placeholder="Örn: #restoranlar veya https://wa.me/905449157011" value="{{ $settings['rest_btn_link'] ?? '' }}">
                        </div>

                    </div>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Restoranlar En Üst Kapak Görseli</label>
                            <div class="img-preview-container" style="flex-direction: column; align-items: flex-start;">
                                <img class="img-preview" src="{{ asset($settings['rest_hero_img'] ?? 'foto.img/rest_hero.jpg') }}" alt="Restoran Hero Image" style="width: 100%; height: 110px; object-fit: cover;">
                                <input type="file" name="rest_hero_img" accept="image/*" style="margin-top: 0.5rem;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Bölümü Yan Görseli</label>
                            <div class="img-preview-container" style="flex-direction: column; align-items: flex-start;">
                                <img class="img-preview" src="{{ asset($settings['rest_intro_img'] ?? 'foto.img/rest_intro.jpg') }}" alt="Restoran Intro Image" style="width: 100%; height: 110px; object-fit: cover;">
                                <input type="file" name="rest_intro_img" accept="image/*" style="margin-top: 0.5rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🛥️ YATLAR SAYFASI & GÜZERGAH PLANLAMASI -->
                <h4 class="form-section-title">🛥️ Yatlar Sayfası & Güzergah Planlaması Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (TR)</label>
                                <input type="text" class="form-control" name="yat_hero_eyebrow_tr" value="{{ $settings['yat_hero_eyebrow_tr'] ?? 'Akdeniz\'de Özgürlük' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Üst Etiket (EN)</label>
                                <input type="text" class="form-control" name="yat_hero_eyebrow_en" value="{{ $settings['yat_hero_eyebrow_en'] ?? 'Freedom in the Mediterranean' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (TR)</label>
                                <input type="text" class="form-control" name="yat_hero_title_tr" value="{{ $settings['yat_hero_title_tr'] ?? 'Özel Yatlar' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hero Başlığı (EN)</label>
                                <input type="text" class="form-control" name="yat_hero_title_en" value="{{ $settings['yat_hero_title_en'] ?? 'Private Yachts' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (TR)</label>
                                <input type="text" class="form-control" name="yat_intro_title_tr" value="{{ $settings['yat_intro_title_tr'] ?? 'Koydan koya, özgürce' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanıtım Başlığı (EN)</label>
                                <input type="text" class="form-control" name="yat_intro_title_en" value="{{ $settings['yat_intro_title_en'] ?? 'From bay to bay, freely' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (TR)</label>
                            <textarea class="form-control" name="yat_intro_text_tr" rows="3">{{ $settings['yat_intro_text_tr'] ?? 'Kendi rotanızı belirleyin, kendi hızınızda ilerleyin. Türkiye\'nin turquoise kıyılarından Yunan adalarına, İtalyan rivieralarından Hırvatistan koylarına uzanan yolculuklarda lüks ve özgürlüğü bir arada yaşayın.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanıtım Metni (EN)</label>
                            <textarea class="form-control" name="yat_intro_text_en" rows="3">{{ $settings['yat_intro_text_en'] ?? 'Set your own course and pace. Experience luxury and freedom across Turkey\'s turquoise coasts, Aegean islands, and Italian rivieras.' }}</textarea>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Yatlar En Üst Kapak Görseli</label>
                            <div class="img-preview-container" style="flex-direction: column; align-items: flex-start;">
                                <img class="img-preview" src="{{ asset($settings['yat_hero_img'] ?? 'foto.img/yat_manzara.jpg') }}" alt="Yat Hero Image" style="width: 100%; height: 110px; object-fit: cover;">
                                <input type="file" name="yat_hero_img" accept="image/*" style="margin-top: 0.5rem;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Yatlar Tanıtım Yan Görseli</label>
                            <div class="img-preview-container" style="flex-direction: column; align-items: flex-start;">
                                <img class="img-preview" src="{{ asset($settings['yat_intro_img'] ?? 'foto.img/yat_ozgur.jpg') }}" alt="Yat Intro Image" style="width: 100%; height: 110px; object-fit: cover;">
                                <input type="file" name="yat_intro_img" accept="image/*" style="margin-top: 0.5rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🗺️ YATLAR GÜZERGAH PLANLAMASI BÖLÜMÜ -->
                <div style="background: rgba(200, 169, 110, 0.05); border: 1px solid rgba(200, 169, 110, 0.2); padding: 1.5rem; border-radius: var(--radius-md); margin-top: 2rem;">
                    <h5 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.2rem;">🗺️ Güzergah Planlaması Bölümü & Rota Planlat Butonu</h5>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Güzergah Üst Etiket (TR)</label>
                                    <input type="text" class="form-control" name="yat_route_eyebrow_tr" value="{{ $settings['yat_route_eyebrow_tr'] ?? 'Güzergah Planlaması' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Güzergah Üst Etiket (EN)</label>
                                    <input type="text" class="form-control" name="yat_route_eyebrow_en" value="{{ $settings['yat_route_eyebrow_en'] ?? 'Route Planning' }}">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Güzergah Başlığı (TR)</label>
                                    <input type="text" class="form-control" name="yat_route_title_tr" value="{{ $settings['yat_route_title_tr'] ?? 'Her yolculuk size özel' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Güzergah Başlığı (EN)</label>
                                    <input type="text" class="form-control" name="yat_route_title_en" value="{{ $settings['yat_route_title_en'] ?? 'Every voyage tailored for you' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Güzergah Açıklama Metni (TR)</label>
                                <textarea class="form-control" name="yat_route_text_tr" rows="3">{{ $settings['yat_route_text_tr'] ?? 'Bodrum\'dan Marmaris\'e mavi yolculuk, Ege adaları turu ya da Akdeniz\'den Adriyatik\'e uzanan epik rotalar — siz hayal edin, biz planlayalım. Deneyimli kaptanlarımız ve özel aşçılarımızla konfor ve lüks güvencesinde.' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Güzergah Açıklama Metni (EN)</label>
                                <textarea class="form-control" name="yat_route_text_en" rows="3">{{ $settings['yat_route_text_en'] ?? 'Blue voyages from Bodrum to Marmaris, Aegean island tours, or epic routes stretching from the Mediterranean to the Adriatic.' }}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Butik/Rota Buton Yazısı (TR)</label>
                                    <input type="text" class="form-control" name="yat_route_btn_tr" value="{{ $settings['yat_route_btn_tr'] ?? 'Rota Planlat' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Butik/Rota Buton Yazısı (EN)</label>
                                    <input type="text" class="form-control" name="yat_route_btn_en" value="{{ $settings['yat_route_btn_en'] ?? 'Plan Your Route' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Buton Tıklama Bağlantısı (URL / WhatsApp / İletişim Formu Linki)</label>
                                <input type="text" class="form-control" name="yat_route_btn_link" placeholder="Örn: https://wa.me/905320000000 veya /iletisim" value="{{ $settings['yat_route_btn_link'] ?? '' }}">
                                <small style="color: var(--text-muted); display: block; margin-top: 0.3rem;">Boş bırakılırsa varsayılan WhatsApp hattına yönlendirir.</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Güzergah Bölümü Yan Görseli</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['yat_route_img'] ?? 'foto.img/yat_rota.jpg') }}" alt="Yat Route Image" style="width: 100%; height: 180px; object-fit: cover;">
                                <input type="file" name="yat_route_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🛍️ ÜRÜNLER SAYFASI VİTRİN SLIDER (SHOWCASE CAROUSEL) -->
                <h4 class="form-section-title">🛍️ Ürünler Sayfası Dönen Vitrin Slider Görselleri & İçerikleri</h4>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.5rem;">Ürünler sayfasının en üstündeki 3 adımlı dönen büyük vitrin slider alanının görsellerini, başlıklarını ve buton yazılarını buradan güncelleyebilirsiniz.</p>

                <!-- SLIDE 1 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;">
                    <h5 style="color: var(--primary); font-size: 1.05rem; margin-bottom: 1rem;"><i class="fas fa-images"></i> Vitrin Slide 1</h5>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_eye_tr" value="{{ $settings['ecom_slide1_eye_tr'] ?? 'PORSELEN & ÇATAL BIÇAK KOLEKSİYONU' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_eye_en" value="{{ $settings['ecom_slide1_eye_en'] ?? 'PORCELAIN & CUTLERY COLLECTION' }}">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_title_tr" value="{{ $settings['ecom_slide1_title_tr'] ?? 'Royal Altın İşlemeli Yemek Takımları' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_title_en" value="{{ $settings['ecom_slide1_title_en'] ?? 'Royal Gold Embossed Dinnerware' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (TR)</label>
                                <textarea class="form-control" name="ecom_slide1_text_tr" rows="2">{{ $settings['ecom_slide1_text_tr'] ?? '24 Parça Fine Bone China Porselen, Kristal Şarap Kadehleri ve Saf İpek Kırlent Koleksiyonu' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (EN)</label>
                                <textarea class="form-control" name="ecom_slide1_text_en" rows="2">{{ $settings['ecom_slide1_text_en'] ?? '24 Piece Fine Bone China Porcelain, Crystal Wine Glasses and Pure Silk Cushion Collection' }}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_btn_tr" value="{{ $settings['ecom_slide1_btn_tr'] ?? 'Koleksiyonu İncele' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_btn_en" value="{{ $settings['ecom_slide1_btn_en'] ?? 'Explore Collection' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slide 1 Arka Plan Arka Görseli</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide1_img'] ?? 'foto.img/hero_4k.jpg') }}" alt="Slide 1 Image" style="width: 100%; height: 160px; object-fit: cover;">
                                <input type="file" name="ecom_slide1_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;">
                    <h5 style="color: var(--primary); font-size: 1.05rem; margin-bottom: 1rem;"><i class="fas fa-images"></i> Vitrin Slide 2</h5>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_eye_tr" value="{{ $settings['ecom_slide2_eye_tr'] ?? 'EV & LÜKS DEKORASYON' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_eye_en" value="{{ $settings['ecom_slide2_eye_en'] ?? 'HOME & LUXURY DECORATION' }}">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_title_tr" value="{{ $settings['ecom_slide2_title_tr'] ?? 'Baccarat Kristal Kadehler & Murano Vazo' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_title_en" value="{{ $settings['ecom_slide2_title_en'] ?? 'Baccarat Crystal Glasses & Murano Vase' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (TR)</label>
                                <textarea class="form-control" name="ecom_slide2_text_tr" rows="2">{{ $settings['ecom_slide2_text_tr'] ?? 'Özel El Üfleme Cam Sanatı Eserleri ve Hermès İpek Dokuma Aksesuarlar' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (EN)</label>
                                <textarea class="form-control" name="ecom_slide2_text_en" rows="2">{{ $settings['ecom_slide2_text_en'] ?? 'Exclusive Handblown Glassware Masterpieces and Hermès Silk Woven Accessories' }}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_btn_tr" value="{{ $settings['ecom_slide2_btn_tr'] ?? 'Ürünleri Keşfet' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_btn_en" value="{{ $settings['ecom_slide2_btn_en'] ?? 'Discover Products' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slide 2 Arka Plan Arka Görseli</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide2_img'] ?? 'foto.img/otel_hero.jpg') }}" alt="Slide 2 Image" style="width: 100%; height: 160px; object-fit: cover;">
                                <input type="file" name="ecom_slide2_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;">
                    <h5 style="color: var(--primary); font-size: 1.05rem; margin-bottom: 1rem;"><i class="fas fa-images"></i> Vitrin Slide 3</h5>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_eye_tr" value="{{ $settings['ecom_slide3_eye_tr'] ?? 'VIP SEYAHAT & KONAKLAMA' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Kategori Etiketi (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_eye_en" value="{{ $settings['ecom_slide3_eye_en'] ?? 'VIP TRAVEL & ACCOMMODATION' }}">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_title_tr" value="{{ $settings['ecom_slide3_title_tr'] ?? 'Bodrum Sunset Villa & Kapadokya Turu' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slide Ana Başlık (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_title_en" value="{{ $settings['ecom_slide3_title_en'] ?? 'Bodrum Sunset Villa & Cappadocia Tour' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (TR)</label>
                                <textarea class="form-control" name="ecom_slide3_text_tr" rows="2">{{ $settings['ecom_slide3_text_tr'] ?? 'Özel Havuzlu Lüks Villa Tatili, Mavi Yolculuk ve VIP Havalimanı Karşılama' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Açıklama Metni (EN)</label>
                                <textarea class="form-control" name="ecom_slide3_text_en" rows="2">{{ $settings['ecom_slide3_text_en'] ?? 'Private Pool Luxury Villa Vacation, Blue Cruise and VIP Airport Greeting' }}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_btn_tr" value="{{ $settings['ecom_slide3_btn_tr'] ?? 'Paketleri İncele' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Buton Yazısı (EN)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_btn_en" value="{{ $settings['ecom_slide3_btn_en'] ?? 'Explore Packages' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slide 3 Arka Plan Arka Görseli</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide3_img'] ?? 'foto.img/bodrum.jpg') }}" alt="Slide 3 Image" style="width: 100%; height: 160px; object-fit: cover;">
                                <input type="file" name="ecom_slide3_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Form Submit -->
            <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem; display: flex; justify-content: flex-end; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Değişiklikleri Kaydet
                </button>
            </div>
        </form>
    </div>

    <!-- Brands & Collaborations Management -->
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title">
                <i class="fas fa-handshake" style="color: var(--primary); margin-right: 0.5rem;"></i> Marka Referansları
            </h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; padding: 1.5rem;">
            
            <!-- Existing Brands Grid -->
            <div>
                <h4 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.05rem;">Mevcut Referanslar</h4>
                
                @if(isset($settings['brands']) && is_array($settings['brands']) && count($settings['brands']) > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 1rem; max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                        @foreach($settings['brands'] as $index => $brand)
                            <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 0.75rem; display: flex; flex-direction: column; align-items: center; justify-content: space-between; text-align: center; height: 120px; position: relative;">
                                <div style="width: 100%; height: 50px; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden; margin-bottom: 0.5rem;">
                                    <img src="{{ asset($brand['img']) }}" alt="{{ $brand['name'] }}" style="max-width: 90%; max-height: 90%; object-fit: contain; filter: brightness(0) invert(1);">
                                </div>
                                <span style="font-size: 0.8rem; font-weight: 500; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 100%;">{{ $brand['name'] }}</span>
                                
                                <button type="button" 
                                        class="edit-brand-btn"
                                        data-index="{{ $index }}" 
                                        data-name="{{ $brand['name'] }}" 
                                        data-img="{{ asset($brand['img']) }}" 
                                        data-url="{{ route('admin.settings.update_brand', $index) }}"
                                        style="position: absolute; top: 5px; right: 32px; background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.7rem; transition: var(--transition);" 
                                        title="Düzenle">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="{{ route('admin.settings.delete_brand', $index) }}" method="POST" onsubmit="return confirm('Bu markayı referanslardan kaldırmak istediğinizden emin misiniz?');" style="position: absolute; top: 5px; right: 5px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.7rem; transition: var(--transition);">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Henüz bir referans marka eklenmemiş.</p>
                @endif
            </div>

            <!-- Add Brand Form -->
            <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.5rem;">
                <h4 style="color: var(--primary); margin-bottom: 1.25rem; font-size: 1.05rem;">Yeni Referans Ekle</h4>
                
                <form action="{{ route('admin.settings.add_brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="brand_name">Marka Adı</label>
                        <input type="text" class="form-control" name="brand_name" id="brand_name" required placeholder="Örn: Gucci">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="brand_logo">Marka Logosu</label>
                        <input type="file" class="form-control" name="brand_logo" id="brand_logo" required accept="image/*">
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Şeffaf arka planlı PNG, SVG veya WEBP formatı önerilir.</small>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-plus"></i> Referans Markayı Ekle
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<!-- Edit Brand Modal -->
<div id="editBrandModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 2rem;">
    <div style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-lg); width: 100%; max-width: 450px; padding: 2rem; position: relative; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.55);">
        <button onclick="closeEditModal()" style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1.2rem; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="fas fa-times"></i>
        </button>
        <h4 style="color: var(--primary); font-size: 1.25rem; margin-bottom: 1.5rem; font-family: var(--font-display);"><i class="fas fa-edit"></i> Referansı Düzenle</h4>
        
        <form id="editBrandForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Marka Adı</label>
                <input type="text" class="form-control" name="brand_name" id="edit_brand_name" required style="width: 100%; padding: 0.75rem; background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); color: white;">
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Mevcut Logo</label>
                <div style="height: 60px; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.2); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 0.75rem; border: 1px solid rgba(255,255,255,0.05);">
                    <img id="edit_brand_preview" src="" alt="Mevcut Logo" style="max-height: 80%; object-fit: contain; filter: brightness(0) invert(1);">
                </div>
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Yeni Logo (Opsiyonel)</label>
                <input type="file" class="form-control" name="brand_logo" accept="image/*" style="width: 100%; padding: 0.5rem; background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); color: white;">
                <small style="color: var(--text-muted); display: block; margin-top: 0.25rem; font-size: 0.75rem;">Logo değiştirmek istemiyorsanız boş bırakın.</small>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary" style="flex: 1; justify-content: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 0.75rem; border-radius: var(--radius-md); cursor: pointer;">İptal</button>
                <button type="submit" class="btn btn-primary" style="flex: 2; justify-content: center; padding: 0.75rem; border-radius: var(--radius-md);">Değişiklikleri Kaydet</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditModal() {
        document.getElementById('editBrandModal').style.display = 'none';
    }

    function switchSettingTab(event, tabId) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.setting-tab-pane').forEach(pane => pane.classList.remove('active'));
        
        if (event && event.currentTarget) {
            event.currentTarget.classList.add('active');
        } else {
            const btn = document.querySelector(`.tab-btn[onclick*="${tabId}"]`);
            if (btn) btn.classList.add('active');
        }
        const pane = document.getElementById(tabId);
        if (pane) pane.classList.add('active');
        if (history.replaceState) {
            history.replaceState(null, null, '#' + tabId);
        } else {
            window.location.hash = tabId;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        let hash = window.location.hash ? window.location.hash.replace('#', '') : '';
        if (hash && document.getElementById(hash)) {
            switchSettingTab(null, hash);
        }
    });


    // Instant Image Preview Script
    document.addEventListener('DOMContentLoaded', function() {
        // Bind edit brand buttons using data attributes (avoids string escape syntax errors)
        const editButtons = document.querySelectorAll('.edit-brand-btn');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                const name = this.getAttribute('data-name');
                const imgUrl = this.getAttribute('data-img');
                const updateUrl = this.getAttribute('data-url');

                const modal = document.getElementById('editBrandModal');
                const nameInput = document.getElementById('edit_brand_name');
                const previewImg = document.getElementById('edit_brand_preview');
                const form = document.getElementById('editBrandForm');

                nameInput.value = name;
                previewImg.src = imgUrl;
                form.action = updateUrl;

                modal.style.display = 'flex';
            });
        });

        const fileInputs = document.querySelectorAll('input[type="file"][accept^="image"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Find the nearest img preview element
                        let container = input.closest('.img-preview-container');
                        if (container) {
                            let img = container.querySelector('.img-preview');
                            if (img) {
                                img.src = e.target.result;
                            }
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
</script>
@endsection
