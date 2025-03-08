<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\FrontendCMS\Entities\PricingPlan;

class CreatePricingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->double('monthly_cost')->default(0);
            $table->double('yearly_cost')->default(0);
            $table->string('best_for')->nullable();
            $table->boolean('is_monthly')->default(1);
            $table->boolean('is_yearly')->default(0);
            $table->integer('discount_type')->default(0);
            $table->integer('discount')->default(0);
            $table->unsignedBigInteger('gst_tax_id')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_featured')->default(0);
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
        Schema::dropIfExists('pricing_plans');
    }
}
