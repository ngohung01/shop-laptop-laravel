<?php

namespace App\Mail;
use App\Models\Khuyenmai;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KhuyenmaiEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $khuyenmai;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Khuyenmai $km)
    {
        //
        $this->khuyenmai=$km;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Khuyến mãi',
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
            view: 'emails.khuyenmai',
            with: [
                'khuyenmai' => $this->khuyenmai,
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
