<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\UserTestIptvAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\TestIptvExpiredEmail;

class ExpireTestIptvSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-test-iptv-subscription';

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

            $expiredSubscriptions = UserTestIptvAccount::where('status', 'started')
                ->where('expired_at', '<', Carbon::now())
                ->lockForUpdate()
                ->get();

            $count = 0;

            foreach ($expiredSubscriptions as $subscription) {
                $subscription->status = 'expired';
                $subscription->save();

                // Send email to the user
                $user = $subscription->user;
                Mail::to($user->email)->send(new TestIptvExpiredEmail($user, $subscription));

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
