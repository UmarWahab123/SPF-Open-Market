<?php

namespace Modules\Customer\Imports;

use App\Models\User;
use App\Traits\Notification;
use App\Traits\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\UserNotificationSetting;
use Modules\Marketing\Entities\ReferralCode;
use Modules\Marketing\Entities\ReferralCodeSetup;
use Modules\Marketing\Entities\ReferralUse;

class CustomerImport implements ToCollection, WithHeadingRow
{
    use Notification, SendMail;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $field = $row['email_or_phone'];
            if (is_numeric($field)) {
                $phone = $row['email_or_phone'];
            } elseif (filter_var($field, FILTER_VALIDATE_EMAIL)) {
                $email = $row['email_or_phone'];
            }
           if (Hash::needsRehash($row['password'])) {
               $password = Hash::make($row['password']);
            }else{
                $password = $row['password'];
            }

            $user = User::create([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'username' => isset($phone) ? $phone : NULL,
                'email' => isset($email) ? $email : NULL,
                'verify_code' => sha1(time()),
                'password' => $password,
                'role_id' => 4,
                'phone' => isset($phone) ? $phone : NULL,
                'is_verified' => 1,
                'is_active' => $row['status'],
                'currency_id' => app('general_setting')->currency,
                'lang_code' => app('general_setting')->language_code,
                'currency_code' => app('general_setting')->currency_code,
                'Company_name' => $row['company_name'],
                'Billing_address' => $row['billing_address'],
            
             'Shipping_address' => $row['shipping_address'],
             'commercial_or_residential' => $row['commercial_or_residential'],
             'loading_dock' => $row['loading_dock'],
             'forklift' => $row['forklift'],
             'pallet_jack' => $row['pallet_jack'],
             'hours' => $row['hours'],
             'call_ahead' => $row['call_ahead'],
             'special_instructions' => $row['special_instructions'],
             'accounts_payable_contact_name' => $row['accounts_payable_contact_name'],
             'accounts_payable_number' => $row['accounts_payable_number'],
             'accounts_payable_email' => $row['accounts_payable_email'],
             'general_liability' => $row['general_liability'],
             'preferred_language' => $row['preferred_language'],
             'years_in_business' => $row['years_in_business'],
             'number_of_locations' => $row['number_of_locations'],
             'primary_business_function' => $row['primary_business_function'],
             'number_of_rigs' => $row['number_of_rigs'],
             'monthly_volume' => $row['monthly_volume'],
             'open_cell_volume' => $row['open_cell_volume'],
             'closed_cell_volume' => $row['closed_cell_volume'],
             'total_volume_previous_year' => $row['total_volume_previous_year'],
             'preferred_foam_brand' => $row['preferred_foam_brand'],
             'preferred_rig_type' => $row['preferred_rig_type'],
             'power_source' => $row['power_source'],
             'proportioner_brand' => $row['proportioner_brand'],
             'proportioner_model' => $row['proportioner_model'],
             'preferred_spray_gun' => $row['preferred_spray_gun'],
            ]);

            
            
    
            (new UserNotificationSetting)->createForRegisterUser($user->id);
    
            if (isset($row['referral_code'])) {
                $referralrow = ReferralCodeSetup::first();
                $referralExist = ReferralCode::where('referral_code', $row['referral_code'])->first();
                if ($referralExist) {
                    $referralExist->update(['total_used' => $referralExist->total_used + 1]);
                    ReferralUse::create([
                        'user_id' => $user->id,
                        'referral_code' => $row['referral_code'],
                        'discount_amount' => $referralrow->amount
                    ]);
                }
            }
        }

        
    }
}



