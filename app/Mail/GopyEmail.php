<?php

namespace App\Mail;
use App\Models\gopy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GopyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $gopy;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(gopy $gy)
    {
        //
        $this->gopy = $gy;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Góp ý thành công',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.gopy',
            with: [
                'gopy' => $this->gopy,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
