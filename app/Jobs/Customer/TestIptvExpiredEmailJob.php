<?php

namespace App\Jobs\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Customer\TestIptvExpiredEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestIptvExpiredEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $testIptvAccount;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $testIptvAccount)
    {
        $this->user = $user;
        $this->testIptvAccount = $testIptvAccount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TestIptvExpiredEmail($this->user, $this->testIptvAccount));
    }
}
