<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount('products')->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name.tr'));
        if (empty($slug)) {
            $slug = 'kat-' . time();
        }

        ProductCategory::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'order' => $request->input('order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla eklendi.');
    }

    public function edit(ProductCategory $category)
    {
        return view('admin.product_categories.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $category->id,
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name.tr'));

        $category->update([
            'name' => $request->input('name'),
            'slug' => $slug,
            'order' => $request->input('order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori silindi.');
    }
}
