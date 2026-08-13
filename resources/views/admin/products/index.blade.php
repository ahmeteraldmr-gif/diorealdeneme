@extends('admin.layouts.app')

@section('title', 'Ürün ve Paketleri Yönet')
@section('page_title', 'Ürünler & Paketler')
@section('page_subtitle', 'Web sitesindeki ürünleri, deneyim paketlerini ve fiyatlarını buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <!-- 🖼️ ÜRÜNLER SAYFASI VİTRİN SLIDER GÖRSELLERİ & YAZILARI YÖNETİMİ -->
    <div class="panel-card" id="showcase-banner-settings" style="margin-bottom: 2rem; border: 1px solid var(--primary); background: rgba(200, 169, 110, 0.04);">
        <div class="panel-card-header" style="flex-wrap: wrap; gap: 1rem;">
            <div>
                <h3 class="panel-card-title" style="color: var(--primary); font-size: 1.15rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-images"></i> 🖼️ Ürünler Sayfası Dönen Vitrin Banner Slider Görselleri & Metinleri
                </h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.3rem; margin-bottom: 0;">
                    Ürünler sayfasının en üstündeki dönen vitrin slide görsellerini buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.
                </p>
            </div>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('addSlideModal').style.display='flex'">
                <i class="fas fa-plus-circle"></i> + Yeni Vitrin Slide Görseli Ekle
            </button>
        </div>

        <div style="padding: 1.5rem; border-top: 1px solid var(--border-color);">
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Görsel</th>
                            <th>Slide Başlığı (TR / EN)</th>
                            <th>Üst Etiket</th>
                            <th>Sıra</th>
                            <th>Durum</th>
                            <th style="width: 180px; text-align: center;">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($showcases ?? collect([]) as $sc)
                            <tr>
                                <td>
                                    <img src="{{ str_starts_with($sc->image, 'http') || str_starts_with($sc->image, 'foto.img') ? asset($sc->image) : dioreal_img($sc->image, 'foto.img/hero_4k.jpg') }}" alt="Slide Image" style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(0,0,0,0.1);">
                                </td>
                                <td>
                                    <div><strong>TR:</strong> {{ $sc->title['tr'] ?? '' }}</div>
                                    <div style="color: var(--text-muted); font-size: 0.85rem;"><strong>EN:</strong> {{ $sc->title['en'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $sc->eye['tr'] ?? '' }}</span>
                                </td>
                                <td><strong>{{ $sc->order }}</strong></td>
                                <td>
                                    @if($sc->is_active)
                                        <span class="badge" style="background:#4caf50; color:#fff;">🟢 Aktif (Gösteriliyor)</span>
                                    @else
                                        <span class="badge" style="background:#f44336; color:#fff;">🔴 Pasif (Gizli)</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                        <button type="button" class="btn btn-outline btn-sm" onclick="openEditSlideModal({{ $sc->id }}, {{ json_encode($sc) }})">
                                            <i class="fas fa-edit"></i> Düzenle
                                        </button>
                                        <form action="{{ route('admin.showcases.destroy', $sc->id) }}" method="POST" onsubmit="return confirm('Bu slide görselini silmek istediğinize emin misiniz?');" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Sil
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">Henüz vitrin slide görseli eklenmedi. Yukarıdaki <strong>"+ Yeni Vitrin Slide Görseli Ekle"</strong> butonuna basarak ekleyebilirsiniz.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ➕ YENİ VİTRİN SLİDE GÖRSELİ EKLE MODALI -->
    <div id="addSlideModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: var(--bg-dark, #1c1a17); border: 1px solid var(--border-color, #333); border-radius: 16px; max-width: 750px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: 0 25px 60px rgba(0,0,0,0.5); color: #fff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                <h4 style="margin: 0; color: var(--primary, #c8a96e); font-size: 1.25rem;"><i class="fas fa-plus-circle"></i> Yeni Vitrin Slide Görseli Ekle</h4>
                <button type="button" onclick="document.getElementById('addSlideModal').style.display='none'" style="background: none; border: none; color: #fff; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>

            <form action="{{ route('admin.showcases.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Üst Etiket (TR)</label>
                        <input type="text" name="eye[tr]" class="form-control" placeholder="Örn: PORSELEN & ÇATAL BIÇAK">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Üst Etiket (EN)</label>
                        <input type="text" name="eye[en]" class="form-control" placeholder="Örn: PORCELAIN & CUTLERY">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Slide Ana Başlık (TR) <span style="color:red;">*</span></label>
                        <input type="text" name="title[tr]" class="form-control" required placeholder="Örn: Royal Altın İşlemeli Yemek Takımı">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slide Ana Başlık (EN)</label>
                        <input type="text" name="title[en]" class="form-control" placeholder="Örn: Royal Gold Dinnerware Set">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Açıklama Metni (TR)</label>
                        <textarea name="text[tr]" class="form-control" rows="2" placeholder="Slide üzerindeki kısa açıklama..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Açıklama Metni (EN)</label>
                        <textarea name="text[en]" class="form-control" rows="2" placeholder="Short description in English..."></textarea>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Buton Yazısı (TR)</label>
                        <input type="text" name="btn_text[tr]" class="form-control" value="Koleksiyonu İncele">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Buton Yazısı (EN)</label>
                        <input type="text" name="btn_text[en]" class="form-control" value="Explore Collection">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Slide Görseli Yükle <span style="color:red;">*</span></label>
                        <input type="file" name="image" class="form-control" required accept="image/*">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sıra No & Durum</label>
                        <div style="display: flex; gap: 0.8rem;">
                            <input type="number" name="order" class="form-control" value="1" style="width: 80px;" title="Sıralama numarası">
                            <select name="is_active" class="form-control">
                                <option value="1">🟢 Aktif (Göster)</option>
                                <option value="0">🔴 Pasif (Gizle)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 1.5rem;">
                    <button type="button" onclick="document.getElementById('addSlideModal').style.display='none'" class="btn btn-outline" style="margin-right: 0.5rem;">İptal</button>
                    <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">
                        <i class="fas fa-upload"></i> Yeni Slide Görselini Yükle & Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ✏️ VİTRİN SLİDE DÜZENLE MODALI -->
    <div id="editSlideModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: var(--bg-dark, #1c1a17); border: 1px solid var(--border-color, #333); border-radius: 16px; max-width: 750px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: 0 25px 60px rgba(0,0,0,0.5); color: #fff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                <h4 style="margin: 0; color: var(--primary, #c8a96e); font-size: 1.25rem;"><i class="fas fa-edit"></i> Vitrin Slide Görselini Düzenle</h4>
                <button type="button" onclick="document.getElementById('editSlideModal').style.display='none'" style="background: none; border: none; color: #fff; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>

            <form id="editSlideForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Üst Etiket (TR)</label>
                        <input type="text" id="edit_eye_tr" name="eye[tr]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Üst Etiket (EN)</label>
                        <input type="text" id="edit_eye_en" name="eye[en]" class="form-control">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Slide Ana Başlık (TR)</label>
                        <input type="text" id="edit_title_tr" name="title[tr]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slide Ana Başlık (EN)</label>
                        <input type="text" id="edit_title_en" name="title[en]" class="form-control">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Açıklama Metni (TR)</label>
                        <textarea id="edit_text_tr" name="text[tr]" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Açıklama Metni (EN)</label>
                        <textarea id="edit_text_en" name="text[en]" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Buton Yazısı (TR)</label>
                        <input type="text" id="edit_btn_tr" name="btn_text[tr]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Buton Yazısı (EN)</label>
                        <input type="text" id="edit_btn_en" name="btn_text[en]" class="form-control">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Yeni Görsel Yükle (İsteğe Bağlı)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sıra No & Durum</label>
                        <div style="display: flex; gap: 0.8rem;">
                            <input type="number" id="edit_order" name="order" class="form-control" style="width: 80px;">
                            <select id="edit_is_active" name="is_active" class="form-control">
                                <option value="1">🟢 Aktif (Göster)</option>
                                <option value="0">🔴 Pasif (Gizle)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 1.5rem;">
                    <button type="button" onclick="document.getElementById('editSlideModal').style.display='none'" class="btn btn-outline" style="margin-right: 0.5rem;">İptal</button>
                    <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">
                        <i class="fas fa-save"></i> Değişiklikleri Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditSlideModal(id, data) {
            var form = document.getElementById('editSlideForm');
            form.action = '{{ url("admin/showcases") }}/' + id;
            document.getElementById('edit_eye_tr').value = (data.eye && data.eye.tr) ? data.eye.tr : '';
            document.getElementById('edit_eye_en').value = (data.eye && data.eye.en) ? data.eye.en : '';
            document.getElementById('edit_title_tr').value = (data.title && data.title.tr) ? data.title.tr : '';
            document.getElementById('edit_title_en').value = (data.title && data.title.en) ? data.title.en : '';
            document.getElementById('edit_text_tr').value = (data.text && data.text.tr) ? data.text.tr : '';
            document.getElementById('edit_text_en').value = (data.text && data.text.en) ? data.text.en : '';
            document.getElementById('edit_btn_tr').value = (data.btn_text && data.btn_text.tr) ? data.btn_text.tr : '';
            document.getElementById('edit_btn_en').value = (data.btn_text && data.btn_text.en) ? data.btn_text.en : '';
            document.getElementById('edit_order').value = data.order || 1;
            document.getElementById('edit_is_active').value = data.is_active ? 1 : 0;
            document.getElementById('editSlideModal').style.display = 'flex';
        }
    </script>
m 2rem; font-weight: 600;">
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
