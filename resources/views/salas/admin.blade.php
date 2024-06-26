@extends('layout_admin')
@section('title', 'Salas')
@section('content')
    <div class="row mb-3">
        @can('create', App\Models\Sala::class)
            <a href="{{ route('admin.salas.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova Sala</a>
        @endcan
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td>{{ $sala->nome }}</td>
                    <td nowrap>
                        @can('view', $sala)
                        <a href="{{ route('admin.salas.edit', ['sala' => $sala]) }}" class="btn btn-primary btn-sm"
                            role="button" aria-pressed="true"><i class="fa  @cannot('update',$sala) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$sala) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete',$sala)
                        <form action="{{ route('admin.salas.destroy', ['sala' => $sala]) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Tem a certeza que deseja apagar o registo');">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

@endsection
