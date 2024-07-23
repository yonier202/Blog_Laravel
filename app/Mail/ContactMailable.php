<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMailable extends Mailable implements ShouldQueue // implements ShouldQueue para ejecutar con colas
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        from: new Address($this->data['email'], 'Jhonier DEV'),
        subject: 'Correo de contacto',
    );
}

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array //adjuntar archivos
    {
        if (!isset($this->data['file'])) { //si no esta definido
            return [];
        }else{
            return [
                Attachment::fromStorage($this->data['file']) //adjuntar archivo almacenado al email 
                // Attachment::fromPath($this->data['file']->getRealPath()) //obtener la ruta completa del archivo en el servidor.
                //     ->as($this->data['file']->getClientOriginalName()) //definir cómo se verá el nombre del archivo adjunto en el correo electrónico.
                //     ->withMime($this->data['file']->getMimeType()), //especificar el tipo MIME del archivo, asegurando que se maneje correctamente según su tipo.
            ];
        }
    }
}
