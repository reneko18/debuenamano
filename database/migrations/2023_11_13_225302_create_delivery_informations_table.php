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
        Schema::create('delivery_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('length');
            $table->string('length_unit');
            $table->string('width');
            $table->string('width_unit');
            $table->string('height');
            $table->string('height_unit');
            $table->string('weight');
            $table->string('weight_unit');
            $table->string('option')->nullable();
            $table->string('region_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('city_code')->nullable();
            $table->string('chile_office')->nullable();
            $table->string('address')->nullable();
            $table->string('address_number')->nullable();
            $table->string('dpto_house')->nullable();
            $table->string('recover_price')->nullable();
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
        Schema::dropIfExists('delivery_informations');
    }
};
