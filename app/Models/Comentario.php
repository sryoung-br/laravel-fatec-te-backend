<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $fillable = ['post_id', 'nome', 'email', 'comentario', 'avaPositiva', 'avaNegativa'];

    use HasFactory;

    public function post(){
        return $this->belogsTo(Post::class);
    }
}
