<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // product_id, product_code, product_stock, stock_status

    protected $fillable = [
        'product_id', 'product_code', 'product_stock', 'stock_status',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
