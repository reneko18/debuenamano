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
            $table->foreignId('category_id');
            $table->string('genre');
            $table->string('age_ini')->nullable();
            $table->string('age_date_ini');
            $table->string('age_fin')->nullable();
            $table->string('age_date_fin')->nullable();
            $table->text('description');
            $table->string('brand');
            $table->string('model');
            $table->string('length');
            $table->string('length_unit');
            $table->string('width');
            $table->string('width_unit');
            $table->string('height');
            $table->string('height_unit');
            $table->string('weight');
            $table->string('weight_unit');
            $table->string('delivery_box');
            $table->string('status'); 
            $table->string('used_time');
            $table->string('used_time_unit');
            $table->text('remark');
            $table->text('advice');
            $table->string('price');  
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('publish_status')->nullable();
            $table->string('selling_status')->nullable();
            
            //Para después testear los siguientes datos (todo sera nullable)
            $table->string('sku')->nullable();
                      
            
                     

         
            
            //$table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
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
