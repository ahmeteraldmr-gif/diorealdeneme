@extends('admin.layouts.app')

@section('title', 'Kontrol Paneli')

@section('page_title', 'Kontrol Paneli')
@section('page_subtitle', 'Dioreal portal içeriklerinin genel özeti ve istatistikleri.')

@section('content')
    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Oteller</span>
                <div class="stat-card-value">{{ $stats['hotels'] ?? \App\Models\Hotel::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-hotel"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Restoranlar</span>
                <div class="stat-card-value">{{ $stats['restaurants'] ?? \App\Models\Restaurant::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Yatlar</span>
                <div class="stat-card-value">{{ $stats['yachts'] ?? \App\Models\Yacht::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-ship"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Gezi Rehberleri</span>
                <div class="stat-card-value">{{ $stats['guides'] ?? \App\Models\Guide::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Etkinlikler</span>
                <div class="stat-card-value">{{ $stats['events'] ?? \App\Models\Event::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Journal Yazıları</span>
                <div class="stat-card-value">{{ $stats['journals'] ?? \App\Models\Journal::count() }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>

    <!-- Quick Access Section for Page Headers, Covers & Route Planning -->
    <div class="panel-card" style="border: 1px solid rgba(200, 169, 110, 0.3); background: rgba(200, 169, 110, 0.05); margin-top: 2rem;">
        <h3 class="panel-card-title" style="color: var(--primary); font-size: 1.2rem; margin-bottom: 1rem;">
            <i class="fas fa-magic" style="margin-right: 0.5rem;"></i> Hızlı Erişim: Sayfa Kapakları, Güzergah Planlaması & Tanıtım Metinleri
        </h3>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
            İstediğiniz sayfanın başlık, görsel ve buton ayarlarını doğrudan düzenlemek için aşağıdaki hızlı erişim butonlarına tıklayabilirsiniz:
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
            <a href="{{ route('admin.settings.index') }}#tab-pages" class="btn btn-outline" style="text-align: left; display: flex; flex-direction: column; align-items: flex-start; padding: 1.2rem; gap: 0.4rem; height: auto;">
                <strong style="color: var(--white); font-size: 1rem;">🗺️ Güzergah Planlaması & Rota Planlat</strong>
                <span style="font-size: 0.8rem; color: var(--text-muted);">"Her yolculuk size özel...", Rota Planlat butonu & görseller</span>
            </a>

            <a href="{{ route('admin.settings.index') }}#tab-pages" class="btn btn-outline" style="text-align: left; display: flex; flex-direction: column; align-items: flex-start; padding: 1.2rem; gap: 0.4rem; height: auto;">
                <strong style="color: var(--white); font-size: 1rem;">🍽️ Restoranlar & "Yemek Bir Sanattır"</strong>
                <span style="font-size: 0.8rem; color: var(--text-muted);">Üst görsel, tanıtım metinleri & Masaları Keşfet butonu</span>
            </a>

            <a href="{{ route('admin.settings.index') }}#tab-pages" class="btn btn-outline" style="text-align: left; display: flex; flex-direction: column; align-items: flex-start; padding: 1.2rem; gap: 0.4rem; height: auto;">
                <strong style="color: var(--white); font-size: 1rem;">🏨 Oteller Kapak & Tanıtım Metni</strong>
                <span style="font-size: 0.8rem; color: var(--text-muted);">"Her konaklamanın bir hikayesi vardır" & Oteller üst kapak resmi</span>
            </a>

            <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline" style="text-align: left; display: flex; flex-direction: column; align-items: flex-start; padding: 1.2rem; gap: 0.4rem; height: auto;">
                <strong style="color: var(--white); font-size: 1rem;">🏨 01 Reschio vb. Otel Kartları</strong>
                <span style="font-size: 0.8rem; color: var(--text-muted);">Otellerin resimlerini, isimlerini ve açıklamalarını düzenle</span>
            </a>
        </div>
    </div>


    <!-- Recent Items Sections -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem;">
        
        <!-- Recent Hotels -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-hotel" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Oteller</h3>
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Otel Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentHotels ?? \App\Models\Hotel::latest()->take(5)->get() as $hotel)
                            <tr>
                                <td>
                                    <img src="{{ dioreal_img($hotel->img, 'foto.img/otel_hero.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/otel_hero.jpg') }}';" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong>{{ $hotel->name['tr'] ?? '' }}</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $hotel->name['en'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $hotel->tag['tr'] ?? '' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz otel eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Restaurants -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-utensils" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Restoranlar</h3>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Restoran Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRestaurants ?? \App\Models\Restaurant::latest()->take(5)->get() as $restaurant)
                            <tr>
                                <td>
                                    <img src="{{ dioreal_img($restaurant->img, 'foto.img/rest_hero.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('foto.img/rest_hero.jpg') }}';" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong>{{ $restaurant->name['tr'] ?? '' }}</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $restaurant->name['en'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $restaurant->tag['tr'] ?? '' }}</span>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz restoran eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
