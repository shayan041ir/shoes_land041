<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'discount',
    ];

    /**
     * رابطه با مدل Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * رابطه با مدل Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
