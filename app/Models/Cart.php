<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id',
        'user_id',
    ];

    use HasFactory;
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
