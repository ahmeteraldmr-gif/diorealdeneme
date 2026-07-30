@extends('admin.layouts.app')

@section('title', 'Ürün ve Paketleri Yönet')
@section('page_title', 'Ürünler & Paketler')
@section('page_subtitle', 'Web sitesindeki ürünleri, deneyim paketlerini ve fiyatlarını buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
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
                                <img src="{{ asset($p->image) }}" alt="" style="width: 60px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(0,0,0,0.1);">
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
