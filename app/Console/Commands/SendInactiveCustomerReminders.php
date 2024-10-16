<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Jobs\Customer\InactiveReminderEmailJob;

class SendInactiveCustomerReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-inactive-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue reminder emails for customers who haven\'t made any purchases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminderIntervals = [
            1 => '24h_reminder',
            2 => '48h_reminder',
            5 => '5day_reminder'
        ];

        foreach ($reminderIntervals as $days => $reminderType) {
            $inactiveCustomers = User::whereDoesntHave('subscriptions')
                ->whereDoesntHave('productOrders')
                ->whereDoesntHave('transactions')
                ->where('created_at', '<=', Carbon::now()->subDays($days))
                ->where('created_at', '>', Carbon::now()->subDays($days + 1))
                ->whereDoesntHave('reminders', function ($query) use ($reminderType) {
                    $query->where('type', $reminderType);
                })
                ->get();

            foreach ($inactiveCustomers as $customer) {
                InactiveReminderEmailJob::dispatch($customer, $reminderType);
            }

            $this->info("Queued {$reminderType} emails for " . $inactiveCustomers->count() . " inactive customers.");
        }
    }
}
