<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name'];
    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id');
    }
}
