@extends('layout_public')
@section('content')
<!-- Page content-->
<div class="container mt-5">
    @if (session('alert-msg'))
    @include('partials.message')
    @endif
    <span>
        <h2 style="text-align: center;">Filmes em Exibição</h2>
    </span>
    <form action="{{ route('filtrosubstring') }}" method="POST">
        @csrf
        <div class="input-group mt-4 mb-4 ">
            <input name="substring" type="search" class="form-control rounded"
                placeholder="Procurar por Título ou Sumário" aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-primary">Procurar</button>
        </div>
    </form>
    <div class="dropdown-center mt-2 mb-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
            data-bs-toggle="dropdown" aria-expanded="false">
            Género
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="{{ route('inicio') }}">Todos</a></li>
            @foreach($generos as $genero)
            <li><a class="dropdown-item"
                    href="{{ route('filtrogenero', ['code' => $genero->code]) }}">{{ $genero->code}}</a></li>
            @endforeach

        </ul>
    </div>
    <div class="row mt-5">
        @if(!$filmes->isEmpty())
        @foreach($filmes as $filme)
        <div class="col-sm 3 mt-2 mb-4">
            <div class="card" style="width: 18rem;">
                <img class="img-thumbnail" src="/{{'storage/cartazes'.'/'.$filme->cartaz_url}}" alt="Foto Cartaz">
                <div class="card-body">
                    <h6 class="card-title">{{ $filme->titulo}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Género: {{ $filme->genero_code}}</li>
                    <li class="list-group-item">Ano: {{ $filme->ano}}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('filme', ['id' => $filme->id]) }}" class="card-link">Ver Detalhes</a>
                </div>
            </div>

        </div>

        </a>
        @endforeach
        @else
        <h4 style="text-align: center;">Não há filmes a apresentar</h2>
            @endif
    </div>
</div>
</div>
@endsection