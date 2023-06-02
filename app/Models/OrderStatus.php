<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name'];
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_id');
    }

    public function orderStatusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class, 'order_status_id');
    }

    use HasFactory;
}
