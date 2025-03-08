<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GiftCard\Entities\GiftCard;
use Modules\Seller\Entities\SellerProduct;


class UserPaymentBillingAddresses extends Model
{
    use HasFactory;
    protected $table = 'user_payment_billing_addresses';
    protected $guarded = ['id'];
}
