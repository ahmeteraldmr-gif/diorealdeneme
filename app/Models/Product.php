<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $casts = [
        'name' => 'array',
        'desc' => 'array',
        'details' => 'array',
        'tag' => 'array',
        'price' => 'float',
        'is_active' => 'boolean',
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
