<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\Customer\ServicesExpiredEmailJob;
use App\Jobs\Customer\IptvSubscriptionExpiredEmailJob;

class ExpireSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire started subscriptions that have passed their expiration date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $expiredSubscriptions = Subscription::where('status', 'started')
                ->where('expired_at', '<', Carbon::now())
                ->lockForUpdate()
                ->get();

            $count = 0;

            foreach ($expiredSubscriptions as $subscription) {
                $subscription->status = 'expired';
                $subscription->save();

                // Send email to the user
                $user = $subscription->user;
                if ($subscription->type == 'iptv') {
                    IptvSubscriptionExpiredEmailJob::dispatch($user, $subscription);
                } else {
                    ServicesExpiredEmailJob::dispatch($user, $subscription);
                }

                $count++;
            }

            DB::commit();

            $this->info("Expired {$count} subscriptions and notified users.");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in ExpireStartedSubscriptions command: ' . $e->getMessage());
            $this->error('An error occurred while processing subscriptions. Check the logs for details.');
        }
    }
}
