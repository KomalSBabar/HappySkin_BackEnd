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
        Schema::create('table_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('card_number');
            $table->integer('card_name');
            $table->date('expiry_date');
            $table->integer('cvc_code');
            $table->boolean('address');
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
        Schema::dropIfExists('table_cards');
    }
};
