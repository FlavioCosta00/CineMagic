<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClientePost;
use App\Models\Recibo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function admin()
    {
        $clientes = Cliente::paginate(10);
        return view('clientes.admin',compact('clientes'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }
    public function create()
    {
        $cliente = new Cliente();
        return view('clientes.create', compact('cliente'));
    }

    public function store(ClientePost $request)
    {
        $validated_data = $request->validated();
        $cliente= new Cliente();
        $cliente->fill($validated_data);
        $cliente->save();
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(ClientePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->fill($validated_data);
        $cliente->save();
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy(Cliente $cliente)
    {
        $oldName=$cliente->nome;
        $cliente->delete();
        return redirect()->route('admin.clientes')
                ->with('alert-msg', 'Cliente "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }

    public function perfil()
    {
        $id=Auth::user()->id;
        $cliente = Cliente::join('users','users.id','=','clientes.id')
        ->where('clientes.id','=',$id)
        ->select('users.name','users.foto_url','users.email','clientes.nif','clientes.tipo_pagamento',
        'clientes.ref_pagamento','clientes.id')
        ->first();
        $qry = Recibo::where('cliente_id',  Auth::user()->id);
        $recibos = $qry->paginate(10);
        return view('perfil.index',compact('cliente','recibos'));
    }

    public function destroy_foto(Cliente $cliente)
    {   
        $cliente->user->foto_url;
        Storage::delete('public/fotos/' . $cliente->user->foto_url);
        $cliente->user->foto_url = null;
        $cliente->user->save();
        return redirect()->route('utilizador.perfil')
            ->with('alert-msg', 'Foto do cliente "' . $cliente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function updateClientesInfo(ClientePost $request, Cliente $cliente) {
        if($request->hasFile('foto')) {
            $path = Storage::putFile('public/fotos/', $request->file('foto'));
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->name = $request['name'];
        $cliente->nif = $request['nif'];
        $cliente->tipo_pagamento = $request['tipo_pagamento'];
        $cliente->ref_pagamento = $request['ref_pagamento'];
        $cliente->save();
        $cliente->user->save();
        return redirect()->route('utilizador.perfil')
            ->with('alert-msg', 'Dados atualizados com sucesso!')
            ->with('alert-type', 'success');
    }

    public function bloquearClientes(Request $request)
    {
        $cliente = Cliente::where('id', $request->id)->first();
        $cliente->user->bloqueado = $request->block;
        $cliente->user->save();
        $mensagem = $request->block ? "Cliente: [ ".$cliente->user->name." ] bloqueado com sucesso!" : "Cliente: [ ".$cliente->user->name." ] desbloqueado com sucesso!";
        return redirect()->route('admin.clientes')
            ->with('alert-msg', $mensagem)
            ->with('alert-type', 'success');
    }



}
