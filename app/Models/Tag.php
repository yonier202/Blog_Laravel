<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    //relacion muchos a muchos polimorfica
    public function posts(){
        return $this->morphedByMany(Post::class, 'taggable');  //Post es la clase que relaciona con la tabla posts y la tabla taggables
    }
}
