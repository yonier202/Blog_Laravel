<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable =[
        'body',  //activar asignacion masiva atravez del formulario
        'user_id',
    ];

    // relacion 1 a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }


}
