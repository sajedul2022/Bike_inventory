<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;

      //  id,customer_id,product_id,sales_invoice_no, sale_price, sales_quantity, sales_amount, sales_amount_paid, sales_balance_due, sales_vat, sales_discount, sales_total_amount, sales_payment_type, sales_payment_status,sales_return_quantity, sales_return_rate, sales_return_amount, sales_return_discount,sales_return_vat,sales_date

    protected $fillable = [
        'customer_id', 'product_id', 'sales_invoice_no', 'sale_price', 'sales_quantity','sales_amount', 'sales_amount_paid', 'sales_balance_due', 'sales_vat', 'sales_discount', 'sales_total_amount','sales_payment_type', 'sales_payment_status', 'sales_return_quantity', 'sales_return_rate', 'sales_return_amount', 'sales_return_discount', 'sales_return_vat', 'sales_date',
    ];

}
