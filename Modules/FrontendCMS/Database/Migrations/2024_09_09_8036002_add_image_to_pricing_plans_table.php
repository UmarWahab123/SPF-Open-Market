<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToPricingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('pricing_plans','image')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->text('image')->nullable()->after('is_featured');
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
        if(Schema::hasColumn('pricing_plans','expiimagere_in')){
            Schema::table('pricing_plans', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
}
