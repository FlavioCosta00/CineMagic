@extends('layout_public')
@section('content')
<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
    </div>
    @if (session('alert-msg'))
    @include('partials.message')
    @endif
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Carrinho</span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                @foreach($carrinho as $pedido)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Filme: {{ $pedido['titulo_filme']}} </h6>
                        <small class="text-muted">Sessão:{{ $pedido['sessao_id']}} </small>
                    </div>
                    <span class="text-muted">Sala: {{ $pedido['sala_nome']}}</span>
                    <span class="text-muted">Lugar: {{ $pedido['lugar']}}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total:</span>
                    <strong>{{ $total_iva}} €</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Detalhes Cliente</h4>
            <form novalidate="" action="{{ route('utilizador.carrinho.store_compra') }}" class="form-group"
                enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                <input type="hidden" name="total_iva" value="{{ $total_iva}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Nome">Nome</label>
                        <input type="text" readonly="readonly" class="form-control" name="nome" placeholder=""
                            value="{{$cliente->name}}" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">NIF</label>
                        <input type="text" readonly="readonly" class="form-control" name="nif" placeholder=""
                            value="{{$cliente->nif}}" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Nome">Tipo Pagamento</label>
                        <input type="text" readonly="readonly" class="form-control" name="tipo_pagamento" placeholder=""
                            value="{{$cliente->tipo_pagamento}}" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Referência</label>
                        <input type="text" readonly="readonly" class="form-control" name="referencia" placeholder=""
                            value="{{$cliente->ref_pagamento}}" required="">
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-dark btn-lg btn-block" type="submit">Finalizar Compra</button>
            </form>
        </div>
    </div>
</div>
@endsection