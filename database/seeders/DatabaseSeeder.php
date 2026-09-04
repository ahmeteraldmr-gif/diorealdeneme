<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User (Sole Admin Account)
        User::query()->delete();

        User::create([
            'email' => 'DioTurkReal.13',
            'name' => 'DioTurkReal.13',
            'password' => Hash::make('xYdioReal.13xY'),
            'role' => 'super_admin',
            'permissions' => ['hotels', 'restaurants', 'yachts', 'guides', 'events', 'journals', 'settings', 'users', 'destinations'],
        ]);

        // Seed General Settings
        Setting::set('contact_email', 'info@diorealdijital.com');
        Setting::set('contact_phone', '+90 212 555 0100');
        Setting::set('contact_address_tr', 'İstanbul, Türkiye');
        Setting::set('contact_address_en', 'Istanbul, Turkey');
        Setting::set('instagram', 'https://instagram.com');
        Setting::set('linkedin', 'https://linkedin.com');
        Setting::set('whatsapp', '905449157011');
        Setting::set('footer_copy', '© 2026 Dioreal Dijital. All Rights Reserved.');
        Setting::set('hero_title_tr', "Türkiye ve dünyada seçkin\ndeneyimlerin kapısını aralıyoruz.");
        Setting::set('hero_title_en', "Opening doors to exclusive\nexperiences globally.");

        $defaultBrands = [
            ['name' => 'Nautical', 'img' => 'uploads/brands/1785092366_6a66590e9bac0.png'],
            ['name' => 'PERDUE', 'img' => 'uploads/brands/1785093932_6a665f2cb2cb3.png'],
            ['name' => 'Kassandra', 'img' => 'uploads/brands/1785093993_6a665f69aa28b.png'],
            ['name' => 'ZAKROS', 'img' => 'uploads/brands/1785093832_6a665ec89fe38.png'],
            ['name' => 'SONY', 'img' => 'uploads/brands/1785093954_6a665f42395ec.png'],
            ['name' => 'oppo', 'img' => 'uploads/brands/1785092603_6a6659fb5e944.png'],
            ['name' => 'CapCut', 'img' => 'uploads/brands/1785092623_6a665a0fa9a31.png'],
            ['name' => 'Hus Wines', 'img' => 'uploads/brands/1785092903_6a665b273ebbc.png'],
            ['name' => 'RUPS', 'img' => 'uploads/brands/1785093897_6a665f094ddfe.png'],
            ['name' => 'Despot Evi', 'img' => 'uploads/brands/1785093698_6a665e426cbcf.png'],
            ['name' => 'BLUE VOYAGE', 'img' => 'uploads/brands/1785093130_6a665c0a3debe.png'],
            ['name' => 'HUAWEI', 'img' => 'uploads/brands/1785094412_6a66610c8e750.png'],
        ];

        Setting::set('brands', $defaultBrands);

        // Run resource content import
        $this->call(JsonToDbSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PopulateSlugsSeeder::class);
    }
}
