<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class EmailReminder extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
{
    $this->user = $user; // Gán đúng đối tượng $user
}

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Nhắc nhở Check-in/Check-out')
            ->view('emails.reminder');
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'fe_email.email_reminder',
    //         with: [
    //             'user' => $this->user
    //         ]
    //     );
    // }

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
