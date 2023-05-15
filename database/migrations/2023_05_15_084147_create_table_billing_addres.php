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
        Schema::create('table_billing_addres', function (Blueprint $table) {
            $table->id();
            $table->integer('u_id');
            $table->integer('c_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('addres');
            $table->string('add_t');
            $table->string('city');
            $table->string('state');
            $table->integer('city_code');
            $table->string('email');
            $table->integer('phone_number');
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
        Schema::dropIfExists('table_billing_addres');
    }
};
