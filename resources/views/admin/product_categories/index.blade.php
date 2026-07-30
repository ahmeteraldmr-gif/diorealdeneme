@extends('admin.layouts.app')

@section('title', 'Ürün Kategorilerini Yönet')
@section('page_title', 'Ürün Kategorileri')
@section('page_subtitle', 'Ürünler ve paketler için kategorileri buradan ekleyebilir, düzenleyebilir ve silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-tags"></i> Tüm Kategoriler</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Kategori Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Sıra</th>
                        <th>Kategori Adı (TR / EN)</th>
                        <th>Slug</th>
                        <th>Ürün Sayısı</th>
                        <th>Durum</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $c)
                        <tr>
                            <td><strong>{{ $c->order }}</strong></td>
                            <td>
                                <div><strong>TR:</strong> {{ $c->name['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $c->name['en'] ?? '' }}</div>
                            </td>
                            <td><code>{{ $c->slug }}</code></td>
                            <td><span class="badge badge-primary">{{ $c->products_count }} Ürün</span></td>
                            <td>
                                @if($c->is_active)
                                    <span class="badge" style="background:#4caf50; color:#fff;">Aktif</span>
                                @else
                                    <span class="badge" style="background:#f44336; color:#fff;">Pasif</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.categories.edit', $c->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                                Henüz hiç kategori bulunmuyor. Yeni Kategori Ekle butonunu kullanarak başlayabilirsiniz.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
