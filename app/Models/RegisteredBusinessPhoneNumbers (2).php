<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GiftCard\Entities\GiftCard;
use Modules\Seller\Entities\SellerProduct;


class RegisteredBusinessPhoneNumbers extends Model
{
    use HasFactory;
    protected $table = 'registered_business_phone_numbers';
    protected $guarded = ['id'];
}
