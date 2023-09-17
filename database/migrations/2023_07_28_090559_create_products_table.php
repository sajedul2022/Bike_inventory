<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate();
            $table->unsignedBigInteger('category_id');
            $table->string('auth_id');
            $table->string('product_code');
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->longText('detail')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('cubic_capacity')->nullable();
            $table->string('reg_number')->nullable();
            $table->date('reg_date')->nullable();
            $table->string('image')->nullable();
            $table->boolean('product_status')->default(1);
            $table->timestamps();

            //auth_id, product_code, category_id, name, manufacturer, measurement_unit, detail, image, model, color, chassis_number, engine_number, cubic_capacity, reg_number, reg_date product_status

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
