<?php

namespace App\Listeners;

use App\Mail\NotifyAuthorMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAuthor
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // \Log::info('Notificando al autor de el comentario ' . $event->question->id);//imprimir log
        switch ($event->question->questionable_type) {
            case 'App\Models\Post':
                // \Log::info('se ha dejado un comentario del articulo');
                $post = $event->question->questionable;
                $autor = $post->user;
                // enviar correo al autor
                Mail::to($autor->email)->send(new NotifyAuthorMailable($event->question, $autor));
                break;

        }
    }
}
