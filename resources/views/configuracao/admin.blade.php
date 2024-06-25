@extends('layout_admin')
@section('title', 'Configuracao')
@section('content')

    <div class="table table-striped">
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Preco_bilhete_sem_iva</th>
                <th scope="col">Percentagem_iva</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $configuracao->id }}</td>
                    <td>{{ $configuracao->preco_bilhete_sem_iva }}</td>
                    <td>{{ $configuracao->percentagem_iva }}</td>
                    <td nowrap>

                        @can('view','App\Models\Configuracao')
                        <a href="{{ route('admin.configuracao.edit', ['configuracao' => $configuracao]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                            <i class="fas @cannot('update',$configuracao) fa-eye @else fa-pen @endcan"></i>
                        </a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$configuracao) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                    </td>
                </tr>
        </tbody>
    </table>
@endsection