<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
