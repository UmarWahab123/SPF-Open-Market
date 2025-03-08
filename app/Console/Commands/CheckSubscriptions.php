<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;

class CheckSubscriptions extends Command
{
    // Command signature (this is the command name you'll run)
    protected $signature = 'subscriptions:expire-check';

    // Command description
    protected $description = 'Mark subscriptions as expired if they are about to expire in one day.';

    public function __construct()
    {
        parent::__construct();
    }

    // The logic to handle checking and updating subscriptions
    public function handle()
    {
        // Get subscriptions that are about to expire (1 day before expiration)

        $subscriptions = CustomerSubscriptionPaymentInfo::whereDate('expiration_date', Carbon::now()->addDay()->toDateString())
            ->where('status', 'Active')
            ->get();
        

        // Loop through each subscription and mark as expired
        foreach ($subscriptions as $subscription) {
            $subscription->status = 'Expired';
            $subscription->save();
        }

        // Output a success message to the console
        $this->info('Subscriptions expiring in one day have been marked as expired.');
    }
}
