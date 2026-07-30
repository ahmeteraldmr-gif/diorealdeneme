<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            // Türkiye'nin Ruhu (turkiye)
            [
                'name' => ['tr' => 'İstanbul', 'en' => 'Istanbul'],
                'region' => ['tr' => 'Metropol', 'en' => 'Metropolis'],
                'img' => 'foto.img/istanbul.jpg',
                'type' => 'turkiye',
                'order' => 1,
                'slug_tr' => 'istanbul',
                'slug_en' => 'istanbul',
                'desc' => [
                    'tr' => 'İki kıtayı birleştiren, tarihi ve modern yaşamı büyüleyici bir harmonide buluşturan İstanbul, dünya mirasının kalbinde yer alır. Boğazın eşsiz manzarası, sarayları, tarihi yarımadası ve gastronomisiyle unutulmaz bir deneyim sunar.',
                    'en' => 'Bridging two continents, Istanbul merges rich history and modern lifestyle in captivating harmony at the heart of world heritage.'
                ],
                'seo_title_tr' => 'İstanbul - Metropol | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Istanbul - Metropolis | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'İstanbul seyahat rehberi, en lüks oteller, lüks restoranlar ve tarihi mekanlar.',
                'seo_description_en' => 'Istanbul travel guide, luxury hotels, fine dining restaurants and historical spots.'
            ],
            [
                'name' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
                'region' => ['tr' => 'Luxury & Beach', 'en' => 'Luxury & Beach'],
                'img' => 'foto.img/bodrum.jpg',
                'type' => 'turkiye',
                'order' => 2,
                'slug_tr' => 'bodrum',
                'slug_en' => 'bodrum',
                'desc' => [
                    'tr' => 'Ege\'nin en berrak suları, marinaları, beyaz badanalı evleri ve dünya standartlarındaki gece hayatı ile Bodrum, lüks tatilin Türkiye\'deki başkentidir.',
                    'en' => 'Crystal waters, luxury marinas, iconic white houses and world-class nightlife make Bodrum the capital of luxury holidays in Turkey.'
                ],
                'seo_title_tr' => 'Bodrum - Luxury & Beach | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Bodrum - Luxury & Beach | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Bodrum rehberi, koleksiyon oteller, beach kulüpler ve yat kiralama.',
                'seo_description_en' => 'Bodrum guide, luxury hotels, beach clubs and yacht charters.'
            ],
            [
                'name' => ['tr' => 'Fethiye', 'en' => 'Fethiye'],
                'region' => ['tr' => 'Doğa & Yatçılık', 'en' => 'Nature & Yachting'],
                'img' => 'foto.img/fethiye.jpg',
                'type' => 'turkiye',
                'order' => 3,
                'slug_tr' => 'fethiye',
                'slug_en' => 'fethiye',
                'desc' => [
                    'tr' => 'Ölüdeniz\'in büyüleyici maviliği, Kelebekler Vadisi ve Göcek koyları ile Fethiye, doğa tutkunları ve özel yat rotaları için vazgeçilmez bir cennettir.',
                    'en' => 'Enchanting Oludeniz, Butterfly Valley and Gocek bays make Fethiye a paradise for nature lovers and yachting itineraries.'
                ],
                'seo_title_tr' => 'Fethiye - Doğa & Yatçılık | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Fethiye - Nature & Yachting | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Fethiye gezi rehberi, mavi yolculuk rotaları ve lüks koylar.',
                'seo_description_en' => 'Fethiye travel guide, blue cruise routes and luxury bays.'
            ],
            [
                'name' => ['tr' => 'Kapadokya', 'en' => 'Cappadocia'],
                'region' => ['tr' => 'Kültür & Büyü', 'en' => 'Culture & Magic'],
                'img' => 'foto.img/kapadokya.jpg',
                'type' => 'turkiye',
                'order' => 4,
                'slug_tr' => 'kapadokya',
                'slug_en' => 'cappadocia',
                'desc' => [
                    'tr' => 'Peri bacaları, sıcak hava balonları, kaya otelleri ve binlerce yıllık yeraltı şehirleri ile Kapadokya, masalsı bir atmosfer sunar.',
                    'en' => 'Fairy chimneys, hot air balloons, boutique cave hotels and ancient underground cities give Cappadocia a fairytale atmosphere.'
                ],
                'seo_title_tr' => 'Kapadokya - Kültür & Büyü | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Cappadocia - Culture & Magic | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Kapadokya rehberi, lüks kaya oteller ve balon turları.',
                'seo_description_en' => 'Cappadocia guide, luxury cave hotels and balloon tours.'
            ],
            [
                'name' => ['tr' => 'Çeşme', 'en' => 'Cesme'],
                'region' => ['tr' => 'Ege Ruhu', 'en' => 'Aegean Spirit'],
                'img' => 'foto.img/cesme.jpg',
                'type' => 'turkiye',
                'order' => 5,
                'slug_tr' => 'cesme',
                'slug_en' => 'cesme',
                'desc' => [
                    'tr' => "Çeşme'ye vardığınız anda Ege'nin ritmi değişir. Rüzgâr daha belirgindir, ışık daha parlaktır ve denizin mavisi gün boyunca sürekli ton değiştirir. Burası yalnızca güzel plajlardan oluşan bir tatil beldesi değil; deniz kültürü, taş mimarisi, gastronomisi ve çevresindeki köyleriyle kendi karakterini oluşturan bir yarımadadır.<br /><br />Adını yüzyıllar boyunca yolculara su sağlayan tarihi çeşmelerden alan Çeşme, antik çağlardan beri Ege'nin önemli kıyı yerleşimlerinden biri olmuştur. Bölge; İyonlar, Romalılar, Bizans, Cenevizliler, Aydınoğulları ve Osmanlılar boyunca stratejik bir liman olarak gelişti. Bugün limana hâkim konumdaki Çeşme Kalesi, 16. yüzyıldan beri yarımadanın simgesi olmaya devam ediyor. Hemen yanında yer alan Çeşme Müzesi, bölgenin denizcilik ve tarih mirasını daha yakından tanımak isteyenler için önemli bir duraktır.<br /><br />Ancak Çeşme'nin hikâyesi yalnızca merkezde başlamaz. Yarımadanın her köşesi farklı bir atmosfer sunar. Alaçatı, taş evleri, begonvillerle süslenmiş dar sokakları, yel değirmenleri ve canlı meydanlarıyla Ege'nin en karakteristik yerleşimlerinden biridir. Sabah kahvesiyle başlayan sokak yaşamı, akşam restoranların ve avluların ışıkları altında bambaşka bir kimliğe bürünür. Rüzgârı sayesinde dünyanın en önemli rüzgâr sörfü merkezlerinden biri hâline gelen Alaçatı, spor ile yaşam kültürünü aynı yerde buluşturur.<br /><br />Deniz söz konusu olduğunda Çeşme, Türkiye'nin en etkivalı kıyılarından bazılarına ev sahipliği yapar. Ilıca Plajı, ince beyaz kumu ve sığ turkuaz deniziyle aileler için ideal bir durakken; Altınkum, kuzeyden gelen serin suları sayesinde yazın en sıcak günlerinde bile ferahlatıcıdır. Pırlanta Plajı, uçurtma sörfü yapan sporcuların renkli görüntüleriyle öne çıkarken; Aya Yorgi Koyu, gün boyu hareketli beach kültürüyle tanınır. Daha sakin bir atmosfer arayanlar için Delikli Koy, Eşek Adası, Boyalık ve yarımadanın küçük koyları Ege'nin doğal güzelliğini korumaya devam eder.<br /><br />Çeşme yalnızca denizden ibaret değildir. Bölge, zeytinlikleri, bağları ve bereketli topraklarıyla son yıllarda Türkiye'nin en dikkat çeken gastronomi destinasyonlarından biri hâline geldi. Özellikle yakınındaki Urla, çağdaş Ege mutfağının yükselen merkezlerinden biri olarak uluslararası ilgi görüyor. Çeşme çevresindeki restoranlarda deniz mahsulleri, enginar, sakız aromalı tarifler, Ege otları, yerel zeytinyağları ve butik üreticilerin ürünleri sofraların temelini oluşturur. Michelin Rehberi'ne giren restoranların artmasıyla birlikte bölge artık yalnızca yaz tatili değil, gastronomi seyahatleri için de güçlü bir rota hâline gelmiştir.<br /><br />Yarımadanın doğal yapısı da keşfetmeye değerdir. Rüzgârın şekillendirdiği kıyılar, lav kayalıkları, yürüyüş parkurları ve bisiklet rotaları, Çeşme'nin yalnızca plajlardan ibaret olmadığını gösterir. Gün batımında deniz kıyısında yürürken Ege'nin karakteristik ışığını izlemek, bu bölgenin neden ressamlara ve fotoğrafçılara ilham verdiğini anlamak için yeterlidir.<br /><br />Çeşme'yi keşfetmenin en güzel yolu günü yavaş yaşamaktır. Sabah Alaçatı sokaklarında kahvaltıyla başlayabilir, öğle saatlerini Ilıca'nın berrak sularında geçirebilir, öğleden sonra Çeşme Kalesi'ni ziyaret edebilir, akşamüstü marinada yürüyüş yapabilir ve gün batımını deniz kenarında uzun bir Ege sofrasıyla tamamlayabilirsiniz. Ertesi gün rotayı Delikli Koy'a, Urla bağlarına ya da rüzgâr sörfü deneyimine çevirdiğinizde aynı yarımadanın bambaşka yüzleriyle karşılaşırsınız.<br /><br />Çeşme'nin en belirgin özelliği, gösterişli olmaya çalışmamasıdır. Rüzgâr, taş evler, deniz, iyi yemek ve yavaş akan bir yaşam birbirini doğal biçimde tamamlar. Belki de bu yüzden Ege'nin ruhunu hissetmek isteyenlerin yolu er ya da geç bu yarımadaya düşer.<br /><br />DIOREAL Editör Notu<br /><br />Çeşme için en az 4 gün ayırın. Bir gününüzü Alaçatı'ya, bir gününüzü koylara ve plajlara, bir gününüzü tarih ve marinaya, bir gününüzü ise Urla'nın bağları ve gastronomi rotasına ayırın. Çeşme'yi yalnızca yazın denize girilecek bir yer olarak değil; Ege kültürünü, mutfağını ve yaşam biçimini birlikte deneyimleyebileceğiniz bütüncül bir destinasyon olarak keşfedin.",
                    'en' => "Located on the westernmost tip of Turkey, Çeşme is renowned for its crystal waters, thermal springs, and windsurfing bays.<br /><br />The cobblestone streets of Alaçatı, adorned with stone houses and bougainvillea, offer a vibrant culinary and boutique lifestyle.<br /><br />With pristine beaches and warm Aegean hospitality, Çeşme is a quintessential summer retreat."
                ],
                'seo_title_tr' => 'Çeşme - Ege Ruhu | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Çeşme - Aegean Spirit | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Çeşme\'ye vardığınız anda Ege\'nin ritmi değişir. Rüzgâr daha belirgindir, ışık daha parlaktır ve denizin mavisi gün boyunca sürekli ton değiştirir.',
                'seo_description_en' => 'Located on the westernmost tip of Turkey, Çeşme is renowned for its crystal waters, thermal springs, and windsurfing bays.'
            ],
            [
                'name' => ['tr' => 'Kaş', 'en' => 'Kas'],
                'region' => ['tr' => 'Butik & Yavaş', 'en' => 'Boutique & Slow'],
                'img' => 'foto.img/kas.jpg',
                'type' => 'turkiye',
                'order' => 6,
                'slug_tr' => 'kas',
                'slug_en' => 'kas',
                'desc' => [
                    'tr' => 'Antik Likya medeniyetinin mirasını taşıyan Kaş, turkuaz koyları, dalış noktaları ve huzurlu butik yaşam tarzı ile Akdeniz\'in saklı cennetidir.',
                    'en' => 'Carrying the ancient Lycian heritage, Kas is the hidden jewel of the Mediterranean with crystal diving spots and serene boutique lifestyle.'
                ],
                'seo_title_tr' => 'Kaş - Butik & Yavaş | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Kas - Boutique & Slow | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Kaş gezi rehberi, en iyi dalış noktaları, Kaputaş plajı ve butik oteller.',
                'seo_description_en' => 'Kas travel guide, best diving spots, Kaputas beach and boutique hotels.'
            ],
            [
                'name' => ['tr' => 'Datça', 'en' => 'Datca'],
                'region' => ['tr' => 'Saf Doğa', 'en' => 'Pure Nature'],
                'img' => 'foto.img/datca.jpg',
                'type' => 'turkiye',
                'order' => 7,
                'slug_tr' => 'datca',
                'slug_en' => 'datca',
                'desc' => [
                    'tr' => 'Knidos Antik Kenti, el değmemiş bükleri, badem ağaçları ve oksijen zengini havası ile Datça, doğallığı arayanların vazgeçilmez rotasıdır.',
                    'en' => 'Ancient Knidos, untouched bays, almond trees and oxygen-rich air make Datca the ultimate destination for pure nature lovers.'
                ],
                'seo_title_tr' => 'Datça - Saf Doğa | Dioreal Dijital Lüks Yaşam Platformu',
                'seo_title_en' => 'Datca - Pure Nature | Dioreal Digital Luxury Lifestyle',
                'seo_description_tr' => 'Datça gezi rehberi, Eski Datça taş evleri, Knidos ve bükler.',
                'seo_description_en' => 'Datca travel guide, Old Datca stone houses, Knidos and pristine bays.'
            ],

            // Yurtdışı Destinasyonlar
            [
                'name' => ['tr' => 'Maldivler', 'en' => 'Maldives'],
                'region' => ['tr' => 'Tropik', 'en' => 'Tropical'],
                'img' => 'foto.img/maldivler.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 1,
                'slug_tr' => 'maldivler',
                'slug_en' => 'maldives',
                'desc' => [
                    'tr' => 'Hint Okyanusu\'nun ortasında su üstü villaları, beyaz kumları ve zengin deniz yaşamı ile lüks tatilin simgesi.',
                    'en' => 'Overwater villas, white sand beaches and coral reefs in the Indian Ocean, the ultimate symbol of tropical luxury.'
                ],
                'seo_title_tr' => 'Maldivler - Tropik Lüks | Dioreal Dijital',
                'seo_title_en' => 'Maldives - Tropical Luxury | Dioreal Digital',
                'seo_description_tr' => 'Maldivler su üstü villaları, balayı paketleri ve özel ada otelleri.',
                'seo_description_en' => 'Maldives overwater villas, honeymoon packages and private island resorts.'
            ],
            [
                'name' => ['tr' => 'Japonya', 'en' => 'Japan'],
                'region' => ['tr' => 'Asya & Kültür', 'en' => 'Asia & Culture'],
                'img' => 'foto.img/japonya.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 2,
                'slug_tr' => 'japonya',
                'slug_en' => 'japan',
                'desc' => [
                    'tr' => 'Geleneksel ryokan otellerinden futuristik şehirlere, Michelin yıldızlı gastronomi ve sakura mevsimine uzanan eşsiz bir kültür yolculuğu.',
                    'en' => 'A unique cultural journey from traditional ryokans to futuristic cities, Michelin dining and cherry blossom season.'
                ],
                'seo_title_tr' => 'Japonya - Asya & Kültür | Dioreal Dijital',
                'seo_title_en' => 'Japan - Asia & Culture | Dioreal Digital',
                'seo_description_tr' => 'Japonya lüks seyahat rehberi, Tokyo, Kyoto ve ryokan deneyimleri.',
                'seo_description_en' => 'Japan luxury travel guide, Tokyo, Kyoto and traditional ryokan experiences.'
            ],
            [
                'name' => ['tr' => 'Patagonya', 'en' => 'Patagonia'],
                'region' => ['tr' => 'Vahşi Doğa', 'en' => 'Wild Nature'],
                'img' => 'foto.img/patagonya.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 3,
                'slug_tr' => 'patagonya',
                'slug_en' => 'patagonia',
                'desc' => [
                    'tr' => 'Buzullar, devasa dağ zirveleri ve el değmemiş doğasıyla maceraperestler için dünyanın en dramatik coğrafyalarından biri.',
                    'en' => 'Glaciers, dramatic peaks and untouched wilderness make Patagonia one of the most breathtaking regions on Earth.'
                ],
                'seo_title_tr' => 'Patagonya - Vahşi Doğa | Dioreal Dijital',
                'seo_title_en' => 'Patagonia - Wild Nature | Dioreal Digital',
                'seo_description_tr' => 'Patagonya seyahat ve macera rehberi, lüks ekolojik localar.',
                'seo_description_en' => 'Patagonia travel and adventure guide, luxury eco lodges.'
            ],
            [
                'name' => ['tr' => 'Amalfi Kıyısı', 'en' => 'Amalfi Coast'],
                'region' => ['tr' => 'Akdeniz Rüyası', 'en' => 'Mediterranean Dream'],
                'img' => 'foto.img/amalfi.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 4,
                'slug_tr' => 'amalfi-kiyisi',
                'slug_en' => 'amalfi-coast',
                'desc' => [
                    'tr' => 'Dik kayalıklara kurulu renkli kasabaları, Positano manzaraları ve İtalyan Riviera yaşam tarzı ile büyüleyici bir Akdeniz rotası.',
                    'en' => 'Colorful cliffside villages, Positano views and the Italian Riviera lifestyle define this romantic Mediterranean route.'
                ],
                'seo_title_tr' => 'Amalfi Kıyısı - Akdeniz Rüyası | Dioreal Dijital',
                'seo_title_en' => 'Amalfi Coast - Mediterranean Dream | Dioreal Digital',
                'seo_description_tr' => 'Amalfi kıyısı rehberi, Positano, Ravello ve lüks İtalyan otelleri.',
                'seo_description_en' => 'Amalfi coast guide, Positano, Ravello and luxury Italian cliffside hotels.'
            ],
            [
                'name' => ['tr' => 'Norveç Fiyortları', 'en' => 'Norway Fjords'],
                'region' => ['tr' => 'Kuzey Işıkları', 'en' => 'Northern Lights'],
                'img' => 'foto.img/norvec.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 5,
                'slug_tr' => 'norvec-fiyortlari',
                'slug_en' => 'norway-fjords',
                'desc' => [
                    'tr' => 'Derin fiyortlar, dik dağlar ve büyüleyici Kuzey Işıkları ile İskandinav doğasının en görkemli tablosu.',
                    'en' => 'Deep fjords, steep mountains and mystical Northern Lights showcase the grandest landscape of Scandinavia.'
                ],
                'seo_title_tr' => 'Norveç Fiyortları | Dioreal Dijital',
                'seo_title_en' => 'Norway Fjords | Dioreal Digital',
                'seo_description_tr' => 'Norveç fiyortları lüks kruvaziyer ve Kuzey Işıkları rotaları.',
                'seo_description_en' => 'Norway fjords luxury cruises and Northern Lights itineraries.'
            ],
            [
                'name' => ['tr' => 'Sahra Çölü', 'en' => 'Sahara Desert'],
                'region' => ['tr' => 'Sonsuzluk', 'en' => 'Infinity'],
                'img' => 'foto.img/sahra.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 6,
                'slug_tr' => 'sahra-colu',
                'slug_en' => 'sahara-desert',
                'desc' => [
                    'tr' => 'Kızıl kum tepeleri, yıldızlı çöl geceleri ve lüks glamping çadırları ile gizemli bir seyahat tecrübesi.',
                    'en' => 'Red sand dunes, starry desert nights and luxury glamping camps offer an unforgettable mystical experience.'
                ],
                'seo_title_tr' => 'Sahra Çölü - Sonsuzluk | Dioreal Dijital',
                'seo_title_en' => 'Sahara Desert - Infinity | Dioreal Digital',
                'seo_description_tr' => 'Sahra çölü lüks glamping ve safari rehberi.',
                'seo_description_en' => 'Sahara desert luxury glamping and safari guide.'
            ]
        ];

        foreach ($destinations as $d) {
            Destination::updateOrCreate(
                ['slug_tr' => $d['slug_tr']],
                $d
            );
        }
    }
}
