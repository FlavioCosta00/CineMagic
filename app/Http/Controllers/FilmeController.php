<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Sala;
use App\Models\Filme;
use App\Models\Genero;
use App\Models\Recibo;
use App\Models\Sessao;
use App\Models\Bilhete;
use Illuminate\Http\Request;
use App\Http\Requests\FilmePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FilmeController extends Controller
{

    public function admin_index(Request $request)
    {
        $filmes = Filme::paginate(10);
        return view('filmes.admin', compact('filmes'));
    }


    public function create()
    {
        $filme = new Filme();
        $generos = Genero::all();
        return view('filmes.create', compact('filme','generos'));
    }


    public function store(FilmePost $request)
    {
        $validated_data = $request->validated();
        $filme= new Filme();
        $filme->fill($validated_data);
        $filme->save();
        return redirect()->route('admin.filmes')
            ->with('alert-msg', 'Filme "' . $filme->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }


    public function update(FilmePost $request, Filme $filme)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('cartaz')) {
            Storage::delete('public/cartazes/' . $filme->cartaz_url);
            $path = $request->cartaz->store('public/cartazes');
            $filme->cartaz_url = basename($path);
        }
        $filme->save();
        return redirect()->route('admin.filmes')
            ->with('alert-msg', 'Filme "' . $filme->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Filme $filme)
    {
        Storage::delete('public/cartazes/' . $filme->user->cartaz_url);
        $filme->user->cartaz_url = null;
        $filme->user->save();
        return redirect()->route('admin.filmes.edit', ['aluno' => $filme])
            ->with('alert-msg', 'Cartaz do filme "' . $filme->user->name . '" foi removido!')
            ->with('alert-type', 'success');
    }


    public function filtrar_substring(Request $request){

        $substring=$request->input('substring');
        $filmes=Filme::join('sessoes','filmes.id','=','sessoes.filme_id')
        ->whereDate('sessoes.data', '>=', today())
        ->where(static function ($query) use ($substring) {
			$query->where('filmes.titulo','like',"%{$substring}%")
						->orWhere('filmes.sumario','like',"%{$substring}%");
        })
        ->select('filmes.id', 'filmes.titulo', 'filmes.ano','filmes.genero_code','filmes.cartaz_url')
        ->distinct()
        ->get();
        $generos = Genero::all();
        return view('welcome',compact('filmes','generos'));
    }

    public function filmes_exibicao(){
        $filmes=Filme::join('sessoes','filmes.id','=','sessoes.filme_id')
        ->join('generos','generos.code','=','filmes.genero_code')
        ->whereDate('sessoes.data', '>=', today())
        ->select('filmes.id', 'filmes.titulo', 'filmes.ano','filmes.genero_code','filmes.cartaz_url')
        ->distinct()
        ->get();
        $generos = Genero::all();
        return view('welcome',compact('filmes','generos'));
    }

    public function filme_detail($id){
        
        $sessao_esgotada=array();
        $i=0;
        $filme = Filme::findOrFail($id);
        $sessoes = Sessao::where('filme_id',$filme->id)
        ->whereDate('data', '>=', today())
        ->get();
        foreach($sessoes as $sessao){
            $numero_lugares=Sala::numero_lugares($sessao->id);
            $numero_bilhetes_comprados=Recibo::numero_bilhetes_comprado($sessao->id);
            if ($numero_bilhetes_comprados[0]->numero_bilhetes_comprado >= $numero_lugares[0]->numero_lugares ){
                $sessao['esgotado']="Sim";
            }
            else {
                $sessao['esgotado']="Não";
            }
            $i++;
        }
        return view('filmes.detalhes',compact('filme','sessoes'));
    }



}