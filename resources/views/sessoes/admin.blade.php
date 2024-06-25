@extends('layout_admin')
@section('title', 'Sessões')
@section('content')
<div class="row mb-3">
    @can('create', App\Models\Sessao::class)
    <a href="{{ route('admin.sessoes.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova
        sessao</a>
    @endcan
</div>
<table class="table">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Cartaz</th>
            <th>Sala Nome</th>
            <th>Data</th>
            <th>Horario Inicio</th>
            <th>criado em</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sessoes as $sessao)
        <tr>
            <td>{{ $sessao->titulo }}</td>
            <td><img width="150" height="250" alt="Img" src="../storage/cartazes/{{$sessao->cartaz_url}}"></td>
            <td>{{ $sessao->sala_nome }}</td>
            <td>{{ $sessao->data }}</td>
            <td>{{ $sessao->horario_inicio }}</td>
            <td>{{ $sessao->created_at }}</td>
            <td nowrap>
                @can('view', $sessao)
                <a href="{{ route('admin.sessoes.edit', ['sessao' => $sessao]) }}" class="btn btn-primary btn-sm"
                    role="button" aria-pressed="true"><i
                        class="fa  @cannot('update',$sessao) fa-eye @else fa-pen @endcan"></i></a>
                @else
                <span class="btn btn-secondary btn-sm disabled"><i
                        class="fa @cannot('update',$sessao) fa-eye @else fa-pen @endcan"></i></span>
                @endcan
                @can('delete',$sessao)
                <form action="{{ route('admin.sessoes.destroy', ['sessao' => $sessao]) }}" method="POST"
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

{{$sessoes->links()}}
@endsection