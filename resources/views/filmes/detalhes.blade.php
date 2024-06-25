@extends('layout_public')
@section('content')
    <!-- Page content-->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-4 ">
                <img class="img-thumbnail" style=" max-width: 80%;" src="/{{'storage/cartazes'.'/'.$filme->cartaz_url}}"
                    alt="Foto Cartaz">
            </div>
            <div class="col-md-5">
                <h3>{{ $filme->titulo}}</h3>
                <p>Género: {{ $filme->genero_code}}</p>
                <p>Ano: {{ $filme->ano}}</p>
                <p><a href="{{$filme->trailer_url}} " target="_blank">Trailer</a></p>
                <p class="text-muted">{{ $filme->sumario}}</p>
            </div>
        </div>
        <div class="row mt-5 ">

        </div>
        <div class="card div-margin ">
            <div class="card-header">Sessões</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sala</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horário Início</th>
                            <th scope="col">Agendar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessoes as $sessao)
                        <tr>
                            <th>{{ $sessao->sala_id }}</th>
                            <td>{{ $sessao->data }}</td>
                            <td>{{ $sessao->horario_inicio }}</td>
                            @if($sessao->esgotado == "Sim")
                            <td><span style="color: red;">Esgotado</td>
                            @else 
                            <td><span><a href="{{ route('show.lugares', ['id' => $sessao->id]) }}"> Ver Lugares</a></span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
 @endsection