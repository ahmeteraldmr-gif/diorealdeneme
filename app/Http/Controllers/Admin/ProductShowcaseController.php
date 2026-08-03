<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductShowcase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductShowcaseController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/showcases')
    {
        $destinationPath = public_path($folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    protected function ensureTableExists()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('product_showcases')) {
            \Illuminate\Support\Facades\Schema::create('product_showcases', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('image')->nullable();
                $table->json('eye')->nullable();
                $table->json('title')->nullable();
                $table->json('text')->nullable();
                $table->json('btn_text')->nullable();
                $table->string('btn_link')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function store(Request $request)
    {
        $this->ensureTableExists();

        $data = [
            'eye' => $request->input('eye', []),
            'title' => $request->input('title', []),
            'text' => $request->input('text', []),
            'btn_text' => $request->input('btn_text', []),
            'btn_link' => $request->input('btn_link'),
            'order' => (int)$request->input('order', 0),
            'is_active' => $request->has('is_active') ? (bool)$request->input('is_active') : true,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->handleFileUpload($request->file('image'));
        }

        ProductShowcase::create($data);

        return redirect()->back()->with('success', 'Yeni Vitrin Slide Görseli başarıyla eklendi.');
    }


    public function update(Request $request, $id)
    {
        $this->ensureTableExists();
        $showcase = ProductShowcase::findOrFail($id);

        $data = [
            'eye' => $request->input('eye', []),
            'title' => $request->input('title', []),
            'text' => $request->input('text', []),
            'btn_text' => $request->input('btn_text', []),
            'btn_link' => $request->input('btn_link'),
            'order' => (int)$request->input('order', 0),
            'is_active' => (bool)$request->input('is_active', true),
        ];

        if ($request->hasFile('image')) {
            if ($showcase->image && !str_starts_with($showcase->image, 'foto.img/')) {
                $oldPath = public_path($showcase->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $data['image'] = $this->handleFileUpload($request->file('image'));
        }

        $showcase->update($data);

        return redirect()->back()->with('success', 'Vitrin Slide Görseli başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $this->ensureTableExists();
        $showcase = ProductShowcase::findOrFail($id);

        if ($showcase->image && !str_starts_with($showcase->image, 'foto.img/')) {
            $oldPath = public_path($showcase->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $showcase->delete();

        return redirect()->back()->with('success', 'Vitrin Slide Görseli başarıyla silindi.');
    }

}
