<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('yachts') && !Schema::hasColumn('yachts', 'order')) {
            Schema::table('yachts', function (Blueprint $table) {
                $table->integer('order')->default(0)->nullable();
            });
        }

        if (Schema::hasTable('guides')) {
            if (!Schema::hasColumn('guides', 'content')) {
                Schema::table('guides', function (Blueprint $table) {
                    $table->json('content')->nullable();
                });
            }
            if (!Schema::hasColumn('guides', 'read_time')) {
                Schema::table('guides', function (Blueprint $table) {
                    $table->string('read_time')->nullable();
                });
            }
            if (!Schema::hasColumn('guides', 'order')) {
                Schema::table('guides', function (Blueprint $table) {
                    $table->integer('order')->default(0)->nullable();
                });
            }
        }

        if (Schema::hasTable('events')) {
            if (!Schema::hasColumn('events', 'year')) {
                Schema::table('events', function (Blueprint $table) {
                    $table->string('year')->nullable();
                });
            }
            if (!Schema::hasColumn('events', 'order')) {
                Schema::table('events', function (Blueprint $table) {
                    $table->integer('order')->default(0)->nullable();
                });
            }
        }

        if (Schema::hasTable('journals') && !Schema::hasColumn('journals', 'order')) {
            Schema::table('journals', function (Blueprint $table) {
                $table->integer('order')->default(0)->nullable();
            });
        }

        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'stock')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('stock')->default(0)->nullable();
            });
        }
    }

    public function down(): void
    {
        // Keep columns intact
    }
};
