<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\YachtController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;

echo "=== TESTING CONTROLLER STORE HTTP REQUESTS ===\n\n";
$t = time() . '_' . rand(100, 999);

$controllersToTest = [
    'HotelController@store' => function() use ($t) {
        $c = new HotelController();
        $req = Request::create('/admin/hotels', 'POST', [
            'name' => ['tr' => 'Test Hotel Controller ' . $t, 'en' => 'Test Hotel Controller EN ' . $t],
            'tag' => ['tr' => 'Lüks', 'en' => 'Luxury'],
            'location' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
            'order' => 1,
        ]);
        return $c->store($req);
    },
    'RestaurantController@store' => function() use ($t) {
        $c = new RestaurantController();
        $req = Request::create('/admin/restaurants', 'POST', [
            'name' => ['tr' => 'Test Restoran Controller ' . $t, 'en' => 'Test Restoran Controller EN ' . $t],
            'tag' => ['tr' => 'Gourmet', 'en' => 'Gourmet'],
            'location' => ['tr' => 'İstanbul', 'en' => 'Istanbul'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
            'order' => 1,
        ]);
        return $c->store($req);
    },
    'YachtController@store' => function() use ($t) {
        $c = new YachtController();
        $req = Request::create('/admin/yachts', 'POST', [
            'name' => ['tr' => 'Test Yacht Controller ' . $t, 'en' => 'Test Yacht Controller EN ' . $t],
            'tag' => ['tr' => 'Süper Yat', 'en' => 'Super Yacht'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
        ]);
        return $c->store($req);
    },
    'GuideController@store' => function() use ($t) {
        $c = new GuideController();
        $req = Request::create('/admin/guides', 'POST', [
            'title' => ['tr' => 'Test Rehber Controller ' . $t, 'en' => 'Test Guide Controller EN ' . $t],
            'tag' => ['tr' => 'Rehber', 'en' => 'Guide'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
        ]);
        return $c->store($req);
    },
    'EventController@store' => function() use ($t) {
        $c = new EventController();
        $req = Request::create('/admin/events', 'POST', [
            'title' => ['tr' => 'Test Etkinlik Controller ' . $t, 'en' => 'Test Event Controller EN ' . $t],
            'day' => '20',
            'month' => ['tr' => 'AĞU', 'en' => 'AUG'],
            'loc' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
        ]);
        return $c->store($req);
    },
    'JournalController@store' => function() use ($t) {
        $c = new JournalController();
        $req = Request::create('/admin/journals', 'POST', [
            'title' => ['tr' => 'Test Journal Controller ' . $t, 'en' => 'Test Journal Controller EN ' . $t],
            'tag' => ['tr' => 'Haber', 'en' => 'News'],
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
            'date' => '14 Ağustos 2026',
        ]);
        return $c->store($req);
    },
    'DestinationController@store' => function() use ($t) {
        $c = new DestinationController();
        $req = Request::create('/admin/destinations', 'POST', [
            'name' => ['tr' => 'Test Destinasyon Controller ' . $t, 'en' => 'Test Destination Controller EN ' . $t],
            'region' => ['tr' => 'Ege', 'en' => 'Aegean'],
            'type' => 'turkiye',
        ]);
        return $c->store($req);
    },
    'ProductCategoryController@store' => function() use ($t) {
        $c = new ProductCategoryController();
        $req = Request::create('/admin/categories', 'POST', [
            'name' => ['tr' => 'Test Kategori Controller ' . $t, 'en' => 'Test Category Controller EN ' . $t],
            'slug' => 'test-cat-ctrl-' . $t,
        ]);
        return $c->store($req);
    },
    'ProductController@store' => function() use ($t) {
        $c = new ProductController();
        $req = Request::create('/admin/products', 'POST', [
            'name' => ['tr' => 'Test Ürün Controller ' . $t, 'en' => 'Test Product Controller EN ' . $t],
            'price' => 2000,
            'desc' => ['tr' => 'Açıklama TR', 'en' => 'Desc EN'],
        ]);
        return $c->store($req);
    },
];

$passed = 0;
$failed = 0;

foreach ($controllersToTest as $action => $closure) {
    try {
        $response = $closure();
        echo "[OK] Controller action {$action} returned status code " . $response->getStatusCode() . " (Redirected)\n";
        $passed++;
    } catch (\Throwable $e) {
        echo "[ERROR] Controller action {$action} failed: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
        $failed++;
    }
}

echo "\nSummary: {$passed} controller store actions PASSED, {$failed} FAILED.\n";
