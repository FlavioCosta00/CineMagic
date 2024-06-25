<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Requests\BilhetePost;

class BilheteController extends Controller
{
    public function admin()     {
        $bilhetes = Bilhete::paginate();
        return view('bilhetes.admin',compact('bilhetes'));
    }


    public function edit(Bilhete $bilhete)
    {
        return view('bilhetes.edit', compact('bilhete'));
    }
    public function create()
    {
        $bilhete = new Bilhete();
        return view('bilhetes.create', compact('bilhete'));
    }

    public function store(BilhetePost $request)
    {
        $validated_data = $request->validated();
        $bilhete= new Bilhete();
        $bilhete->fill($validated_data);
        $bilhete->save();
        return redirect()->route('admin.bilhetes')
            ->with('alert-msg', 'Bilhete "' . $bilhete->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(BilhetePost $request, Bilhete $bilhete)
    {
        $validated_data = $request->validated();
        $bilhete->fill($validated_data);
        $bilhete->save();
        return redirect()->route('admin.bilhetes')
            ->with('alert-msg', 'Bilhete "' . $bilhete->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }


    public function destroy(Bilhete $bilhete)
    {
        $oldName=$bilhete->nome;
        $bilhete->delete();
        return redirect()->route('admin.bilhetes')
                ->with('alert-msg', 'Bilhete "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }



}
