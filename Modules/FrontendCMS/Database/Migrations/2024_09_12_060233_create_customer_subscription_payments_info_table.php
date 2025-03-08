<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSubscriptionPaymentsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_subscription_payment_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); 
            $table->string('subscription_type')->nullable(); 
            $table->string('commission_type')->nullable();
            $table->text('transaction_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers_subscription')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_subscription_payment_info');
    }
}
