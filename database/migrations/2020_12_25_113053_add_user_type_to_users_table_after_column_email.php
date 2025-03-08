<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTypeToUsersTableAfterColumnEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_verified')->default(0)->after('email');
            $table->string('verify_code')->after('is_verified')->nullable();
        });
    }





    // ALTER TABLE users
    // ADD COLUMN company_name VARCHAR(255) NOT NULL,
    // ADD COLUMN billing_address TEXT NOT NULL,
    // ADD COLUMN shipping_address TEXT NOT NULL,
    // ADD COLUMN commercial_or_residential VARCHAR(50) NOT NULL,
    // ADD COLUMN loading_dock VARCHAR(50) NOT NULL,
    // ADD COLUMN forklift VARCHAR(50) NOT NULL,
    // ADD COLUMN pallet_jack VARCHAR(50) NOT NULL,
    // ADD COLUMN hours VARCHAR(100) NOT NULL,
    // ADD COLUMN call_ahead VARCHAR(50) NOT NULL,
    // ADD COLUMN special_instructions TEXT,
    // ADD COLUMN accounts_payable_contact_name VARCHAR(255) NOT NULL,
    // ADD COLUMN accounts_payable_number VARCHAR(50) NOT NULL,
    // ADD COLUMN accounts_payable_email VARCHAR(255) NOT NULL,
    // ADD COLUMN general_liability VARCHAR(255),
    // ADD COLUMN preferred_language VARCHAR(50),
    // ADD COLUMN years_in_business INT NOT NULL,
    // ADD COLUMN number_of_locations INT,
    // ADD COLUMN primary_business_function VARCHAR(255),
    // ADD COLUMN number_of_rigs INT,
    // ADD COLUMN monthly_volume INT,
    // ADD COLUMN open_cell_volume INT,
    // ADD COLUMN closed_cell_volume INT,
    // ADD COLUMN total_volume_previous_year INT,
    // ADD COLUMN preferred_foam_brand VARCHAR(255),
    // ADD COLUMN preferred_rig_type VARCHAR(255),
    // ADD COLUMN power_source VARCHAR(255),
    // ADD COLUMN proportioner_brand VARCHAR(255),
    // ADD COLUMN proportioner_model VARCHAR(255),
    // ADD COLUMN preferred_spray_gun VARCHAR(255);
    //update user table:
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropColumns('users','is_verified');
            Schema::dropColumns('users','verify_code');
        });
    }
}
