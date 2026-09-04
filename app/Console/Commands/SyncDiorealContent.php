<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;
use App\Models\Hotel;
use App\Models\Yacht;
use App\Models\Restaurant;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;
use App\Models\Destination;
use Database\Seeders\JsonToDbSeeder;

class SyncDiorealContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dioreal:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically scrape and sync all new content, text and images from live dioreal.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting automatic Dioreal content synchronization...");

        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
            ]
        ];
        $context = stream_context_create($opts);

        $basePublic = public_path();

        // 1. Sync Guides
        $this->syncGuides($context, $basePublic);

        // 2. Sync Events
        $this->syncEvents($context, $basePublic);

        // 3. Sync Journal
        $this->syncJournal($context, $basePublic);

        // 4. Download any missing DB images
        $this->downloadMissingImages($context, $basePublic);

        // 5. Seed DB cleanly using JsonToDbSeeder
        $this->info("Updating database tables...");
        try {
            $seeder = new JsonToDbSeeder();
            $seeder->run();
        } catch (\Throwable $e) {
            $this->warn("Seeder notice: " . $e->getMessage());
        }

        // 6. Clear caches
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        $this->info("Cache cleared.");

        $this->info("Synchronization finished successfully!");
        return Command::SUCCESS;
    }

    private function syncGuides($context, $basePublic)
    {
        $this->info("Syncing Gezi Rehberi...");
        $html = @file_get_contents('https://dioreal.com/gezi-rehberi', false, $context);
        if (!$html) return;

        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($dom);

        $cards = $xpath->query('//div[contains(@class, "card")]');
        $guides = [];
        $seen = [];

        foreach ($cards as $card) {
            $imgNode = $xpath->query('.//img', $card)->item(0);
            $imgSrc = $imgNode ? ltrim(preg_replace('#^https?://dioreal\.com/#', '', $imgNode->getAttribute('src')), '/') : '';

            $tagTrNode = $xpath->query('.//span[contains(@class, "card-tag")]//span[contains(@class, "lang-text-tr")]', $card)->item(0);
            $tagEnNode = $xpath->query('.//span[contains(@class, "card-tag")]//span[contains(@class, "lang-text-en")]', $card)->item(0);
            $tagTr = $tagTrNode ? trim($tagTrNode->textContent) : '';
            $tagEn = $tagEnNode ? trim($tagEnNode->textContent) : '';

            $titleTrNode = $xpath->query('.//h3[contains(@class, "card-title")]//span[contains(@class, "lang-text-tr")]', $card)->item(0);
            $titleEnNode = $xpath->query('.//h3[contains(@class, "card-title")]//span[contains(@class, "lang-text-en")]', $card)->item(0);
            $titleTr = $titleTrNode ? trim($titleTrNode->textContent) : '';
            $titleEn = $titleEnNode ? trim($titleEnNode->textContent) : '';
            if (empty($titleTr)) {
                $tNode = $xpath->query('.//h3[contains(@class, "card-title")]', $card)->item(0);
                $titleTr = $tNode ? trim($tNode->textContent) : '';
            }

            $descTrNode = $xpath->query('.//p[contains(@class, "card-desc")]//span[contains(@class, "lang-text-tr")]', $card)->item(0);
            $descEnNode = $xpath->query('.//p[contains(@class, "card-desc")]//span[contains(@class, "lang-text-en")]', $card)->item(0);
            $descTr = $descTrNode ? trim($descTrNode->textContent) : '';
            $descEn = $descEnNode ? trim($descEnNode->textContent) : '';

            $linkNode = $xpath->query('.//a', $card)->item(0);
            $href = $linkNode ? $linkNode->getAttribute('href') : '';
            $slug = basename(parse_url($href, PHP_URL_PATH));
            if (empty($slug)) $slug = Str::slug($titleTr);

            if (!empty($titleTr) && !isset($seen[$titleTr])) {
                $seen[$titleTr] = true;

                if (!empty($imgSrc)) {
                    $this->downloadImage('https://dioreal.com/' . $imgSrc, $basePublic . '/' . $imgSrc, $context);
                }

                $guides[] = [
                    'title' => ['tr' => $titleTr, 'en' => $titleEn ?: $titleTr],
                    'tag' => ['tr' => $tagTr, 'en' => $tagEn ?: $tagTr],
                    'img' => $imgSrc,
                    'desc' => ['tr' => $descTr, 'en' => $descEn ?: $descTr],
                    'slug_tr' => $slug,
                    'slug_en' => $slug . '-en',
                    'seo_title_tr' => $titleTr . ' | Dioreal Dijital Lüks Yaşam Platformu',
                    'seo_title_en' => ($titleEn ?: $titleTr) . ' | Dioreal Digital Luxury Platform',
                    'seo_description_tr' => Str::limit(strip_tags($descTr), 155),
                    'seo_description_en' => Str::limit(strip_tags($descEn ?: $descTr), 155),
                    'gallery' => [],
                    'video_file' => null,
                    'video_url' => null,
                    'show_video_on_cover' => false,
                    'og_image' => null,
                    'seo_noindex' => 0
                ];
            }
        }

        if (!empty($guides)) {
            $jsonPath = storage_path('app/data/dioreal_guide_data.json');
            file_put_contents($jsonPath, json_encode($guides, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private function syncEvents($context, $basePublic)
    {
        $this->info("Syncing Etkinlikler...");
        $html = @file_get_contents('https://dioreal.com/etkinlikler', false, $context);
        if (!$html) return;

        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($dom);

        $cards = $xpath->query('//div[contains(@class, "event-card")]');
        $events = [];
        $seen = [];

        foreach ($cards as $card) {
            $imgNode = $xpath->query('.//img', $card)->item(0);
            $imgSrc = $imgNode ? ltrim(preg_replace('#^https?://dioreal\.com/#', '', $imgNode->getAttribute('src')), '/') : '';

            $dayNode = $xpath->query('.//*[contains(@class, "event-card-day")]', $card)->item(0);
            $day = $dayNode ? trim($dayNode->textContent) : '';

            $monthTrNode = $xpath->query('.//*[contains(@class, "event-card-month") and contains(@class, "lang-text-tr")]', $card)->item(0);
            $monthEnNode = $xpath->query('.//*[contains(@class, "event-card-month") and contains(@class, "lang-text-en")]', $card)->item(0);
            $monthTr = $monthTrNode ? trim($monthTrNode->textContent) : '';
            $monthEn = $monthEnNode ? trim($monthEnNode->textContent) : '';

            $tagTrNode = $xpath->query('.//*[contains(@class, "event-card-tag") and contains(@class, "lang-text-tr")]', $card)->item(0);
            $tagEnNode = $xpath->query('.//*[contains(@class, "event-card-tag") and contains(@class, "lang-text-en")]', $card)->item(0);
            $tagTr = $tagTrNode ? trim($tagTrNode->textContent) : '';
            $tagEn = $tagEnNode ? trim($tagEnNode->textContent) : '';

            $titleTrNode = $xpath->query('.//*[contains(@class, "event-card-title") and contains(@class, "lang-text-tr")]', $card)->item(0);
            $titleEnNode = $xpath->query('.//*[contains(@class, "event-card-title") and contains(@class, "lang-text-en")]', $card)->item(0);
            $titleTr = $titleTrNode ? trim($titleTrNode->textContent) : '';
            $titleEn = $titleEnNode ? trim($titleEnNode->textContent) : '';

            $locTrNode = $xpath->query('.//*[contains(@class, "event-card-location")]//*[contains(@class, "lang-text-tr")]', $card)->item(0);
            $locEnNode = $xpath->query('.//*[contains(@class, "event-card-location")]//*[contains(@class, "lang-text-en")]', $card)->item(0);
            $locTr = $locTrNode ? trim($locTrNode->textContent) : '';
            $locEn = $locEnNode ? trim($locEnNode->textContent) : '';

            $descTrNode = $xpath->query('.//*[contains(@class, "event-card-desc") and contains(@class, "lang-text-tr")]', $card)->item(0);
            $descEnNode = $xpath->query('.//*[contains(@class, "event-card-desc") and contains(@class, "lang-text-en")]', $card)->item(0);
            $descTr = $descTrNode ? trim($descTrNode->textContent) : '';
            $descEn = $descEnNode ? trim($descEnNode->textContent) : '';

            $linkNode = $xpath->query('.//a', $card)->item(0);
            $href = $linkNode ? $linkNode->getAttribute('href') : '';
            $slug = basename(parse_url($href, PHP_URL_PATH));
            if (empty($slug)) $slug = Str::slug($titleTr);

            if (!empty($titleTr) && !isset($seen[$titleTr])) {
                $seen[$titleTr] = true;

                if (!empty($imgSrc)) {
                    $this->downloadImage('https://dioreal.com/' . $imgSrc, $basePublic . '/' . $imgSrc, $context);
                }

                $events[] = [
                    'day' => $day,
                    'month' => ['tr' => $monthTr, 'en' => $monthEn ?: $monthTr],
                    'title' => ['tr' => $titleTr, 'en' => $titleEn ?: $titleTr],
                    'tag' => ['tr' => $tagTr, 'en' => $tagEn ?: $tagTr],
                    'loc' => ['tr' => $locTr, 'en' => $locEn ?: $locTr],
                    'img' => $imgSrc,
                    'desc' => ['tr' => $descTr, 'en' => $descEn ?: $descTr],
                    'slug_tr' => $slug,
                    'slug_en' => $slug . '-en',
                    'seo_title_tr' => $titleTr . ' | Dioreal Dijital Lüks Yaşam Platformu',
                    'seo_title_en' => ($titleEn ?: $titleTr) . ' | Dioreal Digital Luxury Platform',
                    'seo_description_tr' => Str::limit(strip_tags($descTr), 155),
                    'seo_description_en' => Str::limit(strip_tags($descEn ?: $descTr), 155),
                    'gallery' => [],
                    'video_file' => null,
                    'video_url' => null,
                    'show_video_on_cover' => false,
                    'og_image' => null,
                    'seo_noindex' => 0
                ];
            }
        }

        if (!empty($events)) {
            $jsonPath = storage_path('app/data/dioreal_events_data.json');
            file_put_contents($jsonPath, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private function syncJournal($context, $basePublic)
    {
        $this->info("Syncing Journal...");
        $html = @file_get_contents('https://dioreal.com/journal', false, $context);
        if (!$html) return;

        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($dom);

        $cards = $xpath->query('//div[contains(@class, "journal-featured")] | //div[contains(@class, "journal-side-item")] | //div[contains(@class, "card-grid")]/a[contains(@class, "card")]');
        $journals = [];
        $seen = [];

        foreach ($cards as $card) {
            $imgNode = $xpath->query('.//img', $card)->item(0);
            $imgSrc = $imgNode ? ltrim(preg_replace('#^https?://dioreal\.com/#', '', $imgNode->getAttribute('src')), '/') : '';

            $dateNode = $xpath->query('.//*[contains(@class, "journal-date")]', $card)->item(0);
            $date = $dateNode ? trim($dateNode->textContent) : '';

            $tagTrNode = $xpath->query('.//*[contains(@class, "card-tag")]//*[contains(@class, "lang-text-tr")]', $card)->item(0);
            $tagEnNode = $xpath->query('.//*[contains(@class, "card-tag")]//*[contains(@class, "lang-text-en")]', $card)->item(0);
            $tagTr = $tagTrNode ? trim($tagTrNode->textContent) : '';
            $tagEn = $tagEnNode ? trim($tagEnNode->textContent) : '';

            $titleTrNode = $xpath->query('.//*[contains(@class, "journal-title") or contains(@class, "card-title")]//*[contains(@class, "lang-text-tr")]', $card)->item(0);
            $titleEnNode = $xpath->query('.//*[contains(@class, "journal-title") or contains(@class, "card-title")]//*[contains(@class, "lang-text-en")]', $card)->item(0);
            $titleTr = $titleTrNode ? trim($titleTrNode->textContent) : '';
            $titleEn = $titleEnNode ? trim($titleEnNode->textContent) : '';
            if (empty($titleTr)) {
                $tNode = $xpath->query('.//*[contains(@class, "journal-title") or contains(@class, "card-title")]', $card)->item(0);
                $titleTr = $tNode ? trim($tNode->textContent) : '';
            }

            $descTrNode = $xpath->query('.//*[contains(@class, "card-desc")]//*[contains(@class, "lang-text-tr")] | .//p//*[contains(@class, "lang-text-tr")]', $card)->item(0);
            $descEnNode = $xpath->query('.//*[contains(@class, "card-desc")]//*[contains(@class, "lang-text-en")] | .//p//*[contains(@class, "lang-text-en")]', $card)->item(0);
            $descTr = $descTrNode ? trim($descTrNode->textContent) : '';
            $descEn = $descEnNode ? trim($descEnNode->textContent) : '';

            $linkNode = $xpath->query('.//a', $card)->item(0);
            $href = '';
            if ($linkNode) {
                $href = $linkNode->getAttribute('href');
            } elseif ($card->nodeName === 'a') {
                $href = $card->getAttribute('href');
            }
            $slug = basename(parse_url($href, PHP_URL_PATH));
            if (empty($slug)) $slug = Str::slug($titleTr);

            if (!empty($titleTr) && !isset($seen[$titleTr])) {
                $seen[$titleTr] = true;

                if (!empty($imgSrc)) {
                    $this->downloadImage('https://dioreal.com/' . $imgSrc, $basePublic . '/' . $imgSrc, $context);
                }

                $journals[] = [
                    'date' => $date ?: date('d.m.Y'),
                    'title' => ['tr' => $titleTr, 'en' => $titleEn ?: $titleTr],
                    'tag' => ['tr' => $tagTr, 'en' => $tagEn ?: $tagTr],
                    'img' => $imgSrc ?: 'foto.img/amalfi.jpg',
                    'desc' => ['tr' => $descTr, 'en' => $descEn ?: $descTr],
                    'slug_tr' => $slug,
                    'slug_en' => $slug . '-en',
                    'seo_title_tr' => $titleTr . ' | Dioreal Dijital Lüks Yaşam Platformu',
                    'seo_title_en' => ($titleEn ?: $titleTr) . ' | Dioreal Digital Luxury Platform',
                    'seo_description_tr' => Str::limit(strip_tags($descTr), 155),
                    'seo_description_en' => Str::limit(strip_tags($descEn ?: $descTr), 155),
                    'gallery' => [],
                    'video_file' => null,
                    'video_url' => null,
                    'show_video_on_cover' => false,
                    'og_image' => null,
                    'seo_noindex' => 0
                ];
            }
        }

        if (!empty($journals)) {
            $jsonPath = storage_path('app/data/dioreal_journal_data.json');
            file_put_contents($jsonPath, json_encode($journals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private function downloadMissingImages($context, $basePublic)
    {
        $models = [Guide::class, Event::class, Journal::class, Hotel::class, Yacht::class, Restaurant::class, Destination::class];
        foreach ($models as $mClass) {
            foreach ($mClass::all() as $item) {
                if (!empty($item->img)) {
                    $imgClean = ltrim($item->img, '/');
                    $dest = $basePublic . '/' . $imgClean;
                    if (!file_exists($dest) || filesize($dest) === 0) {
                        $this->downloadImage('https://dioreal.com/' . $imgClean, $dest, $context);
                    }
                }
            }
        }
    }

    private function downloadImage($url, $destPath, $context)
    {
        if (file_exists($destPath) && filesize($destPath) > 0) return;

        $dir = dirname($destPath);
        if (!file_exists($dir)) {
            @mkdir($dir, 0775, true);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        $data = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code === 200 && !empty($data)) {
            @file_put_contents($destPath, $data);
            @chmod($destPath, 0644);
            $this->info("Downloaded image [200 OK]: {$url}");
        }
    }
}
