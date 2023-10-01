<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //  id,supplier_id,product_id,purchase_invoice_no,purchase_quantity, purchase_rate, purchase_amount, purchase_amount_paid, purchase_balance_due, purchase_vat, purchase_discount,purchase_total_amount, sale_price, purchase_payment_type, purchase_payment_status,purchase_return_quantity, purchase_return_rate, purchase_return_amount, purchase_return_discount,purchase_return_vat,purchase_date

    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('purchase_invoice_no')->nullable();
            $table->integer('purchase_rate');
            $table->integer('purchase_quantity');
            $table->integer('purchase_amount');
            $table->integer('purchase_amount_paid')->nullable();
            $table->integer('purchase_balance_due')->nullable()->default(0);
            $table->integer('purchase_vat')->nullable()->default(0);
            $table->integer('purchase_discount')->nullable()->default(0);
            $table->integer('purchase_total_amount')->nullable();
            $table->integer('sale_price')->nullable();
            $table->string('purchase_payment_type')->nullable()->default('Cash');
            $table->boolean('purchase_payment_status')->default(1);
            $table->integer('purchase_return_quantity')->nullable();
            $table->integer('purchase_return_rate')->nullable();
            $table->integer('purchase_return_amount')->nullable();
            $table->integer('purchase_return_discount')->nullable()->default(0);
            $table->integer('purchase_return_vat')->nullable()->default(0);
            $table->date('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
