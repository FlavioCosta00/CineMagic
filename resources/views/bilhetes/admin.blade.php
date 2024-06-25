@extends('layout_admin')
@section('title', 'Bilhetes')
@section('content')
    <div class="row mb-3">
        @can('create', App\Models\Bilhete::class)
            <a href="{{ route('admin.bilhetes.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo Bilhete</a>
        @endcan
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Recibo</th>
                <th>Cliente</th>
                <th>Sessao</th>
                <th>Lugar</th>
                <th>Preço_sem_iva</th>
                <th>Estado</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($bilhetes as $bilhete)
                <tr>

                    <td>{{$bilhete->recibo_id}}</td>
                    <td>{{$bilhete->cliente_id}}</td>
                    <td>{{$bilhete->sessao_id}}</td>
                    <td>{{$bilhete->lugar_id}}</td>
                    <td>{{$bilhete->preco_sem_iva }}</td>
                    <td>{{$bilhete->estado}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$bilhetes->links()}}
@endsection
