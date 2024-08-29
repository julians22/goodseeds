<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // datetime carbon in Asia/Jakarta timezone
        $now = now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        return new Envelope(
            subject: 'Contact Mail Notification | ' . $now,
            from: new Address('noreply@goodseeds.id', 'Noreply Goodseeds'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $htmlString = '<h1>Contact Mail Notification</h1>';
        $htmlString .= '<p>Name: ' . $this->contact->name . '</p>';
        $htmlString .= '<p>Email: ' . $this->contact->email . '</p>';
        $htmlString .= '<p>Company: ' . $this->contact->company . '</p>';
        $htmlString .= '<p>Phone: ' . $this->contact->phone . '</p>';
        $htmlString .= '<p>Message: ' . $this->contact->message . '</p>';


        return new Content(
            htmlString: $htmlString
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
