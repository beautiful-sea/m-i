<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;

class FavoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->user);
        if($user){
            $favoritos = $user->produtos_favoritos;
            return response()->json($favoritos);
        }
        return response()->json(['Usuário não encontrado'],404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param Produto $produto
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = User::find($request->user);
        $produto = Produto::find($request->produto);

        if($produto && $user){
            $favorito = Favorito::where('user_id',$request->user)->where('produto_id',$request->produto)->first();

            if($favorito){
                $favorito->delete();
                return response()->json(['Favorito removido com sucesso'],204);
            }
            $user->favoritos()->create([
                'user_id'=>$request->user,
                'produto_id'=>$request->produto
            ]);
            return response()->json(['Favorito criado com sucesso']);
        }
        return response()->json(['Não foi possivel adicionar aos favoritos'],404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
