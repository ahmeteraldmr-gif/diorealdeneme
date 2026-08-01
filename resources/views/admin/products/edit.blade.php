@extends('admin.layouts.app')

@section('title', 'Ürünü Düzenle')
@section('page_title', 'Ürünü Düzenle')
@section('page_subtitle', 'Mevcut ürünü, fiyatını ve açıklamasını güncelleyin.')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-edit"></i> Ürün Bilgileri</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> İptal & Geri Dön
                </a>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Ürün Adı (TR) <span style="color:red;">*</span></label>
                    <input type="text" name="name[tr]" class="form-control" required value="{{ $product->name['tr'] ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Ürün Adı (EN)</label>
                    <input type="text" name="name[en]" class="form-control" value="{{ $product->name['en'] ?? '' }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kategori <span style="color:red;">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Kategori Seçin --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name['tr'] ?? $cat->slug }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Fiyat (₺) <span style="color:red;">*</span></label>
                    <input type="number" step="0.01" name="price" class="form-control" required value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Etiket (TR)</label>
                    <input type="text" name="tag[tr]" class="form-control" value="{{ $product->tag['tr'] ?? '' }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kısa Açıklama (TR) <span style="color:red;">*</span></label>
                    <textarea name="desc[tr]" class="form-control" rows="3" required>{{ $product->desc['tr'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Kısa Açıklama (EN)</label>
                    <textarea name="desc[en]" class="form-control" rows="3">{{ $product->desc['en'] ?? '' }}</textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Detay / İçerik Özeti (TR)</label>
                    <input type="text" name="details[tr]" class="form-control" value="{{ $product->details['tr'] ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Detay / İçerik Özeti (EN)</label>
                    <input type="text" name="details[en]" class="form-control" value="{{ $product->details['en'] ?? '' }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">1. Ana Görsel Yükle (Mevcut: {{ $product->image }})</label>
                    <input type="file" name="image_file" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">Veya 1. Görsel URL / Yolu</label>
                    <input type="text" name="image_url" class="form-control" value="{{ $product->image }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">2. Görsel (Hover / İkinci Görsel) Yükle {{ $product->image_hover ? '(Mevcut: ' . $product->image_hover . ')' : '' }}</label>
                    <input type="file" name="image_hover_file" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">Veya 2. Görsel URL / Yolu</label>
                    <input type="text" name="image_hover_url" class="form-control" value="{{ $product->image_hover }}">
                </div>
            </div>


            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Sıralama</label>
                    <input type="number" name="order" class="form-control" value="{{ $product->order }}">
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.8rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} style="width: 20px; height: 20px;">
                    <label for="is_active" class="form-label" style="margin: 0; cursor: pointer;">Ürün Aktif Olsun</label>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 0.9rem 2.5rem;">
                    <i class="fas fa-save"></i> Değişiklikleri Kaydet
                </button>
            </div>
        </div>
    </form>
@endsection
