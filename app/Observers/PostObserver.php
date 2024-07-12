<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post){ // creating accion antes del registro

         if (!app()->runningInConsole()) { //si no estamos ejecutando desde consola(estar en la web)
            $post->user_id = auth()->id(); //asignar el usuario logueado al post
        }
        //created accion despues del registro
    }
    public function updating(Post $post){ // updating accion antes de la actualizacion
        if ($post->published && !$post->published_at) { //la 1 vez que published sea true y published_at sea null ==(a la fecha now)
            $post->published_at = now();
        }
    }   
}
