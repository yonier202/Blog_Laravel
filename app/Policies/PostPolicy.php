<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{   //policy para reglas asociadas a un modelo
    public function author(User $user, Post $post): bool
    {
        return $user->id === $post->user_id; //retorna true o false
        //validar que solo se puedan editar los post asociados a el usuario
    }
}
