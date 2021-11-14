<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Throwable;

class ComentarioController extends Controller
{
    public function __construct(Comentario $comentario)
    {
        $this->comentario = $comentario;
    }

    public function index(){
        $comentarios = $this->comentario->with('post')->orderBy('created_at', 'desc')->get();
        return response()->json($comentarios, 200);
    }

    public function store(Request $request){
        $request->validate([
            'nome' => 'max:50',
            'email' => 'nullable|email',
            'comentario' => 'required|max: 500',
            'avaPositiva' => 'prohibited',
            'avaNegativa' => 'prohibited',
        ]);

        try{
            $comentario = $this->comentario->create($request->all());
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($comentario, 200);
    }

    public function update(Request $request, $id){
        $comentario = $this->comentario->find($id);

        if($comentario === null){
            return response()->json(['errors' => 'Não foi encontrado o comentario'], 401);
        }
        $request->validate([
            'nome' => 'prohibited',
            'email' => 'prohibited',
            'comentario' => 'required|max: 500',
            'avaPositiva' => 'prohibited',
            'avaNegativa' => 'prohibited',
        ]);

        try{
            $comentario->fill($request->all());
            $comentario->save();
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($comentario, 200);
    }

    public function destroy($id){
        $comentario = $this->comentario->find($id);

        if($comentario === null){
            return response()->json(['errors' => 'Não foi encontrado o comentario'], 401);
        }

        try{
            $comentario->delete();
        }catch(Throwable $e){
            return response()->json($e, 401);
        }

        return response()->json($comentario, 200);
    }

    public function updateAva(Request $request, $id){
        $comentario = $this->comentario->find($id);

        if($comentario === null){
            return response()->json(['errors' => 'Não foi encontrado o comentario'], 401);
        }

        $request->validate([
            'action' => 'required|boolean',
        ]);

        switch($request->action){
            case true:
                $comentario->avaPositiva++;
                $comentario->save();
                break;
            case false:
                $comentario->avaNegativa++;
                $comentario->save();
                break;
            default:
                return response()->json(['errors' => 'Ação invalida'], 401);
                break;
        }
    }
}
