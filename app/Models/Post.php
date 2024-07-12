<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title', //activar asignacion masiva atravez del formulario
        'slug',
        'category_id',
        'user_id',
        'excerpt',
        'body',
        'published',
    ];

    protected function title():Attribute
    {
        return new Attribute(
            
            set: fn($value) => strtolower($value), //mutadores cambian la manera almacenar un dato en la bd(en esta caso lo convierte a minuscula)
            get: fn($value) => ucfirst($value) //accesor recuperan un dato y lo transforman
        );
    }

    protected function image(): Attribute
    {
        return new Attribute(
            get: fn() => $this->attributes['image_path'] ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'
        );
    }

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
