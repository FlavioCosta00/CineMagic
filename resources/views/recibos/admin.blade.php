@extends('layout_admin')

@section('title', 'Recibos')

@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('create', App\Models\Recibo::class)
            <a href="{{ route('admin.recibos.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
                Recibo</a>
            @endcan
        </div>
    <table class="table">
        <thead>
            <tr>
                <th>Cliente_id</th>
                <th>Data</th>
                <th>Nif</th>
                <th>Nome_cliente</th>
                <th>Tipo_pagamento</th>
                <th>Ref_pagamento</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($recibos as $recibo)
                <tr>
                    <td>{{ $recibo->cliente_id }}</td>
                    <td>{{ $recibo->data }}</td>
                    <td>{{ $recibo->nif }}</td>
                    <td>{{ $recibo->nome_cliente }}</td>
                    <td>{{ $recibo->tipo_pagamento }}</td>
                    <td>{{ $recibo->ref_pagamento }}</td>
                    <td nowrap>

                        @can('view',$recibo)
                        <a href="{{ route('admin.recibos.edit', ['recibo' => $recibo]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                            <i class="fas @cannot('update',$recibo) fa-eye @else fa-pen @endcan"></i>
                        </a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$recibo) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete',$recibo)
                        <form action="{{route('admin.recibos.destroy',['recibo' => $recibo])}}" method="POST" class="d-inline"
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
    {{ $recibos->links() }}
@endsection
