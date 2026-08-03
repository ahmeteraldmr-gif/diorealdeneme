<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * File upload helper.
     */
    protected function handleFileUpload($file, $folder = 'uploads/brands')
    {
        $destinationPath = public_path($folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    /**
     * Show general settings page.
     */
    public function index()
    {
        $settings = [];
        foreach (Setting::all() as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update general text settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:100',
            'contact_address_tr' => 'nullable|string|max:500',
            'contact_address_en' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'footer_copy' => 'nullable|string|max:255',
            'hero_title_tr' => 'nullable|string|max:500',
            'hero_title_en' => 'nullable|string|max:500',
            'google_analytics' => 'nullable|string',
            'google_search_console' => 'nullable|string',

            // Marquee Ticker Announcement Settings
            'ticker_text1_tr' => 'nullable|string|max:255',
            'ticker_text1_en' => 'nullable|string|max:255',
            'ticker_high1_tr' => 'nullable|string|max:255',
            'ticker_high1_en' => 'nullable|string|max:255',
            'ticker_text2_tr' => 'nullable|string|max:255',
            'ticker_text2_en' => 'nullable|string|max:255',
            'ticker_high2_tr' => 'nullable|string|max:255',
            'ticker_high2_en' => 'nullable|string|max:255',
            'ticker_text3_tr' => 'nullable|string|max:255',
            'ticker_text3_en' => 'nullable|string|max:255',
            'ticker_high3_tr' => 'nullable|string|max:255',
            'ticker_high3_en' => 'nullable|string|max:255',

            // Homepage selection (Manifesto)

            'man_eyebrow_tr' => 'nullable|string|max:255',
            'man_eyebrow_en' => 'nullable|string|max:255',
            'man_p1_tr' => 'nullable|string|max:1000',
            'man_p1_en' => 'nullable|string|max:1000',

            // Trends
            'trend_otel_title_tr' => 'nullable|string|max:255',
            'trend_otel_title_en' => 'nullable|string|max:255',
            'trend_otel_desc_tr' => 'nullable|string|max:500',
            'trend_otel_desc_en' => 'nullable|string|max:500',

            'trend_rest_title_tr' => 'nullable|string|max:255',
            'trend_rest_title_en' => 'nullable|string|max:255',
            'trend_rest_desc_tr' => 'nullable|string|max:500',
            'trend_rest_desc_en' => 'nullable|string|max:500',

            'trend_yat_title_tr' => 'nullable|string|max:255',
            'trend_yat_title_en' => 'nullable|string|max:255',
            'trend_yat_desc_tr' => 'nullable|string|max:500',
            'trend_yat_desc_en' => 'nullable|string|max:500',

            'trend_beach_title_tr' => 'nullable|string|max:255',
            'trend_beach_title_en' => 'nullable|string|max:255',
            'trend_beach_desc_tr' => 'nullable|string|max:500',
            'trend_beach_desc_en' => 'nullable|string|max:500',

            // About page fields
            'about_hero_eyebrow_tr' => 'nullable|string|max:255',
            'about_hero_eyebrow_en' => 'nullable|string|max:255',
            'about_hero_title_tr' => 'nullable|string|max:255',
            'about_hero_title_en' => 'nullable|string|max:255',

            'about_story_eyebrow_tr' => 'nullable|string|max:255',
            'about_story_eyebrow_en' => 'nullable|string|max:255',
            'about_story_title_tr' => 'nullable|string|max:255',
            'about_story_title_en' => 'nullable|string|max:255',
            'about_story_p1_tr' => 'nullable|string|max:1000',
            'about_story_p1_en' => 'nullable|string|max:1000',
            'about_story_p2_tr' => 'nullable|string|max:1000',
            'about_story_p2_en' => 'nullable|string|max:1000',

            'about_stats_title_tr' => 'nullable|string|max:255',
            'about_stats_title_en' => 'nullable|string|max:255',

            'about_stat1_num' => 'nullable|string|max:50',
            'about_stat1_label_tr' => 'nullable|string|max:255',
            'about_stat1_label_en' => 'nullable|string|max:255',

            'about_stat2_num' => 'nullable|string|max:50',
            'about_stat2_label_tr' => 'nullable|string|max:255',
            'about_stat2_label_en' => 'nullable|string|max:255',

            'about_stat3_num' => 'nullable|string|max:50',
            'about_stat3_label_tr' => 'nullable|string|max:255',
            'about_stat3_label_en' => 'nullable|string|max:255',

            'about_stat4_num' => 'nullable|string|max:50',
            'about_stat4_label_tr' => 'nullable|string|max:255',
            'about_stat4_label_en' => 'nullable|string|max:255',

            'about_mission_eyebrow_tr' => 'nullable|string|max:255',
            'about_mission_eyebrow_en' => 'nullable|string|max:255',
            'about_mission_title_tr' => 'nullable|string|max:255',
            'about_mission_title_en' => 'nullable|string|max:255',
            'about_mission_p1_tr' => 'nullable|string|max:1000',
            'about_mission_p1_en' => 'nullable|string|max:1000',
            'about_mission_p2_tr' => 'nullable|string|max:1000',
            'about_mission_p2_en' => 'nullable|string|max:1000',

            // Image uploads
            'hero_slide_1' => 'nullable|image|max:5120',
            'hero_slide_2' => 'nullable|image|max:5120',
            'hero_slide_3' => 'nullable|image|max:5120',
            'trend_otel_img' => 'nullable|image|max:5120',
            'trend_rest_img' => 'nullable|image|max:5120',
            'trend_yat_img' => 'nullable|image|max:5120',
            'trend_beach_img' => 'nullable|image|max:5120',
            'about_hero_img' => 'nullable|image|max:5120',
            'about_story_img' => 'nullable|image|max:5120',
            'about_mission_img' => 'nullable|image|max:5120',
        ]);

        $fields = [
            'contact_email',
            'contact_phone',
            'contact_address_tr',
            'contact_address_en',
            'instagram',
            'linkedin',
            'whatsapp',
            'footer_copy',
            'hero_title_tr',
            'hero_title_en',
            'google_analytics',
            'google_search_console',

            'ticker_text1_tr',
            'ticker_text1_en',
            'ticker_high1_tr',
            'ticker_high1_en',
            'ticker_text2_tr',
            'ticker_text2_en',
            'ticker_high2_tr',
            'ticker_high2_en',
            'ticker_text3_tr',
            'ticker_text3_en',
            'ticker_high3_tr',
            'ticker_high3_en',

            'man_eyebrow_tr',

            'man_eyebrow_en',
            'man_p1_tr',
            'man_p1_en',

            'trend_otel_title_tr',
            'trend_otel_title_en',
            'trend_otel_desc_tr',
            'trend_otel_desc_en',

            'trend_rest_title_tr',
            'trend_rest_title_en',
            'trend_rest_desc_tr',
            'trend_rest_desc_en',

            'trend_yat_title_tr',
            'trend_yat_title_en',
            'trend_yat_desc_tr',
            'trend_yat_desc_en',

            'trend_beach_title_tr',
            'trend_beach_title_en',
            'trend_beach_desc_tr',
            'trend_beach_desc_en',

            'about_hero_eyebrow_tr',
            'about_hero_eyebrow_en',
            'about_hero_title_tr',
            'about_hero_title_en',

            'about_story_eyebrow_tr',
            'about_story_eyebrow_en',
            'about_story_title_tr',
            'about_story_title_en',
            'about_story_p1_tr',
            'about_story_p1_en',
            'about_story_p2_tr',
            'about_story_p2_en',

            'about_stats_title_tr',
            'about_stats_title_en',

            'about_stat1_num',
            'about_stat1_label_tr',
            'about_stat1_label_en',

            'about_stat2_num',
            'about_stat2_label_tr',
            'about_stat2_label_en',

            'about_stat3_num',
            'about_stat3_label_tr',
            'about_stat3_label_en',

            'about_stat4_num',
            'about_stat4_label_tr',
            'about_stat4_label_en',

            'about_mission_eyebrow_tr',
            'about_mission_eyebrow_en',
            'about_mission_title_tr',
            'about_mission_title_en',
            'about_mission_p1_tr',
            'about_mission_p1_en',
            'about_mission_p2_tr',
            'about_mission_p2_en',

            // Oteller Page Settings
            'otel_hero_eyebrow_tr',
            'otel_hero_eyebrow_en',
            'otel_hero_title_tr',
            'otel_hero_title_en',
            'otel_intro_title_tr',
            'otel_intro_title_en',
            'otel_intro_text_tr',
            'otel_intro_text_en',

            // Restoranlar Page Settings
            'rest_hero_eyebrow_tr',
            'rest_hero_eyebrow_en',
            'rest_hero_title_tr',
            'rest_hero_title_en',
            'rest_intro_eyebrow_tr',
            'rest_intro_eyebrow_en',
            'rest_intro_title_tr',
            'rest_intro_title_en',
            'rest_intro_text_tr',
            'rest_intro_text_en',

            // Yatlar Page Settings
            'yat_hero_eyebrow_tr',
            'yat_hero_eyebrow_en',
            'yat_hero_title_tr',
            'yat_hero_title_en',
            'yat_intro_eyebrow_tr',
            'yat_intro_eyebrow_en',
            'yat_intro_title_tr',
            'yat_intro_title_en',
            'yat_intro_text_tr',
            'yat_intro_text_en',

            // Yatlar Route Section Settings
            'yat_route_eyebrow_tr',
            'yat_route_eyebrow_en',
            'yat_route_title_tr',
            'yat_route_title_en',
            'yat_route_text_tr',
            'yat_route_text_en',
            'yat_route_btn_tr',
            'yat_route_btn_en',
            'yat_route_btn_link',

            // Product Page Showcase Slider 1
            'ecom_slide1_eye_tr',
            'ecom_slide1_eye_en',
            'ecom_slide1_title_tr',
            'ecom_slide1_title_en',
            'ecom_slide1_text_tr',
            'ecom_slide1_text_en',
            'ecom_slide1_btn_tr',
            'ecom_slide1_btn_en',

            // Product Page Showcase Slider 2
            'ecom_slide2_eye_tr',
            'ecom_slide2_eye_en',
            'ecom_slide2_title_tr',
            'ecom_slide2_title_en',
            'ecom_slide2_text_tr',
            'ecom_slide2_text_en',
            'ecom_slide2_btn_tr',
            'ecom_slide2_btn_en',

            // Product Page Showcase Slider 3
            'ecom_slide3_eye_tr',
            'ecom_slide3_eye_en',
            'ecom_slide3_title_tr',
            'ecom_slide3_title_en',
            'ecom_slide3_text_tr',
            'ecom_slide3_text_en',
            'ecom_slide3_btn_tr',
            'ecom_slide3_btn_en',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field));
        }

        // Image uploads
        $imageFields = [
            'hero_slide_1',
            'hero_slide_2',
            'hero_slide_3',
            'trend_otel_img',
            'trend_rest_img',
            'trend_yat_img',
            'trend_beach_img',
            'about_hero_img',
            'about_story_img',
            'about_mission_img',

            'otel_hero_img',
            'rest_hero_img',
            'rest_intro_img',
            'yat_hero_img',
            'yat_intro_img',
            'yat_route_img',

            'ecom_slide1_img',
            'ecom_slide2_img',
            'ecom_slide3_img',
        ];



        foreach ($imageFields as $imgField) {
            if ($request->hasFile($imgField)) {
                // Delete old file if exists
                $oldPath = Setting::get($imgField);
                if ($oldPath && !str_starts_with($oldPath, 'foto.img/')) {
                    $oldFilePath = public_path($oldPath);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }
                
                $path = $this->handleFileUpload($request->file($imgField), 'uploads/settings');
                Setting::set($imgField, $path);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Genel ayarlar başarıyla güncellendi.');
    }

    /**
     * Add a brand reference with uploaded logo.
     */
    public function addBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_logo' => 'required|image|max:2048',
        ]);

        $brands = Setting::get('brands', []);
        if (!is_array($brands)) {
            $brands = [];
        }

        $logoPath = $this->handleFileUpload($request->file('brand_logo'));

        $brands[] = [
            'name' => $request->input('brand_name'),
            'img' => $logoPath,
        ];

        Setting::set('brands', $brands);

        return redirect()->route('admin.settings.index')->with('success', 'Marka referansı başarıyla eklendi.');
    }

    /**
     * Delete a brand reference.
     */
    public function deleteBrand(int $index)
    {
        $brands = Setting::get('brands', []);
        if (is_array($brands) && isset($brands[$index])) {
            $brand = $brands[$index];
            
            // Delete file if it's physically stored and not a seeded data SVG URL
            if (isset($brand['img']) && !str_starts_with($brand['img'], 'data:')) {
                $filePath = public_path($brand['img']);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            unset($brands[$index]);
            // Reset numerical array keys to avoid associative array serialization
            $brands = array_values($brands);
            Setting::set('brands', $brands);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Marka referansı başarıyla silindi.');
    }

    /**
     * Update an existing brand reference.
     */
    public function updateBrand(Request $request, int $index)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_logo' => 'nullable|image|max:2048',
        ]);

        $brands = Setting::get('brands', []);
        if (!is_array($brands) || !isset($brands[$index])) {
            return redirect()->route('admin.settings.index')->with('error', 'Düzenlenecek marka bulunamadı.');
        }

        $brand = $brands[$index];
        $logoPath = $brand['img'];

        if ($request->hasFile('brand_logo')) {
            // Delete old file if physically stored and not seeded data SVG URL
            if ($logoPath && !str_starts_with($logoPath, 'data:')) {
                $filePath = public_path($logoPath);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            $logoPath = $this->handleFileUpload($request->file('brand_logo'));
        }

        $brands[$index] = [
            'name' => $request->input('brand_name'),
            'img' => $logoPath,
        ];

        Setting::set('brands', $brands);

        return redirect()->route('admin.settings.index')->with('success', 'Marka referansı başarıyla güncellendi.');
    }
}
