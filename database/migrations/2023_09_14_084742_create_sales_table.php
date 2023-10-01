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

    //  id,customer_id,product_id,sales_invoice_no, sale_price, sales_quantity, sales_amount, sales_amount_paid, sales_balance_due, sales_vat, sales_discount, sales_total_amount, sales_payment_type, sales_payment_status,sales_return_quantity, sales_return_rate, sales_return_amount, sales_return_discount,sales_return_vat,sales_date

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('sales_invoice_no')->nullable();
            $table->integer('sale_price');
            $table->integer('sales_quantity');
            $table->integer('sales_amount');
            $table->integer('sales_amount_paid')->nullable();
            $table->integer('sales_balance_due')->nullable()->default(0);
            $table->integer('sales_vat')->nullable()->default(0);
            $table->integer('sales_discount')->nullable()->default(0);
            $table->integer('sales_total_amount')->nullable();
            $table->string('sales_payment_type')->nullable()->default('Cash');
            $table->boolean('sales_payment_status')->default(1);
            $table->integer('sales_return_quantity')->nullable();
            $table->integer('sales_return_rate')->nullable();
            $table->integer('sales_return_amount')->nullable();
            $table->integer('sales_return_discount')->nullable()->default(0);
            $table->integer('sales_return_vat')->nullable()->default(0);
            $table->date('sales_date')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
