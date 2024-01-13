<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function Laravel\Prompts\text;

class RegisterSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /// 1. buat global attribute sesuai dengan parameter yang dikirim dari login controller
    private $user;

    /**
     * Create a new message instance.
     * 2. terima parameter melalui consturct
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Register Success',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /// kirim variable ke mearkdown template dengan `with`
        return new Content(
            markdown: 'mails.register-success',
            with: [
                'username' => $this->user->name,
                'url' => route('user.dashboard'),
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
