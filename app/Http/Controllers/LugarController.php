<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Requests\LugarPost;

class LugarController extends Controller
{

    public function index(){
        $lugares = Lugar::paginate(10);
        return view('lugares.index',compact('lugares'));
    }

    public function admin()
    {
        $lugares = Lugar::paginate(10);
        return view('lugares.admin',compact('lugares'));
    }

    public function edit(Lugar $lugar)
    {   
        $salas = Sala::all();
        return view('lugares.edit', compact('lugar','salas'));
    }
    public function create()
    {
        $lugar = new Lugar();
        $salas = Sala::all();
        return view('lugares.create', compact('lugar','salas'));
    }

    public function store(LugarPost $request)
    {
        $validated_data = $request->validated();
        $lugar= new Lugar();
        $lugar->fill($validated_data);
        $lugar->save();
        return redirect()->route('admin.lugares')
            ->with('alert-msg', 'Lugar "' . $lugar->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function update(LugarPost $request, Lugar $lugar)
    {
        $validated_data = $request->validated();
        $lugar->fill($validated_data);
        $lugar->save();
        return redirect()->route('admin.lugares')
            ->with('alert-msg', 'Lugar "' . $lugar->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Lugar $lugar)
    {
        $oldName=$lugar->nome;
        $lugar->delete();
        return redirect()->route('admin.lugares')
                ->with('alert-msg', 'Lugar "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }
}
