<?php

namespace App\Jobs\Customer;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Customer\InactiveReminderEmail;

class InactiveReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $reminderType;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $reminderType)
    {
        $this->user = $user;
        $this->reminderType = $reminderType;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Check if the user has made a purchase or transaction since the job was queued
        if ($this->user->subscriptions()->count() > 0
            || $this->user->productOrders()->count() > 0
            || $this->user->transactions()->count() > 0) {
            return;
        }

        Mail::to($this->user->email)->send(new InactiveReminderEmail($this->user, $this->reminderType));

        // Record that this reminder has been sent
        Reminder::create([
            'user_id' => $this->user->id,
            'type' => $this->reminderType,
        ]);
    }
}
