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
            $table->foreignId('age_filter_id');
            $table->foreignId('gender_id');
            $table->text('description');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('length_real')->nullable();
            $table->string('length_real_unit')->nullable();
            $table->string('width_real')->nullable();
            $table->string('width_real_unit')->nullable();
            $table->string('height_real')->nullable();
            $table->string('height_real_unit')->nullable();
            $table->string('status')->nullable();
            $table->string('used_time')->nullable();
            $table->string('used_time_unit')->nullable();
            $table->text('remark')->nullable();
            $table->text('advice')->nullable();
            $table->string('price')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('publish_status')->nullable();
            $table->string('selling_status')->nullable();
            $table->string('admin_status')->nullable();           
            $table->string('visible_status')->nullable();           
            $table->string('payment_status')->nullable();           
            $table->string('sell_date')->nullable();               
            $table->string('payment_date')->nullable();               
           
            //Para después testear los siguientes datos (todo sera nullable)
            $table->string('sku')->nullable();        
            
            //$table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('main_step')->nullable();
            $table->string('active_title')->nullable();
            $table->string('received_constant')->nullable();
            $table->string('current_step')->nullable();
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
