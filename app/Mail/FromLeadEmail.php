<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class FromLeadEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;

    
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@example.com', 'Admin Example'),
            replyTo: '',
            subject: 'New Lead Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.from-lead-email',
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
