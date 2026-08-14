<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Destination;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Journal;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\User;
use App\Models\Yacht;

echo "=== DIOREAL ADMIN PANEL VIEW AUDIT TEST ===\n\n";

$dummyHotel = Hotel::first() ?? new Hotel();
$dummyRestaurant = Restaurant::first() ?? new Restaurant();
$dummyYacht = Yacht::first() ?? new Yacht();
$dummyGuide = Guide::first() ?? new Guide();
$dummyEvent = Event::first() ?? new Event();
$dummyJournal = Journal::first() ?? new Journal();
$dummyDestination = Destination::first() ?? new Destination();
$dummyProduct = Product::first() ?? new Product();
$dummyCategory = ProductCategory::first() ?? new ProductCategory();
$dummyUser = User::first() ?? new User();

$viewsToTest = [
    'admin.dashboard' => [],
    'admin.hotels.index' => ['hotels' => Hotel::paginate(10)],
    'admin.hotels.create' => [],
    'admin.hotels.edit' => ['hotel' => $dummyHotel],
    'admin.restaurants.index' => ['restaurants' => Restaurant::paginate(10)],
    'admin.restaurants.create' => [],
    'admin.restaurants.edit' => ['restaurant' => $dummyRestaurant],
    'admin.yachts.index' => ['yachts' => Yacht::paginate(10)],
    'admin.yachts.create' => [],
    'admin.yachts.edit' => ['yacht' => $dummyYacht],
    'admin.guides.index' => ['guides' => Guide::paginate(10)],
    'admin.guides.create' => [],
    'admin.guides.edit' => ['guide' => $dummyGuide],
    'admin.events.index' => ['events' => Event::paginate(10)],
    'admin.events.create' => [],
    'admin.events.edit' => ['event' => $dummyEvent],
    'admin.journals.index' => ['journals' => Journal::paginate(10)],
    'admin.journals.create' => ['destinations' => Destination::all()],
    'admin.journals.edit' => ['journal' => $dummyJournal, 'destinations' => Destination::all()],
    'admin.destinations.index' => ['destinations' => Destination::paginate(10)],
    'admin.destinations.create' => ['types' => ['turkiye' => 'Türkiye', 'yurtdisi_popular' => 'Yurtdışı Popüler']],
    'admin.destinations.edit' => ['destination' => $dummyDestination, 'types' => ['turkiye' => 'Türkiye', 'yurtdisi_popular' => 'Yurtdışı Popüler']],
    'admin.products.index' => ['products' => Product::paginate(10), 'categories' => ProductCategory::all(), 'showcases' => collect([])],
    'admin.products.create' => ['categories' => ProductCategory::all()],
    'admin.products.edit' => ['product' => $dummyProduct, 'categories' => ProductCategory::all()],
    'admin.product_categories.index' => ['categories' => ProductCategory::all()],
    'admin.product_categories.create' => [],
    'admin.product_categories.edit' => ['category' => $dummyCategory],
    'admin.users.index' => ['users' => User::paginate(10)],
    'admin.users.create' => ['permissionsList' => []],
    'admin.users.edit' => ['user' => $dummyUser, 'permissionsList' => []],
    'admin.settings' => ['settings' => Setting::all()->pluck('val', 'key')->toArray()],
];

$passed = 0;
$failed = 0;

foreach ($viewsToTest as $viewName => $data) {
    try {
        $rendered = view($viewName, $data)->render();
        echo "[OK] View '{$viewName}' rendered successfully (" . strlen($rendered) . " bytes)\n";
        $passed++;
    } catch (\Throwable $e) {
        echo "[ERROR] View '{$viewName}' failed: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
        $failed++;
    }
}

echo "\nSummary: {$passed} views PASSED, {$failed} views FAILED.\n";
