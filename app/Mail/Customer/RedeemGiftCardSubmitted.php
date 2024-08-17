<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RedeemGiftCardSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $redeem;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $redeem)
    {
        $this->user = $user;
        $this->redeem = $redeem;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request to redeem giftcard submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer.funds_purchased',
            with: [
                'user' => $this->user,
                'redeem' => $this->redeem,
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
