<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', 'product_id', 'purchase_invoice_no', 'purchase_quantity', 'purchase_rate', 'purchase_amount', 'purchase_vat', 'purchase_discount', 'purchase_amount_paid', 'purchase_balance_due',  'purchase_total_amount', 'sale_price', 'purchase_payment_type', 'purchase_payment_status', 'purchase_date', 'purchase_return_quantity', 'purchase_return_rate', 'purchase_return_amount', 'purchase_return_discount', 'purchase_return_vat',
    ];

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function product()
    {
        return $this->belongsTo(purchase::class);
    }
    
}
