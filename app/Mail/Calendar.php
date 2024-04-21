<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Calendar extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $name;
    public $userID;
    public $eventID;
    /**
     * Create a new message instance.
     */
    public function __construct($formattedDate,$name,$userID,$lastEventID)
    {
        $this->date = $formattedDate;
        $this->name = $name;
        $this->userID =$userID;
        $this->eventID =$lastEventID;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->name,

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'public.emails.calendar ',
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
