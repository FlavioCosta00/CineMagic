<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sala;
use App\Models\Filme;
use App\Models\Genero;
use App\Models\Recibo;
use App\Models\Sessao;
use App\Models\Bilhete;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\URL;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function showSessao(Request $request){
        
        $sessao = Sessao::findOrFail($request->sessao);
        $info=Sessao::join('salas','salas.id','=','sessoes.sala_id')
        ->join('filmes','filmes.id','=','sessoes.filme_id')
        ->where('sessoes.id','=',$sessao->id)
        ->select('filmes.id as filme_id','filmes.cartaz_url','filmes.titulo','sessoes.id as sessoes_id'
        ,'sessoes.data','sessoes.horario_inicio','salas.nome as sala_nome')
        ->distinct()
        ->get();
        return view('dashboard.index',compact('info'));
    }

    
    public function  validarBilhete(Request $request){
        $sessaoBilhete=Bilhete::where('id','=',$request->bilheteID)->select('id','sessao_id','estado')
        ->get();
        if (count($sessaoBilhete) == 0){
            return back()->withInput()
            ->with('alert-msg', 'Bilhete ID não existe')
            ->with('alert-type', 'danger');
        }
        if ($sessaoBilhete[0]->sessao_id != $request->sessao_ID){
            return back()->withInput()
            ->with('alert-msg', 'Bilhete não corresponde a esta sessão')
            ->with('alert-type', 'danger');
        }
        if ($sessaoBilhete[0]->estado == "usado"){
            return back()->withInput()
            ->with('alert-msg', 'Bilhete já usado proibido de entrar na sessão')
            ->with('alert-type', 'danger');
        }
        $cliente=Cliente::join('bilhetes','clientes.id','=','bilhetes.cliente_id')
        ->join('users','users.id','=','clientes.id')
        ->where('bilhetes.id','=',$request->bilheteID)
        ->select('users.name','users.foto_url')
        ->get();
        return view('dashboard.index',compact('cliente','sessaoBilhete','currenturl'));
     }

     public function  bilheteEstado(Request $request){
        $bilhete = Bilhete::find($request->bilheteID);
        $bilhete->estado = "usado";
        $bilhete->update();
        return view('dashboard.index');
    }

    public function estatisticas(){
        $total_clientes = DashboardController::totalClientes();
        $genero_mais_filmes=DashboardController::generoComMaisFilmes();
        $ganhos_mensais=DashboardController::ganhosMensais();
        $ganhos_anuais=DashboardController::ganhosAnuais();
        $filme_mais_visto=DashboardController::filmeMaisAssistido();
        $filme_mais_vistoAno=DashboardController::filmeMaisAssistidoANO();
        $filme_mais_vistoMes=DashboardController::filmeMaisAssistidoMES();
        $cliente_melhor=DashboardController::melhor_cliente();
        $utilizadorespordia=DashboardController::utilizadorespordia();
        return view('estatisticas.index',compact('total_clientes','genero_mais_filmes','ganhos_mensais','ganhos_anuais','filme_mais_visto','filme_mais_vistoAno',
        'filme_mais_vistoMes','cliente_melhor','utilizadorespordia'));
    }



    public static function generoComMaisFilmes(){


        $genero_mais_filmes = Filme::select(array('genero_code' ,Filme::raw('COUNT(genero_code) as genero_code_count')))
        ->groupBy('genero_code')
        ->orderByDesc('genero_code_count')
        ->limit(1)
        ->get();
        return $genero_mais_filmes;
    }

    public static function filmeMaisAssistido(){
        $filmemais=Bilhete::join("sessoes", function($join){
            $join->on("bilhetes.sessao_id", "=", "sessoes.id");
        })
        ->join("filmes", function($join){
            $join->on("sessoes.filme_id", "=", "filmes.id");
        })
        ->select("filmes.titulo", "filmes.id",Bilhete::raw("count(bilhetes.id) as total"))
        ->limit(3)
        ->orderBy("total","desc")
        ->groupBy("filmes.id")
        ->get();
        return $filmemais;
    }

    public static function filmeMaisAssistidoANO(){
        $data = date("Y");
        $filmemais=Bilhete::join("sessoes", function($join){
            $join->on("bilhetes.sessao_id", "=", "sessoes.id");
        })
        ->join("filmes", function($join){
            $join->on("sessoes.filme_id", "=", "filmes.id");
        })
        ->where('data', 'LIKE', $data . '%')
        ->select("filmes.titulo", "filmes.id",Bilhete::raw("count(bilhetes.id) as total"))
        ->limit(3)
        ->orderBy("total","desc")
        ->groupBy("filmes.id")
        ->get();
        return $filmemais;
    }

    public static function filmeMaisAssistidoMES(){
        $data = date("Y-m");
        $filmemais=Bilhete::join("sessoes", function($join){
            $join->on("bilhetes.sessao_id", "=", "sessoes.id");
        })
        ->join("filmes", function($join){
            $join->on("sessoes.filme_id", "=", "filmes.id");
        })
        ->where('data', 'LIKE', $data . '%')
        ->select("filmes.titulo", "filmes.id",Bilhete::raw("count(bilhetes.id) as total"))
        ->limit(3)
        ->orderBy("total","desc")
        ->groupBy("filmes.id")
        ->get();
        return $filmemais;
    }

    public static function ganhosMensais()
    {
        $total = 0;
        $data = date("Y-m");

        $recibos = Recibo::where('data', 'LIKE', $data . '%')
        ->get();

        foreach ($recibos as $recibo)
        {
           $total+= $recibo->preco_total_com_iva;
        }

        $mes = Carbon::createFromFormat('Y-m', $data)->format('F');

        $consulta = [$total, $mes];

        return $consulta;

    }

    public static function ganhosAnuais()
    {
        $total = 0;
        $data = date("Y");

        $recibos = Recibo::where('data', 'LIKE', $data . '%')
        ->get();

        foreach ($recibos as $recibo)
        {
           $total+= $recibo->preco_total_com_iva;
        }

        $consulta = [$total, $data];

        return $consulta;

    }

    public static function totalClientes(){

        $total_clientes = 0;

        $clientes = Cliente::all();

        foreach($clientes as $cliente)
        {
            $total_clientes += 1;
        }

        return $total_clientes;
    }


    public static function melhor_cliente()
    {
        $melhorcliente=Bilhete::join("clientes", function ($join) {
                $join->on("bilhetes.cliente_id", "=", "clientes.id");
            })
            ->join("users", function ($join) {
                $join->on("users.id", "=", "clientes.id");
            })
            ->select("users.name",Bilhete::raw("count(bilhetes.cliente_id) as total"))
            ->limit(3)
            ->orderBy("total", "desc")
            ->groupBy("users.id")
            ->get();
            return $melhorcliente;
    }

    public static function utilizadorespordia(){
        $utilizadores=Bilhete::join("sessoes", function($join){
            $join->on("bilhetes.sessao_id", "=", "sessoes.id");
        })
        ->groupByRaw('DAYOFWEEK(sessoes.data)')
        ->selectRaw('DAYOFWEEK(sessoes.data) as dia,COUNT(*)as percentagem')
        ->get();
        return $utilizadores;
    }
}