<?php

namespace App\Mail;

use App\Models\Question;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyAuthorMailable extends Mailable implements ShouldQueue //para ejecutar con colas
{
    use Queueable, SerializesModels;
    private $question;
    private $autor;

    /**
     * Create a new message instance.
     */
    public function __construct(Question $question, User $autor)
    {
        $this->question = $question;
        $this->autor = $autor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo comentario',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.notify-author',
            with: [
                'question' => $this->question,
                'autor' => $this->autor,  //agregar autor al email
            ],
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
