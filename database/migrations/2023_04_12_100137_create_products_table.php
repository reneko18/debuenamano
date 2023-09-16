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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->string('price');
            $table->text('description');
            $table->string('brand');
            $table->string('used_time');
            $table->foreignId('status_id');
            $table->foreignId('category_id');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('weight');
            $table->text('remark');
            $table->text('advice');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('address_id');
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
        Schema::dropIfExists('products');
    }
};
