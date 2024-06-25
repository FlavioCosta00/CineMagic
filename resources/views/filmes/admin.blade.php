@extends('layout_admin')
@section('title', 'Filmes')
@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('create', App\Models\Filme::class)
            <a href="{{ route('admin.filmes.create') }}" class="btn btn-success" role="button" aria-pressed="true">
                Novo Filme</a>
            @endcan
        </div>

    <table class="table">
        <thead>
            <tr>
                <th>TÍtulo</th>
                <th>Cartaz URL</th>
                <th>Código Género</th>
                <th>Ano</th>
                <th>Sumário</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $filme)
                <tr>
                    <td>{{ $filme->titulo }}</td>
                    <td><img width="150" height="250" alt="Img" src="../storage/cartazes/{{$filme->cartaz_url}}"></td>
                    <td>{{ $filme->genero_code }}</td>
                    <td>{{ $filme->ano }}</td>
                    <td>{{ $filme->sumario }}</td>
                    <td nowrap>
                        @can('view',$filme)
                        <a href="{{ route('admin.filmes.edit', ['filme' => $filme]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                            <i class="fas @cannot('update',$filme) fa-eye @else fa-pen @endcan"></i>
                        </a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$filme) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete',$filme)
                        <form action="{{route('admin.filmes.destroy',['filme' => $filme])}}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem a certeza que deseja apagar o registo?')">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa fa-trash"></i></span>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $filmes->withQueryString()->links() }}
@endsection
