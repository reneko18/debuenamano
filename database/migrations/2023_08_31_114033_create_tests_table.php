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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('genre');
            $table->string('ageini');
            $table->string('agedateini');
            $table->string('agefin');
            $table->string('agedatefin');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('height')->nullable();
            $table->string('heightunit')->nullable();
            $table->string('width')->nullable();
            $table->string('widthunit')->nullable();
            $table->string('long')->nullable();
            $table->string('longunit')->nullable();
            $table->string('weight')->nullable();
            $table->string('weightunit')->nullable();
            $table->string('usagetime')->nullable();
            $table->string('usagetimeunit')->nullable();
            $table->text('details')->nullable();
            $table->text('advice')->nullable();
            $table->string('addressdelivery')->nullable();
            $table->string('contactdelivery')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('price')->nullable();
            $table->string('nameaccount')->nullable();
            $table->string('bank')->nullable();
            $table->string('rut')->nullable();
            $table->string('banktype')->nullable();
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
        Schema::dropIfExists('tests');
    }
};
