<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Agency;


class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discounted_price',
        'stock',
        'category_id',
        'agency_id',
        'images'
    ];
    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
