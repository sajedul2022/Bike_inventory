<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'father_name', 'email', 'phone', 'nid', 'nid_image', 'address','dob', 'mediator_name', 'mediator_phone'
    ];
}
