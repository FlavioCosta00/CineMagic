<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Recibo;
use App\Models\Lugar;
use App\Models\Sessao;
use App\Models\Cliente;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Email;
use App\Services\Payment;

class CarrinhoController extends Controller
{
    public function index(Request $request){

        $carrinho = $request->session()->get('carrinho',[]);
        $configuracao=Configuracao::first();
        $total=$configuracao->preco_bilhete_sem_iva*count($carrinho);
        $total_iva=$total*((1+($configuracao->percentagem_iva/100)));
        return view('carrinho.index',compact('total_iva'))
        ->with('carrinho', session('carrinho') ?? []);
    }

    public function store_pedido(Request $request)
    {   

        if (!is_null($request->lugar)){
            $carrinho = $request->session()->get('carrinho',[]);
            $sessao = $request->sessao_id;
            foreach($request->lugar as $lugar){
                 if(!isset($carrinho[$request->sessao_id.$lugar])){
                    list($lugar_id, $lugar) = explode(" ", $lugar, 2);
                    $carrinho[$sessao."_".$lugar] = [
                    'id' => $sessao."_".$lugar,
                    'titulo_filme' => $request->titulo_filme,
                    'sala_nome' => $request->sala_nome,
                    'sessao_id' => $request->sessao_id,
                    'titulo_filme' => $request->titulo_filme,
                    'lugar' => $lugar,
                    'lugar_id' => $lugar_id
                 ];
                 $request->session()->put('carrinho', $carrinho);
                }
            }
        }
        return redirect('/');
    }


    public function destroy_bilhete(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $id = $request->pedido_id;
        if (array_key_exists($id, $carrinho)) {
            unset($carrinho[$id]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foi removido um bilhete')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'Bilhete nao existe no carrinho')
            ->with('alert-type', 'warning');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

    public function checkout(Request $request){

        $cliente = Cliente::where('id', Auth::user()->id)->first();
        $configuracao=Configuracao::first();
        $carrinho = $request->session()->get('carrinho', []);
        $cliente['name']=$cliente->user->name;
        $total=$configuracao->preco_bilhete_sem_iva*count($carrinho);
        $total_iva=$total*((1+($configuracao->percentagem_iva/100)));
        return view('carrinho.checkout',compact('cliente','total_iva'))
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function store_compra(Request $request)
    {
        $cliente = Cliente::findOrFail($request->cliente_id);
        $cliente['name']=$cliente->user->name;
        if(!$cliente->nif || !$cliente->tipo_pagamento || !$cliente->ref_pagamento || !$cliente->user->name){
            return back()
            ->with('alert-msg', 'Por favor atualize os seus dados no perfil')
            ->with('alert-type', 'danger');
        }
        
        if ($cliente->tipo_pagamento == "PAYPAL"){
            $pagamento=Payment::payWithPaypal($cliente->ref_pagamento);
        } elseif($cliente->tipo_pagamento == "MBWAY"){
            $pagamento=Payment::payWithMBway($cliente->ref_pagamento);
        }elseif($cliente->tipo_pagamento == "VISA") {
            $pagamento=Payment::payWithVisa($cliente->ref_pagamento,333);
        } else {
            return back()
            ->with('alert-msg', 'Método de Pagamento inválido')
            ->with('alert-type', 'danger');
        }

        if ($pagamento == false){
            return back()
            ->with('alert-msg', 'Pagamento não autorizado')
            ->with('alert-type', 'danger');
        }

        $configuracao=Configuracao::first();
        $newRecibo = new Recibo();
        $newRecibo->cliente_id = $cliente->id;
        $newRecibo->data = date('Y-m-d');
        $newRecibo->preco_total_sem_iva = $request->total_iva*($configuracao->percentagem_iva/100);
        $newRecibo->iva = $configuracao->percentagem_iva;
        $newRecibo->preco_total_com_iva = $request->total_iva;
        $newRecibo->nif = $cliente->nif;
        $newRecibo->nome_cliente = $cliente->user->name;
        $newRecibo->tipo_pagamento = $cliente->tipo_pagamento;
        $newRecibo->ref_pagamento = $cliente->ref_pagamento;  

        $newRecibo->save();

        $carrinho = $request->session()->get('carrinho', []);

        foreach($carrinho as $pedido)
        {
            $newBilhete = new Bilhete();

            $newBilhete->recibo_id = $newRecibo->id;
            $newBilhete->cliente_id = $cliente->id;
            $newBilhete->sessao_id = $pedido['sessao_id'];
            $newBilhete->lugar_id = $pedido['lugar_id'];
            $newBilhete->preco_sem_iva = $configuracao->preco_bilhete_sem_iva;
            $newBilhete->estado = "não usado";
            $newBilhete->save();
        }
        
        EmailController::enviarRecibo($newRecibo);
        
        $request->session()->forget('carrinho');

        return redirect()->route('inicio')
            ->with('alert-msg', "Pagamento Autorizado a sua compra foi efetuada")
            ->with('alert-type', 'success');
    }


}