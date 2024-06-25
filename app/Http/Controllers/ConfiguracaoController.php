<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Http\Requests\ConfiguracaoPost;

class ConfiguracaoController extends Controller
{
    public function admin(Request $request)
    {
        $configuracao = Configuracao::first();
        return view('configuracao.admin', compact('configuracao'));
    }

    public function edit(Configuracao $configuracao)
    {
        return view('configuracao.edit', compact('configuracao'));
    }


    public function update(ConfiguracaoPost $request, Configuracao $configuracao)
    {
        $configuracao['preco_bilhete_sem_iva']=$request->preco_bilhete_sem_iva;
        $configuracao['percentagem_iva']=$request->percentagem_iva;
        $configuracao->save();
        return redirect()->route('admin.configuracao')
            ->with('alert-msg', 'Configuracao "' . $configuracao->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

}