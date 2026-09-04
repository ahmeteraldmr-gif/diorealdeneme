<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;
use App\Models\Destination;

class PageController extends Controller
{
    private function resolveDetailModel($modelClass, $slug_or_id, string $routeName)
    {
        $item = $modelClass::where('slug_tr', $slug_or_id)
            ->orWhere('slug_en', $slug_or_id)
            ->orWhere('id', $slug_or_id)
            ->first();

        if (!$item) {
            abort(404);
        }

        // If accessed by numeric ID, 301 redirect to canonical slug URL
        if (is_numeric($slug_or_id)) {
            $canonicalSlug = $item->slug_tr ?: ($item->slug_en ?: $item->id);
            if ($canonicalSlug != $slug_or_id) {
                return redirect()->route($routeName, $canonicalSlug, 301);
            }
        }

        return $item;
    }

    public function index()
    {
        $destinations = Destination::orderBy('order')->get()->groupBy('type');
        $seo = get_page_seo('home');
        $activeLang = get_active_locale();
        $canonical = route('home', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('home', ['lang' => 'tr']);
        $hreflang_en = route('home', ['lang' => 'en']);

        return view("index", compact("destinations", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function hakkimizda()
    {
        $seo = get_page_seo('hakkimizda');
        $activeLang = get_active_locale();
        $canonical = route('hakkimizda', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('hakkimizda', ['lang' => 'tr']);
        $hreflang_en = route('hakkimizda', ['lang' => 'en']);

        return view("hakkimizda", compact("seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function oteller()
    {
        $oteller = Hotel::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        $seo = get_page_seo('oteller');
        $activeLang = get_active_locale();
        $canonical = route('oteller', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('oteller', ['lang' => 'tr']);
        $hreflang_en = route('oteller', ['lang' => 'en']);
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view("oteller", compact("oteller", "seo", "canonical", "hreflang_tr", "hreflang_en", "settings"));
    }

    public function yatlar()
    {
        $yatlar = Yacht::all();
        $seo = get_page_seo('yatlar');
        $activeLang = get_active_locale();
        $canonical = route('yatlar', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('yatlar', ['lang' => 'tr']);
        $hreflang_en = route('yatlar', ['lang' => 'en']);
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view("yatlar", compact("yatlar", "seo", "canonical", "hreflang_tr", "hreflang_en", "settings"));
    }

    public function restoranlar()
    {
        $restoranlar = Restaurant::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        $seo = get_page_seo('restoranlar');
        $activeLang = get_active_locale();
        $canonical = route('restoranlar', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('restoranlar', ['lang' => 'tr']);
        $hreflang_en = route('restoranlar', ['lang' => 'en']);
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view("restoranlar", compact("restoranlar", "seo", "canonical", "hreflang_tr", "hreflang_en", "settings"));
    }


    public function geziRehberi()
    {
        $rehberler = Guide::paginate(9);
        $seo = get_page_seo('gezi-rehberi');
        $activeLang = get_active_locale();
        $canonical = route('gezi-rehberi', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('gezi-rehberi', ['lang' => 'tr']);
        $hreflang_en = route('gezi-rehberi', ['lang' => 'en']);

        return view("destinasyonlar", compact("rehberler", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function etkinlikler()
    {
        $etkinlikler = Event::all();
        $seo = get_page_seo('etkinlikler');
        $activeLang = get_active_locale();
        $canonical = route('etkinlikler', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('etkinlikler', ['lang' => 'tr']);
        $hreflang_en = route('etkinlikler', ['lang' => 'en']);

        return view("etkinlikler", compact("etkinlikler", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function journal()
    {
        $journals = Journal::all();
        $seo = get_page_seo('journal');
        $activeLang = get_active_locale();
        $canonical = route('journal', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('journal', ['lang' => 'tr']);
        $hreflang_en = route('journal', ['lang' => 'en']);

        return view("journal", compact("journals", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function otelDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Hotel::class, $slug_or_id, 'otel.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $otel = $result;

        $slugTr = $otel->slug_tr ?: $otel->id;
        $slugEn = $otel->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('otel.detay', $activeSlug);
        $hreflang_tr = route('otel.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('otel.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("otel-detay", compact("otel", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function restoranDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Restaurant::class, $slug_or_id, 'restoran.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $restoran = $result;

        $slugTr = $restoran->slug_tr ?: $restoran->id;
        $slugEn = $restoran->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('restoran.detay', $activeSlug);
        $hreflang_tr = route('restoran.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('restoran.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("restoran-detay", compact("restoran", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function journalDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Journal::class, $slug_or_id, 'journal.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $journal = $result;

        $related = Journal::where('id', '!=', $journal->id)->latest()->take(4)->get();

        $slugTr = $journal->slug_tr ?: $journal->id;
        $slugEn = $journal->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('journal.detay', $activeSlug);
        $hreflang_tr = route('journal.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('journal.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("journal-detay", compact("journal", "related", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function destinasyonDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Destination::class, $slug_or_id, 'destinasyon.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $destination = $result;
        
        $hotels = Hotel::where('destination_id', $destination->id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $restaurants = Restaurant::where('destination_id', $destination->id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $journals = Journal::where('destination_id', $destination->id)
            ->latest()
            ->get();

        $slugTr = $destination->slug_tr ?: $destination->id;
        $slugEn = $destination->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('destinasyon.detay', $activeSlug);
        $hreflang_tr = route('destinasyon.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('destinasyon.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);
            
        return view("destinasyon-detay", compact("destination", "hotels", "restaurants", "journals", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function etkinlikDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Event::class, $slug_or_id, 'etkinlik.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $etkinlik = $result;
        $event = $result;

        $slugTr = $etkinlik->slug_tr ?: $etkinlik->id;
        $slugEn = $etkinlik->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('etkinlik.detay', $activeSlug);
        $hreflang_tr = route('etkinlik.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('etkinlik.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("etkinlik-detay", compact("etkinlik", "event", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function rehberDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Guide::class, $slug_or_id, 'rehber.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $rehber = $result;

        $otherGuides = Guide::where('id', '!=', $rehber->id)->get();

        $slugTr = $rehber->slug_tr ?: $rehber->id;
        $slugEn = $rehber->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('rehber.detay', $activeSlug);
        $hreflang_tr = route('rehber.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('rehber.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("rehber-detay", compact("rehber", "otherGuides", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function yatDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Yacht::class, $slug_or_id, 'yat.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $yat = $result;

        $slugTr = $yat->slug_tr ?: $yat->id;
        $slugEn = $yat->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('yat.detay', $activeSlug);
        $hreflang_tr = route('yat.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('yat.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("yat-detay", compact("yat", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function sepet()
    {
        $seo = get_page_seo('sepet');
        $activeLang = get_active_locale();
        $canonical = route('sepet', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('sepet', ['lang' => 'tr']);
        $hreflang_en = route('sepet', ['lang' => 'en']);

        $cart = session()->get('cart_items', []);

        return view("sepet", compact("seo", "canonical", "hreflang_tr", "hreflang_en", "cart"));
    }

    public function cartAdd(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $price = (float)$request->input('price');
        $image = $request->input('image');
        $type = $request->input('type', 'Lüks Paket');
        $details = $request->input('details', '');

        $cart = session()->get('cart_items', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int)($cart[$id]['quantity'] ?? 1) + 1;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'type' => $type,
                'details' => $details,
                'quantity' => 1
            ];
        }

        session()->put('cart_items', $cart);

        $totalCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total_count' => $totalCount
        ]);
    }

    public function cartRemove(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart_items', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart_items', $cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function cartUpdate(Request $request)
    {
        $id = $request->input('id');
        $delta = (int)$request->input('delta', 0);
        $cart = session()->get('cart_items', []);

        if (isset($cart[$id])) {
            $newQty = (int)$cart[$id]['quantity'] + $delta;
            if ($newQty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $newQty;
            }
        }

        session()->put('cart_items', $cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function urunler()
    {
        $seo = get_page_seo('urunler');
        $activeLang = get_active_locale();
        $canonical = route('urunler', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('urunler', ['lang' => 'tr']);
        $hreflang_en = route('urunler', ['lang' => 'en']);

        $categories = \App\Models\ProductCategory::where('is_active', true)->orderBy('order', 'asc')->get();
        $products = \App\Models\Product::with('category')->where('is_active', true)->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $showcases = \App\Models\ProductShowcase::where('is_active', true)->orderBy('order', 'asc')->get();
        $locale = $activeLang;
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view("urunler", compact("seo", "canonical", "hreflang_tr", "hreflang_en", "categories", "products", "showcases", "locale", "settings"));
    }





}


