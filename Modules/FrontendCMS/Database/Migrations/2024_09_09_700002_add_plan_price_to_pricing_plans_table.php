<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanPriceToPricingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('pricing_plans','plan_price')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->integer('plan_price')->after('name')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('pricing_plans','plan_price')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->dropColumn('plan_price');
            });
        }
    }
}
