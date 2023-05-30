<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'id',
        'user_id',
    ];
    use HasFactory;

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }
}
