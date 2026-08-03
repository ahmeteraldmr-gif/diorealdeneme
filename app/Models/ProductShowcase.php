<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductShowcase extends Model
{
    protected $fillable = [
        'image',
        'eye',
        'title',
        'text',
        'btn_text',
        'btn_link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'eye' => 'array',
        'title' => 'array',
        'text' => 'array',
        'btn_text' => 'array',
        'is_active' => 'boolean',
    ];
}

