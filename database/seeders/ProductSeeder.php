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
            ['slug' => 'vip-concierge'],
            ['name' => ['tr' => 'VIP Concierge', 'en' => 'VIP Concierge'], 'order' => 1, 'is_active' => true]
        );
        $c2 = ProductCategory::firstOrCreate(
            ['slug' => 'konaklama-paketleri'],
            ['name' => ['tr' => 'Konaklama Paketleri', 'en' => 'Luxury Stays'], 'order' => 2, 'is_active' => true]
        );
        $c3 = ProductCategory::firstOrCreate(
            ['slug' => 'yat-helikopter'],
            ['name' => ['tr' => 'Yat & Helikopter', 'en' => 'Yacht & Helicopter'], 'order' => 3, 'is_active' => true]
        );
        $c4 = ProductCategory::firstOrCreate(
            ['slug' => 'gastronomi'],
            ['name' => ['tr' => 'Gastronomi', 'en' => 'Gastronomy'], 'order' => 4, 'is_active' => true]
        );

        $productsData = [
            [
                'category_id' => $c1->id,
                'name' => ['tr' => 'Dioreal Elite Concierge Pass', 'en' => 'Dioreal Elite Concierge Pass'],
                'desc' => ['tr' => '1 Yıllık Sınırsız VIP Seyahat Danışmanlığı, Özel Jet/Yat Rezervasyon Ayrıcalığı & VIP Havalimanı Karşılama.', 'en' => '1-Year Unlimited VIP Travel Consultancy, Private Jet/Yacht Charter Privilege & VIP Airport Meet & Greet.'],
                'details' => ['tr' => '1 Yıllık VIP Üyelik & Özel Asistan', 'en' => '1-Year VIP Pass & Personal Concierge'],
                'tag' => ['tr' => 'VIP Concierge', 'en' => 'VIP Concierge'],
                'price' => 150000,
                'image' => 'foto.img/hero_4k.jpg',
                'order' => 1,
                'is_active' => true
            ],
            [
                'category_id' => $c2->id,
                'name' => ['tr' => 'Bodrum Ultra Luxury Sunset Villa (3 Gece)', 'en' => 'Bodrum Ultra Luxury Sunset Villa (3 Nights)'],
                'desc' => ['tr' => 'Yalıkavak Koyunda Özel Havuzlu Deniz Manzaralı Villa, Özel Şef Kahvaltısı & VIP Transfer Dahil 3 Gece Lüks Paket.', 'en' => 'Private Pool Sea View Villa in Yalıkavak Bay, Private Chef Breakfast & VIP Transfer Included 3-Night Luxury Package.'],
                'details' => ['tr' => '3 Gece • Özel Havuzlu Villa', 'en' => '3 Nights • Private Pool Villa'],
                'tag' => ['tr' => 'Özel Koleksiyon', 'en' => 'Featured Collection'],
                'price' => 250000,
                'image' => 'foto.img/otel_hero.jpg',
                'order' => 2,
                'is_active' => true
            ],
            [
                'category_id' => $c3->id,
                'name' => ['tr' => 'Fethiye Ölüdeniz Lüks Mega Yat Mavi Turu', 'en' => 'Fethiye Oludeniz Luxury Mega Yacht Cruise'],
                'desc' => ['tr' => 'Kaptan, Mürettebat ve Özel Şef Eşliğinde Günlük Özel Mavi Yolculuk, Istakoz & Şampanya İkramı Dahil.', 'en' => 'Full Day Private Blue Cruise with Captain, Crew & Private Chef, Lobster & Champagne Included.'],
                'details' => ['tr' => 'Günlük Tur • Mega Yat', 'en' => 'Full Day • Mega Yacht'],
                'tag' => ['tr' => 'Mega Yat', 'en' => 'Mega Yacht'],
                'price' => 180000,
                'image' => 'foto.img/hero_slide_2.jpg',
                'order' => 3,
                'is_active' => true
            ],
            [
                'category_id' => $c4->id,
                'name' => ['tr' => 'Michelin Tadım Menüsü & Şarap Eşleşmesi', 'en' => 'Michelin Tasting Menu & Wine Pairing'],
                'desc' => ['tr' => '2 Kişilik Özel Şef Tadım Menüsü, Nadir Sommelier Şarap Seçkisi ve En İyi Masa Garanti Rezervasyonu.', 'en' => 'Private Chef Tasting Menu for 2, Rare Sommelier Wine Selection and Guaranteed Best Table.'],
                'details' => ['tr' => '2 Kişilik • Şarap Eşleşmeli', 'en' => 'For 2 • Wine Pairing'],
                'tag' => ['tr' => 'Gastronomi', 'en' => 'Fine Dining'],
                'price' => 28500,
                'image' => 'foto.img/hero_slide_3.jpg',
                'order' => 4,
                'is_active' => true
            ],
            [
                'category_id' => $c2->id,
                'name' => ['tr' => 'Kapadokya VIP Sıcak Hava Balonu & Cave Suite', 'en' => 'Cappadocia VIP Hot Air Balloon & Cave Suite'],
                'desc' => ['tr' => 'Özel İki Kişilik Sepet Balon Uçuşu, Şampanyalı Kutlama & 2 Gece Taş Mağara Lüks Süit Konaklama.', 'en' => 'Private Hot Air Balloon Flight for Two, Champagne Celebration & 2-Night Luxury Cave Suite Stay.'],
                'details' => ['tr' => '2 Gece • Özel Balon Uçuşu', 'en' => '2 Nights • Private Balloon Flight'],
                'tag' => ['tr' => 'VIP Deneyim', 'en' => 'VIP Experience'],
                'price' => 120000,
                'image' => 'foto.img/dest_kapadokya.jpg',
                'order' => 5,
                'is_active' => true
            ],
            [
                'category_id' => $c3->id,
                'name' => ['tr' => 'İstanbul Boğazı Helikopter Transfer & Yat Turu', 'en' => 'Istanbul Bosphorus Helicopter & Yacht Tour'],
                'desc' => ['tr' => 'Havalimanından Özel Helikopter Transferi ile Başlayan 4 Saatlik Özel Boğaz Yat Gezisi & Canlı Müzik.', 'en' => '4-Hour Private Bosphorus Yacht Cruise Starting with Airport Helicopter Transfer & Live Music.'],
                'details' => ['tr' => 'Helikopter + Yat • 4 Saat', 'en' => 'Helicopter + Yacht • 4 Hours'],
                'tag' => ['tr' => 'Helikopter & Yat', 'en' => 'Heli & Yacht'],
                'price' => 145000,
                'image' => 'foto.img/dest_istanbul.jpg',
                'order' => 6,
                'is_active' => true
            ],
            [
                'category_id' => $c2->id,
                'name' => ['tr' => 'Çeşme Alaçatı Taş Ev & Gastronomi Rotaları', 'en' => 'Cesme Alacati Stone House & Gastronomy Route'],
                'desc' => ['tr' => 'Tarihi Alaçatı Taş Evinde 3 Gece Özel Konaklama, Bağ Bozumu Turu & Şarap Tadımı.', 'en' => '3-Night Boutique Stay in Historic Stone House, Vintage Wine Harvest Tour & Tasting.'],
                'details' => ['tr' => '3 Gece • Bağ Tadım Turu', 'en' => '3 Nights • Wine Tasting Tour'],
                'tag' => ['tr' => 'Butik Konaklama', 'en' => 'Boutique Stay'],
                'price' => 95000,
                'image' => 'foto.img/dest_cesme.jpg',
                'order' => 7,
                'is_active' => true
            ],
            [
                'category_id' => $c1->id,
                'name' => ['tr' => 'D-Maris Bay VIP Helikopter Transfer & Stay', 'en' => 'D-Maris Bay VIP Helicopter Transfer & Stay'],
                'desc' => ['tr' => 'Datça Yarımadasının En Eşsiz Koyunda 4 Gece Presidential Suite Konaklama & Özel Helikopter Transferi.', 'en' => '4-Night Presidential Suite Stay in Datca Peninsula with Private Helicopter Transfer.'],
                'details' => ['tr' => '4 Gece • Helikopter Transfer', 'en' => '4 Nights • Helicopter Transfer'],
                'tag' => ['tr' => 'Lüks Konaklama', 'en' => 'Luxury Stay'],
                'price' => 210000,
                'image' => 'foto.img/otel_hero.jpg',
                'order' => 8,
                'is_active' => true
            ],
            [
                'category_id' => $c4->id,
                'name' => ['tr' => 'Bodrum Mandarin Oriental Spa & Wellness Pass', 'en' => 'Bodrum Mandarin Oriental Spa & Wellness Pass'],
                'desc' => ['tr' => 'Tam Gün Kişiye Özel Spa Ritualı, Aromaterapi Masajı, Özel Detoks Menüsü & Özel Plaj Kullanımı.', 'en' => 'Full Day Personalized Spa Ritual, Aromatherapy Massage, Custom Detox Menu & Private Beach Pass.'],
                'details' => ['tr' => 'Tam Gün • Spa & Plaj Kullanımı', 'en' => 'Full Day • Spa & Beach Access'],
                'tag' => ['tr' => 'Wellness & Spa', 'en' => 'Wellness & Spa'],
                'price' => 38000,
                'image' => 'foto.img/hero_slide_3.jpg',
                'order' => 9,
                'is_active' => true
            ],
            [
                'category_id' => $c3->id,
                'name' => ['tr' => 'Göcek Koyları Özel Gulet Günlük Tur', 'en' => 'Göcek Bays Private Gulet Day Charter'],
                'desc' => ['tr' => 'Kaptan ve Mürettebat Eşliğinde Günlük Özel Mavi Yolculuk, Öğle Yemeği & İkramlar Dahil.', 'en' => 'Full Day Private Blue Cruise with Captain & Crew, Gourmet Lunch & Refreshments Included.'],
                'details' => ['tr' => 'Günlük Tur • Özel Kaptanlı', 'en' => 'Full Day • Private Crew'],
                'tag' => ['tr' => 'Yat & Mavi Tur', 'en' => 'Yacht Charter'],
                'price' => 45000,
                'image' => 'foto.img/hero_slide_2.jpg',
                'order' => 10,
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
