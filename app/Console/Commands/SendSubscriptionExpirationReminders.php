<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\Customer\ServiceExpirationReminderEmailJob;
use App\Jobs\Customer\SubscriptionExpirationReminderEmailJob;
use App\Jobs\Customer\IptvSubscriptionExpirationReminderEmailJob;

class SendSubscriptionExpirationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-subscription-expiration-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users whose subscriptions are expiring in 2 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $expiringSubscriptions = Subscription::where('status', 'started')
                ->whereBetween('expired_at', [
                    Carbon::now()->addDays(2)->startOfDay(),
                    Carbon::now()->addDays(2)->endOfDay()
                ])
                ->lockForUpdate()
                ->get();

            $count = 0;

            foreach ($expiringSubscriptions as $subscription) {
                $user = $subscription->user;

                if ($subscription->type == 'iptv') {
                    IptvSubscriptionExpirationReminderEmailJob::dispatch($user, $subscription);
                } else {
                    ServiceExpirationReminderEmailJob::dispatch($user, $subscription);
                }

                $count++;
            }

            DB::commit();

            $this->info("Sent expiration reminders for {$count} subscriptions.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in SendSubscriptionExpirationReminders command: ' . $e->getMessage());
            $this->error('An error occurred while sending expiration reminders. Check the logs for details.');
        }
    }
}
