<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpireinToPricingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('pricing_plans','expire_in')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->integer('expire_in')->after('plan_price')->default(0);
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
        if(Schema::hasColumn('pricing_plans','expire_in')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->dropColumn('expire_in');
            });
        }
    }
}
