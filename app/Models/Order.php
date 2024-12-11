<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'seller_name', // نام فروشنده
        'order_date',   // تاریخ خرید
        'payment_method',
        'shipping_address',
    ];

    /**
     * رابطه با مدل User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * رابطه با مدل OrderItem.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
