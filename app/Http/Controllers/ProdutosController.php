<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $produtos = new Produto;
        if($request['nome'] || $request['valor_unitario']){
            if($request['nome']){
                $produtos = $produtos->where('nome','LIKE','%'.$request['nome'].'%');
            }
            if($request['valor_unitario']){
                $produtos = $produtos->where('valor_unitario','=',$request['valor_unitario']);
            }
            return response()->json($produtos->get());
        }
        $produtos = Produto::all();

        $produtos->map(function($produto){
            $produto->is_favorito = (Favorito::where('produto_id',$produto->id)->first())?true:false;
        });
        return response()->json($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $produto = new Produto();
        $produto->fill($data);
        $produto->save();
        return response()->json($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param Produto $produto
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($produto)
    {
        $produto = Produto::find($produto);
        if(!$produto){
            return response(["Erro"=>"Produto não encontrado"],404);
        }
        return response()->json($produto);
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
    public function update(Request $request, Produto $produto)
    {
        $data = $request->all();
        $produto->fill($data);
        $produto->save();
        return response()->json($produto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json($produto);
    }
}
