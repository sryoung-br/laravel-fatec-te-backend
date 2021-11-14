<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(){
        $posts = $this->post->with('comentarios')->orderBy('created_at', 'desc')->get();
        return response()->json($posts, 200);
    }

    public function store(Request $request){
        $request->validate([
            'nome' => 'max:50',
            'email' => 'nullable|email',
            'titulo' => 'required|max:100',
            'conteudo' => 'required|max: 1000',
            'avaPositiva' => 'prohibited',
            'avaNegativa' => 'prohibited',
        ]);

        try{
            $post = $this->post->create($request->all());
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($post, 200);
    }

    public function update(Request $request, $id){
        $post = $this->post->find($id);

        if($post === null){
            return response()->json(['errors' => 'Não foi encontrado o post'], 401);
        }
        $request->validate([
            'nome' => 'prohibited',
            'email' => 'prohibited',
            'titulo' => 'required|max:100',
            'conteudo' => 'required|max: 1000',
            'avaPositiva' => 'prohibited',
            'avaNegativa' => 'prohibited',
        ]);

        try{
            $post->fill($request->all());
            $post->save();
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($post, 200);
    }

    public function destroy($id){
        $post = $this->post->find($id);

        if($post === null){
            return response()->json(['errors' => 'Não foi encontrado o post'], 401);
        }

        try{
            $post->delete();
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($post, 200);
    }

    public function updateAva(Request $request, $id){
        $post = $this->post->find($id);

        if($post === null){
            return response()->json(['errors' => 'Não foi encontrado o post'], 401);
        }

        $request->validate([
            'action' => 'required|boolean',
        ]);

        switch($request->action){
            case true:
                $post->avaPositiva++;
                $post->save();
                break;
            case false:
                $post->avaNegativa++;
                $post->save();
                break;
            default:
                return response()->json(['errors' => 'Ação invalida'], 401);
                break;
        }
    }
}
