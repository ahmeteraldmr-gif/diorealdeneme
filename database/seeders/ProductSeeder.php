<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Seed or update categories
        $c1 = ProductCategory::firstOrCreate(
            ['slug' => 'mutfak-yemek'],
            ['name' => ['tr' => 'Mutfak & Yemek Takımları', 'en' => 'Kitchen & Dining'], 'order' => 1, 'is_active' => true]
        );
        $c2 = ProductCategory::firstOrCreate(
            ['slug' => 'ev-dekorasyon'],
            ['name' => ['tr' => 'Ev & Lüks Dekorasyon', 'en' => 'Home & Decor'], 'order' => 2, 'is_active' => true]
        );
        $c3 = ProductCategory::firstOrCreate(
            ['slug' => 'konaklama-paketleri'],
            ['name' => ['tr' => 'Konaklama Paketleri', 'en' => 'Luxury Stays'], 'order' => 3, 'is_active' => true]
        );
        $c4 = ProductCategory::firstOrCreate(
            ['slug' => 'yat-helikopter'],
            ['name' => ['tr' => 'Yat & Helikopter', 'en' => 'Yacht & Helicopter'], 'order' => 4, 'is_active' => true]
        );

        $productsData = [
            // 🍽️ PHYSICAL HOME & DINING PRODUCTS
            [
                'category_id' => $c1->id,
                'name' => ['tr' => 'Royal Altın İşlemeli 24 Parça Porselen Yemek Takımı', 'en' => 'Royal Gold-Plated 24-Piece Porcelain Dinnerware Set'],
                'desc' => ['tr' => '%100 El Yapımı İnce Bone China Porselen, 24 Karat Altın Yaldız İşlemeli 6 Kişilik Yemek Takımı.', 'en' => '100% Handmade Fine Bone China Porcelain, 24-Karat Gold Plated 6-Person Dinner Set.'],
                'details' => ['tr' => '24 Parça • 6 Kişilik • Bone China', 'en' => '24 Pieces • 6 Persons • Bone China'],
                'tag' => ['tr' => 'Yemek Takımı', 'en' => 'Dinnerware'],
                'price' => 18500,
                'image' => 'foto.img/hero_4k.jpg',
                'order' => 1,
                'is_active' => true
            ],
            [
                'category_id' => $c1->id,
                'name' => ['tr' => 'Baccarat Kristal 6\'lı Şarap Kadehi Seti', 'en' => 'Baccarat Crystal 6-Piece Wine Glass Set'],
                'desc' => ['tr' => 'Özel Kesim Ağızla Üflenmiş Fransız Kristali, Lüks Kutu Sunumu ile 6 Parça Kadeh Seti.', 'en' => 'Special Cut Hand-Blown French Crystal, 6-Piece Glass Set with Luxury Gift Box.'],
                'details' => ['tr' => '6\'lı Kadeh Seti • El Yapımı Kristal', 'en' => '6-Piece Glass Set • Handmade Crystal'],
                'tag' => ['tr' => 'Kristal Kadeh', 'en' => 'Crystal Glass'],
                'price' => 8400,
                'image' => 'foto.img/hero_slide_3.jpg',
                'order' => 2,
                'is_active' => true
            ],
            [
                'category_id' => $c1->id,
                'name' => ['tr' => 'Handmade Çelik 30 Parça Çatal Bıçak Takımı', 'en' => 'Handmade Steel 30-Piece Cutlery Set'],
                'desc' => ['tr' => '18/10 Paslanmaz Çelik, Özel Titanyum Kaplama Saplı 6 Kişilik Lüks Çatal Bıçak Kaşık Seti.', 'en' => '18/10 Stainless Steel, Special Titanium Coated Handle 6-Person Cutlery Set.'],
                'details' => ['tr' => '30 Parça • 18/10 Çelik • Titanyum Kaplama', 'en' => '30 Pieces • 18/10 Steel • Titanium Finish'],
                'tag' => ['tr' => 'Çatal Bıçak Takımı', 'en' => 'Cutlery Set'],
                'price' => 12900,
                'image' => 'foto.img/hero_slide_2.jpg',
                'order' => 3,
                'is_active' => true
            ],

            // 🛋️ PHYSICAL HOME DECOR PRODUCTS
            [
                'category_id' => $c2->id,
                'name' => ['tr' => 'Hermès Desenli İpek Kırlent Seti (4\'lü)', 'en' => 'Hermès Pattern Silk Cushion Set (Set of 4)'],
                'desc' => ['tr' => '%100 Doğal Saf İpek Kumaş, Özel Desen Baskılı ve Kaz Tüyü Dolgulu 4\'lü Lüks Kırlent Seti.', 'en' => '100% Natural Pure Silk Fabric, Special Printed Pattern with Goose Down Filling 4-Piece Set.'],
                'details' => ['tr' => '4\'lü Kırlent Seti • %100 Saf İpek', 'en' => '4-Piece Cushion Set • 100% Pure Silk'],
                'tag' => ['tr' => 'Lüks Dekorasyon', 'en' => 'Luxury Decor'],
                'price' => 6200,
                'image' => 'foto.img/otel_hero.jpg',
                'order' => 4,
                'is_active' => true
            ],
            [
                'category_id' => $c2->id,
                'name' => ['tr' => 'Murano Üfleme Cam El Yapımı Dekoratif Vazo', 'en' => 'Murano Hand-Blown Glass Decorative Vase'],
                'desc' => ['tr' => 'İtalya Venedik Atölyelerinde Usta Cam Sanatçıları Tarafından Üflenmiş Özel Tasarım Vazo.', 'en' => 'Special Design Vase Hand-Blown by Master Glass Artisans in Venice, Italy.'],
                'details' => ['tr' => 'İtalyan Murano Camı • 45cm Yükseklik', 'en' => 'Italian Murano Glass • 45cm Height'],
                'tag' => ['tr' => 'Sanat & Dekor', 'en' => 'Art & Decor'],
                'price' => 9800,
                'image' => 'foto.img/dest_istanbul.jpg',
                'order' => 5,
                'is_active' => true
            ],

            // 🏡 LUXURY EXPERIENCE & TRAVEL PACKAGES
            [
                'category_id' => $c3->id,
                'name' => ['tr' => 'Bodrum Ultra Luxury Sunset Villa Paket (3 Gece)', 'en' => 'Bodrum Ultra Luxury Sunset Villa Package (3 Nights)'],
                'desc' => ['tr' => 'Yalıkavak Koyunda Özel Havuzlu Deniz Manzaralı Villa, Özel Şef Kahvaltısı & VIP Transfer Dahil 3 Gece Lüks Paket.', 'en' => 'Private Pool Sea View Villa in Yalıkavak Bay, Private Chef Breakfast & VIP Transfer Included 3-Night Luxury Package.'],
                'details' => ['tr' => '3 Gece • Özel Havuzlu Villa', 'en' => '3 Nights • Private Pool Villa'],
                'tag' => ['tr' => 'Villa Paketi', 'en' => 'Villa Package'],
                'price' => 250000,
                'image' => 'foto.img/bodrum.jpg',
                'order' => 6,
                'is_active' => true
            ],
            [
                'category_id' => $c4->id,
                'name' => ['tr' => 'Fethiye Ölüdeniz Lüks Mega Yat Mavi Turu', 'en' => 'Fethiye Oludeniz Luxury Mega Yacht Cruise'],
                'desc' => ['tr' => 'Kaptan, Mürettebat ve Özel Şef Eşliğinde Günlük Özel Mavi Yolculuk, Istakoz & Şampanya İkramı Dahil.', 'en' => 'Full Day Private Blue Cruise with Captain, Crew & Private Chef, Lobster & Champagne Included.'],
                'details' => ['tr' => 'Günlük Tur • Mega Yat', 'en' => 'Full Day • Mega Yacht'],
                'tag' => ['tr' => 'Mavi Tur', 'en' => 'Yacht Charter'],
                'price' => 180000,
                'image' => 'foto.img/fethiye.jpg',
                'order' => 7,
                'is_active' => true
            ],
            [
                'category_id' => $c3->id,
                'name' => ['tr' => 'Kapadokya VIP Sıcak Hava Balonu & Cave Suite', 'en' => 'Cappadocia VIP Hot Air Balloon & Cave Suite'],
                'desc' => ['tr' => 'Özel İki Kişilik Sepet Balon Uçuşu, Şampanyalı Kutlama & 2 Gece Taş Mağara Lüks Süit Konaklama.', 'en' => 'Private Hot Air Balloon Flight for Two, Champagne Celebration & 2-Night Luxury Cave Suite Stay.'],
                'details' => ['tr' => '2 Gece • Özel Balon Uçuşu', 'en' => '2 Nights • Private Balloon Flight'],
                'tag' => ['tr' => 'Kapadokya Paketi', 'en' => 'Cappadocia Package'],
                'price' => 120000,
                'image' => 'foto.img/dest_kapadokya.jpg',
                'order' => 8,
                'is_active' => true
            ]
        ];

        foreach ($productsData as $data) {
            Product::updateOrCreate(
                ['name->tr' => $data['name']['tr']],
                $data
            );
        }
    }
}
