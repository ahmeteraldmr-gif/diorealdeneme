<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

$tables = ['hotels', 'restaurants', 'yachts', 'guides', 'events', 'journals', 'destinations', 'products', 'product_categories', 'users'];

foreach ($tables as $t) {
    echo "=== TABLE: {$t} ===\n";
    $columns = Schema::getColumnListing($t);
    echo implode(', ', $columns) . "\n\n";
}
