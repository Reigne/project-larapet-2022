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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('imagePath')->default('images/customer.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->text('species');
            $table->text('breed');
            $table->text('name');
            $table->text('gender');
            $table->text('color');
            $table->text('age');
            $table->text('imagePath')->default('images/pet.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('consultationInfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->timestamps();
        });

        Schema::create('consultationLine', function (Blueprint $table) {
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->text('description');
            $table->text('message');
            $table->text('comment');
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
        Schema::dropIfExists('customers');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('consultations');
        Schema::dropIfExists('consultationInfo');
        Schema::dropIfExists('consultationLine');
    }
};
