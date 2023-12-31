<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name', 'father_name', 'email', 'phone', 'nid', 'nid_image', 'address', 'dob', 'mediator_name', 'mediator_phone'
    ];


    public function purchase()
    {
        return $this->belongsTo(purchase::class);
    }

}
