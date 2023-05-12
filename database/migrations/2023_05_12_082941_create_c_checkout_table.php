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
        Schema::create('c_checkout', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('order_id');
            $table->text('cart_id');
            $table->text('case_id');
            $table->text('cart_amount');
            $table->text('total_amount');
            $table->text('patient_firstname');
            $table->text('patient_lastname');
            $table->text('email');
            $table->text('shipping_fee');
            $table->text('shipping_method');
            $table->text('shipping_addreess_id');
            $table->text('billing_address_id');
            $table->text('card_number');
            $table->text('card_name');
            $table->text('address_type');
            $table->text('pharmacy_detail');
            $table->text('medication_type');
            $table->text('plan_id');
            $table->text('plan_quantity');
            $table->text('ipladege_id');
            $table->text('delivery_date');
            $table->text('md_case_id');
            $table->text('md_status');
            $table->text('telemedicine_fee');
            $table->text('lowincome_fee');
            $table->text('handling_fee');
            $table->text('tax');
            $table->text('gift_code_discount');
            $table->text('status');
            $table->text('order_detail_id');
            $table->text('transaction_id');
            $table->text('customer');
            $table->text('payment_method');
            $table->text('payment_status');
            $table->text('transaction_complete_details');
            $table->text('strip_refund_object');
            $table->text('birthcontrol_fee');
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
        Schema::dropIfExists('c_checkout');
    }
};
