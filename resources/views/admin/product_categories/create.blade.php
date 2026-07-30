@extends('admin.layouts.app')

@section('title', 'Yeni Kategori Ekle')
@section('page_title', 'Yeni Ürün Kategorisi')
@section('page_subtitle', 'Yeni ürün ve deneyim kategorisi oluşturun.')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-plus-circle"></i> Kategori Bilgileri</h3>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> İptal & Geri Dön
                </a>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Kategori Adı (TR) <span style="color:red;">*</span></label>
                    <input type="text" name="name[tr]" class="form-control" required placeholder="Örn: Konaklama Paketleri">
                </div>

                <div class="form-group">
                    <label class="form-label">Kategori Adı (EN)</label>
                    <input type="text" name="name[en]" class="form-control" placeholder="Örn: Luxury Stays">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                <div class="form-group">
                    <label class="form-label">Slug (Opsiyonel - Özel URL)</label>
                    <input type="text" name="slug" class="form-control" placeholder="Örn: konaklama-paketleri">
                </div>

                <div class="form-group">
                    <label class="form-label">Sıralama</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.8rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked style="width: 20px; height: 20px;">
                    <label for="is_active" class="form-label" style="margin: 0; cursor: pointer;">Kategori Aktif Olsun</label>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 0.9rem 2.5rem;">
                    <i class="fas fa-save"></i> Kategoriyi Kaydet
                </button>
            </div>
        </div>
    </form>
@endsection
