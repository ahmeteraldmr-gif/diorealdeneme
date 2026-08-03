<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/products')
    {
        $destinationPath = public_path($folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    public function index()
    {
        $products = Product::with('category')->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $showcases = \App\Models\ProductShowcase::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $settings = \App\Models\Setting::pluck('value', 'key')->all();
        return view('admin.products.index', compact('products', 'showcases', 'settings'));
    }



    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('order', 'asc')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:product_categories,id',
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'details.tr' => 'nullable|string|max:255',
            'details.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:20480',
            'image_url' => 'nullable|string',
            'image_hover_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:20480',
            'image_hover_url' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->input('image_url', 'foto.img/hero_4k.jpg');
        if ($request->hasFile('image_file')) {
            $imagePath = $this->handleFileUpload($request->file('image_file'));
        }

        $imageHoverPath = $request->input('image_hover_url');
        if ($request->hasFile('image_hover_file')) {
            $imageHoverPath = $this->handleFileUpload($request->file('image_hover_file'));
        }

        Product::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'tag' => $request->input('tag'),
            'details' => $request->input('details'),
            'desc' => $request->input('desc'),
            'price' => $request->input('price', 0),
            'image' => $imagePath,
            'image_hover' => $imageHoverPath,
            'order' => $request->input('order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Ürün / Paket başarıyla eklendi.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('order', 'asc')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'nullable|exists:product_categories,id',
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'details.tr' => 'nullable|string|max:255',
            'details.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:20480',
            'image_url' => 'nullable|string',
            'image_hover_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:20480',
            'image_hover_url' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $this->handleFileUpload($request->file('image_file'));
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        $imageHoverPath = $product->image_hover;
        if ($request->hasFile('image_hover_file')) {
            $imageHoverPath = $this->handleFileUpload($request->file('image_hover_file'));
        } elseif ($request->filled('image_hover_url')) {
            $imageHoverPath = $request->input('image_hover_url');
        }

        $product->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'tag' => $request->input('tag'),
            'details' => $request->input('details'),
            'desc' => $request->input('desc'),
            'price' => $request->input('price', 0),
            'image' => $imagePath,
            'image_hover' => $imageHoverPath,
            'order' => $request->input('order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Ürün / Paket başarıyla güncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Ürün / Paket silindi.');
    }
}
