@extends('layout_public')
@section('content')
<div class="container mt-5 mb-5">
    @if(!empty($carrinho))
    <div class="row">
        <div class="col-md-12">
            <div class="card div-margin mb-2">
                <div class="card-header">Carrinho</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sessão</th>
                                <th scope="col">Sala</th>
                                <th scope="col">Filme</th>
                                <th scope="col">Lugar</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carrinho as $pedido)
                            <tr>
                                <th scope="row"> {{ $pedido['sessao_id']}} </th>
                                <th scope="row"> {{ $pedido['sala_nome']}} </th>
                                <th scope="row"> {{ $pedido['titulo_filme']}} </th>
                                <th scope="row"> {{ $pedido['lugar']}} </th>
                                <th scope="row">
                                    <form
                                        action="{{ route('carrinho.destroy_bilhete', ['pedido_id' => $pedido['id']]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></button>
                                    </form>

                                </th>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="5" style="text-align:right;"> Preço Total: {{ $total_iva}} €</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <form action="{{ route('carrinho.destroy') }}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">Limpar Carrinho</button>
            </form>
        </div>
        <div class="col-md-1">
            <form action="{{ route('utilizador.checkout') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
    @else
    <h1>O carrinho está vazio</h1>
    @endif
</div>
@endsection