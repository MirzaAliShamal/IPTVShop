<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InactiveReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $reminderType;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $reminderType)
    {
        $this->user = $user;
        $this->reminderType = $reminderType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjects = [
            '24h_reminder' => 'Free 24-Hour IPTV Trial Available',
            '48h_reminder' => 'Account Top-Up Reminder',
            '5day_reminder' => 'Don’t Miss Out on Our Services!'
        ];

        return new Envelope(
            subject: $subjects[$this->reminderType] ?? 'We miss you!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: "emails.customer.inactive_reminder_{$this->reminderType}",
            with: [
                'user' => $this->user,
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
