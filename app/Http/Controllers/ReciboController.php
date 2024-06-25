<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Recibo;
use App\Models\Bilhete;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Requests\ReciboPost;

class ReciboController extends Controller
{
    public function admin()
    {
        $recibos = Recibo::paginate(10);
        return view('recibos.admin',compact('recibos'));
    }


    public function store(ReciboPost $request)
    {
        $validated_data = $request->validated();
        $cliente= new Recibo();
        $cliente->fill($validated_data);
        $cliente->save();
        return redirect()->route('admin.recibos')
            ->with('alert-msg', 'Recibo "' . $cliente->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function create()
    {
        $recibo = new Recibo();
        return view('recibos.create', compact('recibo'));
    }

    public static function criarReciboPDF(Recibo $recibo)
    {
        $bilhetes = Bilhete::where('recibo_id', $recibo->id)->get();
        $filename = $bilhetes[0]->recibo->id."_".$bilhetes[0]->recibo->cliente_id;
        $path = storage_path('app/pdf_recibos/');
        $recibo = $bilhetes[0]->recibo;
        $pdf = PDF::loadView('recibos.recibo', compact('bilhetes', 'recibo'))->save($path.$filename.'.pdf');
        return $filename.".pdf";
    }


}