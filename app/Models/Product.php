<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'auth_id', 'product_code', 'name', 'manufacturer', 'measurement_unit', 'detail', 'image', 'model', 'color', 'chassis_number', 'engine_number', 'cubic_capacity', 'reg_number', 'reg_date', 'product_status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

}
