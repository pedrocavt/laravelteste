<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Log;
use Illuminate\Http\Request;



class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = new Log();
        $log->user = auth()->user()->name;
        $log->acao = "Visualizou todos os produtos";
        $log->save();

        return Produto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = Produto::create($request->all());

        $log = new Log();
        $log->user = auth()->user()->name;
        $log->acao = "Adicionou o produto {$produto->nome} no banco";
        $log->save();

        return $produto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $log = new Log();
        $log->user = auth()->user()->name;
        $log->acao = "Visualizou o produto {$produto->nome}";
        $log->save();

        return $produto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());

        $log = new Log();
        $log->user = auth()->user()->name;
        $log->acao = "Atualizou o produto {$produto->nome} no banco";
        $log->save();

        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {

        $log = new Log();
        $log->user = auth()->user()->name;
        $log->acao = "Deletou o produto {$produto->nome} no banco";
        $log->save();

        $produto->delete();
        return ['msg' => 'produto removido com sucesso!'];
    }
}
