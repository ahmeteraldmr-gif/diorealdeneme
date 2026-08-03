@extends('admin.layouts.app')

@section('title', 'Ürün ve Paketleri Yönet')
@section('page_title', 'Ürünler & Paketler')
@section('page_subtitle', 'Web sitesindeki ürünleri, deneyim paketlerini ve fiyatlarını buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <!-- 🖼️ ÜRÜNLER SAYFASI VİTRİN SLIDER GÖRSELLERİ & YAZILARI YÖNETİMİ -->
    <div class="panel-card" id="showcase-banner-settings" style="margin-bottom: 2rem; border: 1px solid var(--primary); background: rgba(200, 169, 110, 0.04);">
        <div class="panel-card-header" style="cursor: pointer;" onclick="var el = document.getElementById('showcaseBannerFormBody'); el.style.display = el.style.display === 'none' ? 'block' : 'none';">
            <div>
                <h3 class="panel-card-title" style="color: var(--primary); font-size: 1.15rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-images"></i> 🖼️ Ürünler Sayfası Dönen Vitrin Banner Slider Görselleri & Metinleri
                </h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.3rem; margin-bottom: 0;">
                    Ürünler sayfasının en üstündeki dönen 3'lü büyük vitrin slide görsellerini, başlıklarını ve butonlarını buradan güncelleyebilir, yeni görsel yükleyebilir veya istediğinizi pasife alabilirsiniz.
                </p>
            </div>
            <button type="button" class="btn btn-outline btn-sm">
                <i class="fas fa-edit"></i> Görselleri Yönet
            </button>
        </div>

        <div id="showcaseBannerFormBody" style="padding: 1.5rem; border-top: 1px solid var(--border-color);">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- SLIDE 1 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.2rem; border-radius: var(--radius-md); margin-bottom: 1.2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h5 style="color: var(--primary); font-size: 1rem; margin:0;"><i class="fas fa-image"></i> Vitrin Slide 1</h5>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); margin:0;">Slide Durumu:</label>
                            <select name="ecom_slide1_status" class="form-control" style="width: auto; padding: 0.3rem 0.8rem; font-size: 0.85rem;">
                                <option value="1" {{ ($settings['ecom_slide1_status'] ?? '1') == '1' ? 'selected' : '' }}>🟢 Aktif (Sitede Göster)</option>
                                <option value="0" {{ ($settings['ecom_slide1_status'] ?? '1') == '0' ? 'selected' : '' }}>🔴 Pasif (Siteden Çıkart / Gizle)</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide1_eye_tr" value="{{ $settings['ecom_slide1_eye_tr'] ?? 'PORSELEN & ÇATAL BIÇAK KOLEKSİYONU' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (EN)</label>
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
                            <label class="form-label">Slide 1 Arka Plan Görseli Yükle</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide1_img'] ?? 'foto.img/hero_4k.jpg') }}" alt="Slide 1 Image" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <input type="file" name="ecom_slide1_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.2rem; border-radius: var(--radius-md); margin-bottom: 1.2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h5 style="color: var(--primary); font-size: 1rem; margin:0;"><i class="fas fa-image"></i> Vitrin Slide 2</h5>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); margin:0;">Slide Durumu:</label>
                            <select name="ecom_slide2_status" class="form-control" style="width: auto; padding: 0.3rem 0.8rem; font-size: 0.85rem;">
                                <option value="1" {{ ($settings['ecom_slide2_status'] ?? '1') == '1' ? 'selected' : '' }}>🟢 Aktif (Sitede Göster)</option>
                                <option value="0" {{ ($settings['ecom_slide2_status'] ?? '1') == '0' ? 'selected' : '' }}>🔴 Pasif (Siteden Çıkart / Gizle)</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide2_eye_tr" value="{{ $settings['ecom_slide2_eye_tr'] ?? 'EV & LÜKS DEKORASYON' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (EN)</label>
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
                            <label class="form-label">Slide 2 Arka Plan Görseli Yükle</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide2_img'] ?? 'foto.img/otel_hero.jpg') }}" alt="Slide 2 Image" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <input type="file" name="ecom_slide2_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 1.2rem; border-radius: var(--radius-md); margin-bottom: 1.2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h5 style="color: var(--primary); font-size: 1rem; margin:0;"><i class="fas fa-image"></i> Vitrin Slide 3</h5>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); margin:0;">Slide Durumu:</label>
                            <select name="ecom_slide3_status" class="form-control" style="width: auto; padding: 0.3rem 0.8rem; font-size: 0.85rem;">
                                <option value="1" {{ ($settings['ecom_slide3_status'] ?? '1') == '1' ? 'selected' : '' }}>🟢 Aktif (Sitede Göster)</option>
                                <option value="0" {{ ($settings['ecom_slide3_status'] ?? '1') == '0' ? 'selected' : '' }}>🔴 Pasif (Siteden Çıkart / Gizle)</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                        <div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (TR)</label>
                                    <input type="text" class="form-control" name="ecom_slide3_eye_tr" value="{{ $settings['ecom_slide3_eye_tr'] ?? 'VIP SEYAHAT & KONAKLAMA' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Üst Etiket (EN)</label>
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
                            <label class="form-label">Slide 3 Arka Plan Görseli Yükle</label>
                            <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0; flex-direction: column; align-items: flex-start; justify-content: center;">
                                <img class="img-preview" src="{{ asset($settings['ecom_slide3_img'] ?? 'foto.img/bodrum.jpg') }}" alt="Slide 3 Image" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                <input type="file" name="ecom_slide3_img" accept="image/*" style="margin-top: 0.8rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem; font-weight: 600;">
                        <i class="fas fa-save"></i> Banner Görsellerini & Metinlerini Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel-card">

        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-box-open"></i> Tüm Ürünler & Paketler</h3>
            <div style="display: flex; gap: 0.8rem;">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                    <i class="fas fa-tags"></i> Kategorileri Yönet
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Ürün Ekle
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Görsel</th>
                        <th>Ürün Adı (TR / EN)</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>Durum</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td>
                                <div style="display: flex; gap: 4px;">
                                    <img src="{{ dioreal_img($p->image, 'foto.img/hero_4k.jpg') }}" alt="1. Ana Görsel" title="1. Ana Görsel" style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(0,0,0,0.1);" onerror="this.onerror=null;this.src='{{ asset('foto.img/hero_4k.jpg') }}';">
                                    @if($p->image_hover)
                                        <img src="{{ dioreal_img($p->image_hover, 'foto.img/hero_slide_2.jpg') }}" alt="2. Hover Görseli" title="2. Hover Görseli" style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(0,0,0,0.1);" onerror="this.onerror=null;this.src='{{ asset('foto.img/hero_slide_2.jpg') }}';">
                                    @endif
                                </div>
                            </td>


                            <td>
                                <div><strong>TR:</strong> {{ $p->name['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $p->name['en'] ?? '' }}</div>
                            </td>
                            <td>
                                @if($p->category)
                                    <span class="badge badge-primary">{{ $p->category->name['tr'] ?? $p->category->slug }}</span>
                                @else
                                    <span class="badge" style="background:#9e9e9e; color:#fff;">Kategorisiz</span>
                                @endif
                            </td>
                            <td>
                                <strong style="color: #2e7d32; font-size: 1.05rem;">₺{{ number_format($p->price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($p->is_active)
                                    <span class="badge" style="background:#4caf50; color:#fff;">Aktif</span>
                                @else
                                    <span class="badge" style="background:#f44336; color:#fff;">Pasif</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                Henüz hiç ürün eklenmemiş. Yeni Ürün Ekle butonunu kullanarak başlayabilirsiniz.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
