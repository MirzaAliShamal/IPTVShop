<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestIptvStartedEmail extends Mailable
{
    use Queueable, SerializesModels;

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
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test IPTV Subscription Started',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer.test_iptv_started',
            with: [
                'user' => $this->user,
                'testIptvAccount' => $this->testIptvAccount,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
