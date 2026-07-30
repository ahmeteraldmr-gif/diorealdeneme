<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class ProductCategory extends Model
{
    use HasTranslations;

    protected $casts = [
        'name' => 'array',
        'is_active' => 'boolean',
    ];

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->orderBy('order', 'asc');
    }
}
