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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('addressline');
        //     $table->string('town');
        //     $table->string('zipcode');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->text('imagePath')->default('images/employee.jpg');
        //     $table->rememberToken();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('fname');
            $table->string('lname');
            $table->string('addressline');
            $table->string('town');
            $table->string('zipcode');
            $table->text('imagePath')->default('images/employee.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('email')->unique();
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

        Schema::create('groomings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->double('price');
            $table->text('imagePath');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('grooming_id')->unsigned();
            $table->foreign('grooming_id')->references('id')->on('groomings');
            $table->text('comment');
            $table->timestamps();
        });

        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->text('description');
            $table->text('message');
            $table->text('comment')->nullable();
            $table->double('price')->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('groomings');
        Schema::dropIfExists('consultations');
        Schema::dropIfExists('users');
    }
};
