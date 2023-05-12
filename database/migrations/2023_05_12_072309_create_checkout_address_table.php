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
        Schema::create('checkout_address', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->text('patient_firstname');
            $table->text('patient_lastname');
            $table->text('addressline1');
            $table->text('addressline2');
            $table->text('city');
            $table->text('state');
            $table->text('zipcode');
            $table->text('state_long');
            $table->text('phone');
            $table->text('email');
            $table->text('address_type');
            $table->integer('cart_id');

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
        Schema::dropIfExists('checkout_address');
    }
};
