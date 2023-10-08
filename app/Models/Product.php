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
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function purchase()
    {
        return $this->hasMany(purchase::class);
    }

    public function sale()
    {
        return $this->hasMany(sale::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
        // return $this->hasMany('App\Models\Stock');
    }

    // public function curriculums(){
    //     return $this->hasMany(Curriculum::class);
    // }

    // public function students() {
    //     return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
    // }


}
