<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GiftCard\Entities\GiftCard;
use Modules\Seller\Entities\SellerProduct;
use App\Models\UserPaymentBillingAddresses;

class UserPaymentsInfo extends Model
{
    use HasFactory;
    protected $table = 'user_payments_info';
    protected $guarded = ['id'];
    
     public function PaymentBillingAddress(){
        return $this->hasOne(UserPaymentBillingAddresses::class,'user_payment_info_id','id');
    }
}
