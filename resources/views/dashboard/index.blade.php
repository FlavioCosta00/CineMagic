@extends('layout_admin')
@section('title','Dashboard' )
@section('content')
<div class="container-fluid">
    @if(!isset($cliente))
    @if(!isset($info))
    <h4>Controlo de Acesso às Sessões</h4>
    <!-- Content Row -->
    <div class="row">
        <div class="col-sm 12">
            <form method="GET" action=" {{ route('admin.sessao.show')}}" class="input" enctype="multipart/form-data">
                @csrf
                <div class="input-group mt-4 mb-4 ">
                    <input type="number" name="sessao" class="form-control" placeholder="Procurar ID de Sessão">
                    <button class="btn btn-primary" type="submit" name="ok">Procurar</button>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endif
    @if(isset($info))

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-4 ">
            <img class="img-thumbnail" style=" max-width: 80%;" src="/{{'storage/cartazes'.'/'.$info[0]->cartaz_url}}"
                alt="Foto Cartaz">
        </div>
        <div class="col-md-5">
            <h3>Título:{{ $info[0]->titulo}}</h3>
            <p>Sala: {{ $info[0]->sala_nome}}</p>
            <p>Data: {{ $info[0]->data}}</p>
            <p>Horário de início:{{ $info[0]->horario_inicio}}</p>
            <form method="GET" action=" {{ route('admin.validarBilhete.show')}}" class="input">
                @csrf
                <input type="hidden" name="sessao_ID" value="{{ $info[0]->sessoes_id}}">
                <div class="input-group mt-4 mb-4 ">
                    <input type="number" name="bilheteID" class="form-control" placeholder="Bilhete ID">
                    <button class="btn btn-success" type="submit" name="ok">Verificar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3 mb-3" style="float: right;">
        <form method="GET" action="{{ route('admin.dashboard')}}">
            <input class="btn btn-primary" type="submit" value="Escolher Outra Sessão" />
        </form>
    </div>
    @endif
    @if(isset($cliente) && isset($sessaoBilhete))

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ $cliente[0]->foto_url ? asset('storage/fotos/' . $cliente[0]->foto_url) : asset('img/default_img.png') }}"
                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">{{ $cliente[0]->name}}</h5>
                    <form method="POST" action=" {{ route('admin.bilheteEstado.update') }}" }>
                        @csrf
                        <input type="hidden" name="bilheteID" value="{{ $sessaoBilhete[0]->id }}">
                        <input type="hidden" name="url" value="{{ $currenturl }}">
                        <button class="btn btn-success" data-rel="back" type="submit" name="ok">Usar Bilhete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <form method="GET" action="{{ route('admin.dashboard')}}">
            <input class="btn btn-primary" type="submit" value="Escolher Outra Sessão" />
            <input type="button" class="btn btn-info" value="Voltar à Sessão" onclick="history.back()">
        </form>

    </div>
    @endif
</div>
@endsection