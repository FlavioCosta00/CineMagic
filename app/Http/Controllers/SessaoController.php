<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Sessao;
use App\Models\Bilhete;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function index(){
        $sessoes = Sessao::paginate(10);
        return view('sessoes.index',compact('sessoes'));
    }

    public function admin()
    {
        $dia_atual = date('Y-m-d',time());
        $sessoes = Sessao::where('data','>=', $dia_atual)
        ->join('filmes','sessoes.filme_id','=','filmes.id')
        ->join('salas','sessoes.sala_id','=','salas.id')
        ->select(
        'filmes.titulo as titulo',
        'filmes.cartaz_url as cartaz_url',
        'salas.nome as sala_nome',
        'sessoes.data as data',
        'sessoes.horario_inicio as horario_inicio',
        'sessoes.created_at as created_at'

        )
        ->orderBy('data', 'ASC')
        ->paginate(10);
        return view('sessoes.admin',compact('sessoes'));
    }

    public function edit(Sessao $sessao)
    {
        return view('sessoes.edit', compact('sessao'));
    }
    public function create()
    {
        $sessao = new Sessao();
        $salas = Sala::all();
        return view('sessoes.create', compact('sessao','salas'));
    }

    public function destroy(Sessao $sessao)
    {
        $oldName=$sessao->nome;
        $sessao->delete();
        return redirect()->route('admin.sessoes')
                ->with('alert-msg', 'Sessao "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }
    
    public function show_lugares($sessao){
        Sessao::findOrFail($sessao);
        $lugares=Sessao::join('salas','salas.id','=','sessoes.sala_id')
        ->join('lugares','lugares.sala_id','=','salas.id')
        ->join('filmes','filmes.id','=','sessoes.filme_id')
        ->where('sessoes.id','=',$sessao)
        ->select('filmes.id as filme_id', 'filmes.titulo','sessoes.id as sessoes_id'
        ,'sessoes.data','sessoes.horario_inicio','salas.nome','lugares.id as lugar_id','lugares.fila','lugares.posicao')
        ->distinct()
        ->get();
        $lugares_ocupados=Bilhete::where('sessao_id','=',$sessao)
        ->select('lugar_id')
        ->get();
        
        $lugar_ocupado = array();
        for($i=0; $i<COUNT($lugares);$i++){
            $lugar_ocupado[$i]="0";
            for ($j=0; $j<COUNT($lugares_ocupados);$j++){
            if ($lugares_ocupados[$j]['lugar_id'] == $lugares[$i]['lugar_id']){
                $lugar_ocupado[$i]="1";
            }
            }
        }
        return view('sessoes.escolher_lugares',compact('lugares','lugar_ocupado'));
    }

}