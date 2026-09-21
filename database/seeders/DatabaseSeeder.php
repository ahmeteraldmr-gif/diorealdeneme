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

        // About Us Page Settings
        Setting::set('about_hero_eyebrow_tr', 'Biz Kimiz');
        Setting::set('about_hero_eyebrow_en', 'Who We Are');
        Setting::set('about_hero_title_tr', 'Seyahate Başka Bir Yerden Bakmak');
        Setting::set('about_hero_title_en', 'A Different Perspective on Travel');
        Setting::set('about_hero_img', 'foto.img/hero_4k.jpg');

        Setting::set('about_story_eyebrow_tr', 'Hikayemiz');
        Setting::set('about_story_eyebrow_en', 'Our Story');
        Setting::set('about_story_title_tr', 'Türk Rivierası’ndan Dünyaya Açılan Bir Seyahat Seçkisi');
        Setting::set('about_story_title_en', 'A Travel Selection Born on the Turkish Riviera');
        Setting::set('about_story_p1_tr', 'DIOREAL, Türkiye’nin eşsiz kıyı kültürünü uluslararası bir bakış açısıyla dünyaya anlatmak ve seyahati yalnızca gidilecek yerlerin ötesinde, bütüncül bir deneyim olarak ele almak amacıyla kuruldu.');
        Setting::set('about_story_p2_tr', 'Türk Rivierası çıkış noktamız; dünya ise rotamız. Otelleri, restoranları, yatları ve destinasyonları yalnızca tanıtmıyor; her birini kültürü, mimarisi, gastronomisi, doğası ve taşıdığı hikâyeyle birlikte editoryal bir seçkinin parçası olarak ele alıyoruz.');
        Setting::set('about_story_p1_en', 'DIOREAL was founded to introduce Türkiye’s distinctive coastal culture to the world through an international perspective and to approach travel as a complete experience extending far beyond the places we visit.');
        Setting::set('about_story_p2_en', 'The Turkish Riviera is our starting point; the world is our route. We do more than present hotels, restaurants, yachts and destinations—we explore each through its culture, architecture, gastronomy, natural setting and story, bringing them together within a carefully considered editorial selection.');
        Setting::set('about_story_img', 'uploads/settings/1785331414_6a69fed6944c8.png');

        Setting::set('about_stats_title_tr', 'DIOREAL Dünyası');
        Setting::set('about_stats_title_en', 'The World of DIOREAL');
        Setting::set('about_stat1_num', '150+');
        Setting::set('about_stat1_label_tr', 'Destinasyon');
        Setting::set('about_stat1_label_en', 'Destinations');
        Setting::set('about_stat2_num', '1M');
        Setting::set('about_stat2_label_tr', 'Aylık Okuyucu');
        Setting::set('about_stat2_label_en', 'Monthly Readers');
        Setting::set('about_stat3_num', '100+');
        Setting::set('about_stat3_label_tr', 'Marka Ortağı');
        Setting::set('about_stat3_label_en', 'Brand Partners');
        Setting::set('about_stat4_num', '10');
        Setting::set('about_stat4_label_tr', 'Yıllık Deneyim');
        Setting::set('about_stat4_label_en', 'Years of Experience');

        Setting::set('about_mission_eyebrow_tr', 'Misyonumuz');
        Setting::set('about_mission_eyebrow_en', 'Our Mission');
        Setting::set('about_mission_title_tr', 'Anlamlı deneyimler için');
        Setting::set('about_mission_title_en', 'For meaningful experiences');
        Setting::set('about_mission_p1_tr', 'DIOREAL, seyahati yalnızca gidilecek yerlerin toplamı olarak değil; kültürün, mimarinin, gastronominin, tarihin ve insan hikâyelerinin bir araya geldiği bütüncül bir deneyim olarak ele alır.');
        Setting::set('about_mission_p2_tr', 'Misyonumuz, Türkiye’nin eşsiz kıyı kültürünü ve Türk Rivierası’nı uluslararası bir bakış açısıyla dünyaya anlatırken, dünyanın en ilham verici destinasyonlarını da aynı editoryal özen ve estetik anlayışla keşfetmektir.');
        Setting::set('about_mission_p1_en', 'DIOREAL approaches travel not simply as a collection of places to visit, but as a complete experience shaped by culture, architecture, gastronomy, history and human stories.');
        Setting::set('about_mission_p2_en', 'Our mission is to bring Türkiye’s distinctive coastal culture and the Turkish Riviera to the world through an international perspective, while exploring the world’s most inspiring destinations with the same editorial care and aesthetic vision.');
        Setting::set('about_mission_img', 'foto.img/about_safari.jpg');

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
