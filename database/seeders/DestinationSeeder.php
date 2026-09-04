<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = storage_path('app/data/dioreal_destinations_data.json');
        if (File::exists($jsonPath)) {
            Destination::query()->delete();
            $data = json_decode(File::get($jsonPath), true);
            if (is_array($data)) {
                foreach ($data as $d) {
                    Destination::create([
                        'id' => $d['id'] ?? null,
                        'name' => $d['name'] ?? [],
                        'region' => $d['region'] ?? [],
                        'img' => $d['img'] ?? '',
                        'type' => $d['type'] ?? 'turkiye',
                        'order' => $d['order'] ?? 1,
                        'slug_tr' => $d['slug_tr'] ?? '',
                        'slug_en' => $d['slug_en'] ?? '',
                        'desc' => $d['desc'] ?? [],
                        'seo_title_tr' => $d['seo_title_tr'] ?? null,
                        'seo_title_en' => $d['seo_title_en'] ?? null,
                        'seo_description_tr' => $d['seo_description_tr'] ?? null,
                        'seo_description_en' => $d['seo_description_en'] ?? null,
                    ]);
                }
            }
        }
    }
}
