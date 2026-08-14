<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "=== ADDING MISSING COLUMNS TO SQLITE DATABASE ===\n\n";

if (!Schema::hasColumn('yachts', 'order')) {
    Schema::table('yachts', function (Blueprint $table) {
        $table->integer('order')->default(0)->nullable();
    });
    echo "Added 'order' to yachts table.\n";
}

if (!Schema::hasColumn('guides', 'content')) {
    Schema::table('guides', function (Blueprint $table) {
        $table->json('content')->nullable();
    });
    echo "Added 'content' to guides table.\n";
}

if (!Schema::hasColumn('guides', 'read_time')) {
    Schema::table('guides', function (Blueprint $table) {
        $table->string('read_time')->nullable();
    });
    echo "Added 'read_time' to guides table.\n";
}

if (!Schema::hasColumn('guides', 'order')) {
    Schema::table('guides', function (Blueprint $table) {
        $table->integer('order')->default(0)->nullable();
    });
    echo "Added 'order' to guides table.\n";
}

if (!Schema::hasColumn('events', 'year')) {
    Schema::table('events', function (Blueprint $table) {
        $table->string('year')->nullable();
    });
    echo "Added 'year' to events table.\n";
}

if (!Schema::hasColumn('events', 'order')) {
    Schema::table('events', function (Blueprint $table) {
        $table->integer('order')->default(0)->nullable();
    });
    echo "Added 'order' to events table.\n";
}

if (!Schema::hasColumn('journals', 'order')) {
    Schema::table('journals', function (Blueprint $table) {
        $table->integer('order')->default(0)->nullable();
    });
    echo "Added 'order' to journals table.\n";
}

if (!Schema::hasColumn('products', 'stock')) {
    Schema::table('products', function (Blueprint $table) {
        $table->integer('stock')->default(0)->nullable();
    });
    echo "Added 'stock' to products table.\n";
}

echo "\nDone adding missing columns.\n";
