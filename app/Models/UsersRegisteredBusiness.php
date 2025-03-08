<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GiftCard\Entities\GiftCard;
use Modules\Seller\Entities\SellerProduct;
use App\Models\RegisteredBusinessPhoneNumbers;


class UsersRegisteredBusiness extends Model
{
    use HasFactory;
    protected $table = 'users_registered_business';
    protected $fillable = ['registerd_business_locations', 'business_type', 'business_name', 'user_id','company_registration_number',
    'country','zip_postal_code' , 'address_line1' ,'appartment_building_suite_other' , 'city_town' ,'state_region', 
    'solo_business_name', 'Good_services_type', 'transaction_estimates', 'How_many_locations' ,'all_stores_data' ,
    'List_locations_states' ,'company_description'];
    protected $guarded = ['id'];
    
        
    public function BusinessNumbers(){
        return $this->hasMany(RegisteredBusinessPhoneNumbers::class,'user_registered_business_id','id');
    }
}
