<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;
use App\Models\Destination;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;

echo "=== TESTING ADMIN STORE METHODS FOR ALL MODELS ===\n\n";

$tests = [
    'Hotel' => function() {
        return Hotel::create([
            'name' => ['tr' => 'Test Otel TR', 'en' => 'Test Hotel EN'],
            'tag' => ['tr' => 'Lüks', 'en' => 'Luxury'],
            'location' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'long_desc' => ['tr' => 'Uzun açıklama TR', 'en' => 'Long desc EN'],
            'img' => 'foto.img/otel_hero.jpg',
            'order' => 999,
            'slug_tr' => 'test-otel-tr-' . time(),
            'slug_en' => 'test-hotel-en-' . time(),
            'seo_title_tr' => 'Test Otel SEO TR',
            'seo_title_en' => 'Test Hotel SEO EN',
            'seo_description_tr' => 'Test Otel SEO Desc TR',
            'seo_description_en' => 'Test Hotel SEO Desc EN',
        ]);
    },
    'Restaurant' => function() {
        return Restaurant::create([
            'name' => ['tr' => 'Test Restoran TR', 'en' => 'Test Restaurant EN'],
            'tag' => ['tr' => 'Fine Dining', 'en' => 'Fine Dining'],
            'location' => ['tr' => 'İstanbul', 'en' => 'Istanbul'],
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'long_desc' => ['tr' => 'Uzun açıklama TR', 'en' => 'Long desc EN'],
            'img' => 'foto.img/rest_hero.jpg',
            'order' => 999,
            'slug_tr' => 'test-restoran-tr-' . time(),
            'slug_en' => 'test-restaurant-en-' . time(),
            'seo_title_tr' => 'Test Restoran SEO TR',
            'seo_title_en' => 'Test Restaurant SEO EN',
            'seo_description_tr' => 'Test Restoran SEO Desc TR',
            'seo_description_en' => 'Test Restaurant SEO Desc EN',
        ]);
    },
    'Yacht' => function() {
        return Yacht::create([
            'name' => ['tr' => 'Test Yat TR', 'en' => 'Test Yacht EN'],
            'tag' => ['tr' => 'Mega Yat', 'en' => 'Mega Yacht'],
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'long_desc' => ['tr' => 'Uzun açıklama TR', 'en' => 'Long desc EN'],
            'img' => 'foto.img/yat_manzara.jpg',
            'order' => 999,
            'slug_tr' => 'test-yat-tr-' . time(),
            'slug_en' => 'test-yacht-en-' . time(),
            'seo_title_tr' => 'Test Yat SEO TR',
            'seo_title_en' => 'Test Yacht SEO EN',
            'seo_description_tr' => 'Test Yat SEO Desc TR',
            'seo_description_en' => 'Test Yacht SEO Desc EN',
        ]);
    },
    'Guide' => function() {
        return Guide::create([
            'title' => ['tr' => 'Test Rehber TR', 'en' => 'Test Guide EN'],
            'tag' => ['tr' => 'Gezi', 'en' => 'Travel'],
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'content' => ['tr' => 'İçerik TR', 'en' => 'Content EN'],
            'img' => 'foto.img/kapadokya.jpg',
            'read_time' => '5 dk',
            'order' => 999,
            'slug_tr' => 'test-rehber-tr-' . time(),
            'slug_en' => 'test-guide-en-' . time(),
            'seo_title_tr' => 'Test Rehber SEO TR',
            'seo_title_en' => 'Test Guide SEO EN',
            'seo_description_tr' => 'Test Rehber SEO Desc TR',
            'seo_description_en' => 'Test Guide SEO Desc EN',
        ]);
    },
    'Event' => function() {
        return Event::create([
            'title' => ['tr' => 'Test Etkinlik TR', 'en' => 'Test Event EN'],
            'tag' => ['tr' => 'Konser', 'en' => 'Concert'],
            'day' => '15',
            'month' => ['tr' => 'AĞU', 'en' => 'AUG'],
            'year' => '2026',
            'loc' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'img' => 'foto.img/etkinlik_hero.jpg',
            'order' => 999,
            'slug_tr' => 'test-etkinlik-tr-' . time(),
            'slug_en' => 'test-event-en-' . time(),
            'seo_title_tr' => 'Test Etkinlik SEO TR',
            'seo_title_en' => 'Test Event SEO EN',
            'seo_description_tr' => 'Test Etkinlik SEO Desc TR',
            'seo_description_en' => 'Test Event SEO Desc EN',
        ]);
    },
    'Journal' => function() {
        return Journal::create([
            'title' => ['tr' => 'Test Journal TR', 'en' => 'Test Journal EN'],
            'tag' => ['tr' => 'Editoryal', 'en' => 'Editorial'],
            'date' => '14 Ağustos 2026',
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'content' => ['tr' => 'İçerik TR', 'en' => 'Content EN'],
            'img' => 'foto.img/amalfi.jpg',
            'order' => 999,
            'slug_tr' => 'test-journal-tr-' . time(),
            'slug_en' => 'test-journal-en-' . time(),
            'seo_title_tr' => 'Test Journal SEO TR',
            'seo_title_en' => 'Test Journal SEO EN',
            'seo_description_tr' => 'Test Journal SEO Desc TR',
            'seo_description_en' => 'Test Journal SEO Desc EN',
        ]);
    },
    'Destination' => function() {
        return Destination::create([
            'name' => ['tr' => 'Test Destinasyon TR', 'en' => 'Test Destination EN'],
            'region' => ['tr' => 'Ege', 'en' => 'Aegean'],
            'type' => 'turkiye',
            'img' => 'foto.img/bodrum.jpg',
            'order' => 999,
            'slug_tr' => 'test-dest-tr-' . time(),
            'slug_en' => 'test-dest-en-' . time(),
            'seo_title_tr' => 'Test Dest SEO TR',
            'seo_title_en' => 'Test Dest SEO EN',
            'seo_description_tr' => 'Test Dest SEO Desc TR',
            'seo_description_en' => 'Test Dest SEO Desc EN',
        ]);
    },
    'ProductCategory' => function() {
        return ProductCategory::create([
            'name' => ['tr' => 'Test Kategori TR', 'en' => 'Test Category EN'],
            'slug' => 'test-kategori-' . time(),
            'order' => 999,
            'is_active' => true,
        ]);
    },
    'Product' => function() {
        return Product::create([
            'name' => ['tr' => 'Test Ürün TR', 'en' => 'Test Product EN'],
            'price' => 1500,
            'stock' => 10,
            'desc' => ['tr' => 'Test açıklama TR', 'en' => 'Test desc EN'],
            'image' => 'foto.img/hero_4k.jpg',
            'is_active' => true,
        ]);
    },
];

$passed = 0;
$failed = 0;

foreach ($tests as $modelName => $closure) {
    try {
        $item = $closure();
        echo "[OK] Model {$modelName} created successfully (ID: {$item->id})\n";
        $item->delete(); // Clean up test record
        $passed++;
    } catch (\Throwable $e) {
        echo "[ERROR] Model {$modelName} creation failed: " . $e->getMessage() . "\n";
        $failed++;
    }
}

echo "\nSummary: {$passed} models PASSED, {$failed} models FAILED.\n";
