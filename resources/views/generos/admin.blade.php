@extends('layout_admin')
@section('title', 'Generos')
@section('content')
<div class="row mb-3">
    @can('create', App\Models\Genero::class)
    <a href="{{ route('admin.generos.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
        Genero</a>
    @endcan
</div>
<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Code</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($generos as $genero)
        <tr>
            <td>{{ $genero->nome }}</td>
            <td>{{ $genero->code }}</td>
            <td nowrap>
                @can('view', $genero)
                <a href="{{ route('admin.generos.edit', ['genero' => $genero]) }}" class="btn btn-primary btn-sm"
                    role="button" aria-pressed="true"><i
                        class="fa  @cannot('update',$genero) fa-eye @else fa-pen @endcan"></i></a>
                @else
                <span class="btn btn-secondary btn-sm disabled"><i
                        class="fa @cannot('update',$genero) fa-eye @else fa-pen @endcan"></i></span>
                @endcan
                @can('delete',$genero)
                <form action="{{ route('admin.generos.destroy', ['genero' => $genero]) }}" method="POST"
                    class="d-inline" onsubmit="return confirm('Tem a certeza que deseja apagar o registo');">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>
                @else
                <span class="btn btn-secondary btn-sm disabled"><i class="fa fa-trash"></i></span>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection