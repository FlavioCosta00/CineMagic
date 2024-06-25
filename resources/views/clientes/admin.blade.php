@extends('layout_admin')

@section('title', 'Clientes')

@section('content')
<div class="row mb-3">
    <div class="col-3">
        @can('create', App\Models\Cliente::class)
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
            Cliente</a>
        @endcan
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIF</th>
                <th>Método Pagamento</th>
                <th>Referência</th>
                <th>Criado em</th>
                <th>Bloquear</th>
                <th>Apagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nif }}</td>
                <td>{{ $cliente->tipo_pagamento }}</td>
                <td>{{ $cliente->ref_pagamento }}</td>
                <td>{{ $cliente->created_at }}</td>
                @if($cliente->user->bloqueado)
                <form method="POST"
                    action="{{ route('admin.clientes.unlock', ['id' => $cliente->id, 'block' => '0']) }}" class="input"
                    enctype="multipart/form-data">
                    @csrf   
                    <td><button type="submit" class="btn btn-warning btn-sm" role="button"
                            aria-pressed="true">Desbloquear</button></td>
                </form>
                @else
                <form method="POST"
                    action="{{ route('admin.clientes.unlock', ['id' => $cliente->id, 'block' => '1']) }}" class="input"
                    enctype="multipart/form-data">
                    @csrf
                    <td><button type="submit" class="btn btn-warning btn-sm" role="button"
                            aria-pressed="true">Bloquear</button></td>
                </form>
                @endif
                <td nowrap>
                    @can('delete',$cliente)
                    <form action="{{route('admin.clientes.destroy',['cliente' => $cliente])}}" method="POST"
                        class="d-inline" onsubmit="return confirm('Tem a certeza que deseja apagar o registo?')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @else
                    <span class="btn btn-secondary btn-sm disabled"><i class="fa fa-trash"></i></span>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clientes->links() }}
    @endsection