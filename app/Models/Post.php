<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comentario;

class Post extends Model
{

    protected $fillable = ['nome', 'email', 'titulo', 'conteudo', 'avaPositiva', 'avaNegativa'];

    use HasFactory;

    public function comentarios(){
        return $this->hasMany(Comentario::class)->orderBy('created_at', 'desc');;
    }
}
