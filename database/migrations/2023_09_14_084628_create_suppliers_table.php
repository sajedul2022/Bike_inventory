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
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {

            $table->id();
            $table->string('supplier_name');
            $table->string('father_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone');
            $table->integer('nid')->nullable();
            $table->string('nid_image')->nullable();
            $table->date('dob')->nullable();
            $table->string('mediator_name')->nullable();
            $table->integer('mediator_phone')->nullable();
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
