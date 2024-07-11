<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //relacion 1 a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion 1 a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // relacion muchos a musho polimorfica
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    } 

    //relacion uno a muchos polimorfica
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    
}
