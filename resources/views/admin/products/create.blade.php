@extends('admin.layouts.app')

@section('title', 'Yeni Ürün Ekle')
@section('page_title', 'Yeni Ürün / Paket Ekle')
@section('page_subtitle', 'Yeni ürün veya ayrıcalıklı seyahat paketi tanımlayın.')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-plus-circle"></i> Ürün Bilgileri</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> İptal & Geri Dön
                </a>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ürün Adı (TR) <span style="color:red;">*</span></label>
                    <input type="text" name="name[tr]" class="form-control" required placeholder="Örn: Bodrum Villa Konaklama Paketi">
                </div>

                <div class="form-group">
                    <label class="form-label">Ürün Adı (EN)</label>
                    <input type="text" name="name[en]" class="form-control" placeholder="Örn: Bodrum Luxury Villa Package">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kategori <span style="color:red;">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Kategori Seçin --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name['tr'] ?? $cat->slug }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Fiyat (₺) <span style="color:red;">*</span></label>
                    <input type="number" step="0.01" name="price" class="form-control" required placeholder="Örn: 85000">
                </div>

                <div class="form-group">
                    <label class="form-label">Etiket (TR / EN - Örn: VIP Concierge)</label>
                    <input type="text" name="tag[tr]" class="form-control" placeholder="Etiket TR">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kısa Açıklama (TR) <span style="color:red;">*</span></label>
                    <textarea name="desc[tr]" class="form-control" rows="3" required placeholder="Ürünün kısa açıklaması..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Kısa Açıklama (EN)</label>
                    <textarea name="desc[en]" class="form-control" rows="3" placeholder="Short description in English..."></textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Detay / İçerik Özeti (TR - Örn: 3 Gece • Özel Havuzlu)</label>
                    <input type="text" name="details[tr]" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Detay / İçerik Özeti (EN)</label>
                    <input type="text" name="details[en]" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">1. Ürün Ana Görseli Yükle</label>
                    <input type="file" name="image_file" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">Veya 1. Görsel URL / Yolu</label>
                    <input type="text" name="image_url" class="form-control" placeholder="foto.img/hero_4k.jpg">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">2. Görsel (Hover / İkinci Görsel) Yükle</label>
                    <input type="file" name="image_hover_file" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">Veya 2. Görsel URL / Yolu</label>
                    <input type="text" name="image_hover_url" class="form-control" placeholder="foto.img/hero_slide_2.jpg">
                </div>
            </div>


            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sıralama</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.8rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked style="width: 20px; height: 20px;">
                    <label for="is_active" class="form-label" style="margin: 0; cursor: pointer;">Ürün Aktif Olsun</label>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 0.9rem 2.5rem;">
                    <i class="fas fa-save"></i> Ürünü Kaydet
                </button>
            </div>
        </div>
    </form>
@endsection
