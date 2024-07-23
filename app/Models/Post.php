<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'image_path'
    ];

    //transformar un elemeto a un tipado especifico
    protected $casts = [
        'published' => 'boolean', 
        'published_at' => 'datetime',
    ];

    protected function title():Attribute
    {
        return new Attribute(
            
            set: fn($value) => strtolower($value), //mutadores cambian la manera almacenar un dato en la bd(en esta caso lo convierte a minuscula)
            get: fn($value) => ucfirst($value) //accesores recuperan un dato y lo transforman
        );
    }

    protected function image(): Attribute
    {
        return new Attribute(
            // get: fn() => $this->attributes['image_path'] ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'
            get: function(){
                if ($this->image_path) {
                    if (substr($this->image_path, 0, 8)== 'https://') {
                        //verificar si la url empieza con https://
                        return $this->image_path; //lo trae como esta en el bd
                    }

                return Storage::url($this->image_path); //le concatena al inicio http://proyecto_blog.test/public/storage
                    
                }else{      
                    //retornar imagen(No imagen)
                    return 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg';
                }
                
            }
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

    //relacion uno a muchos polimorfica
    public function questions(){
        return $this->morphMany(Question::class, 'questionable');
    }

    //Route Model binding
    public function getRouteKeyName(){
       return 'slug';
    }
    //QUERY SCOPE LOCALES CUANDO LLAMO filter() en el controlador
    public function scopeFilter($query){ //filtro por categorias
        $query->when(request('categories'), function($query){
            $query->whereIn('category_id', request('categories'));
        })
        ->when(request('order') ?? 'new', function($query, $order){ //filtro por orden
            $sort = $order === "new" ? 'desc' : 'asc';
            $query->orderBy('published_at', $sort);
        })
        ->when(request('tag') ?? null, function($query){ //filtro por tags
            $query->whereHas('tags', function($query){
                $query->where('tags.name', request('tag'));
            });
        });
    }
    //SCOPE GLOBAL PARA VALIDACION (SOLO MANIPULAR POST CON EL ID DE USUARIO ASOCIADO)
    // protected static function booted()
    // {
    //     static::addGlobalScope('written', function($query){
    //         if (request()->routeIs('admin.*')) {
    //             $query->where('user_id', auth()->id());
    //         }
            
    //     });
    // }
    
}
