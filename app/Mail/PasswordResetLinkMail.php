<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $url,
        public readonly string $name,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: __('emails.password_reset_subject'));
    }

    public function content(): Content
    {
        return new Content(view: 'emails.password-reset-link');
    }
}
