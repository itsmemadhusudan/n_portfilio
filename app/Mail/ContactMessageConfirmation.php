<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $senderName,
        public readonly string $subjectLine,
        public readonly string $bodyMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks for reaching out — Madhusudan Timalsina',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-confirmation',
        );
    }
}
