@extends('layout_public')
@section('content')
<section class="perfil">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4>Detalhes Conta</h4>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img width="100px"
                                        src="{{ $cliente->foto_url ? asset('storage/fotos/' . $cliente->foto_url) : asset('img/default_img.png') }}" />
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Nome</h6>
                                <p>{{$cliente->name}}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>NIF</h6>
                                <p>{{$cliente->nif}}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Tipo Pagamento</h6>
                                    <p>{{$cliente->tipo_pagamento}}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Referência de pagamento</h6>
                                    <p>{{$cliente->ref_pagamento}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="password/reset"><button class="btn btn-primary">Alterar a
                                        palavra-passe</button></a>
                            </div>
                            <div class="col-6">
                                <button type="submit" name="deletefoto" form="form_delete_photo"
                                    class="btn btn-danger">Apagar
                                    Foto</button>
                                <form id="form_delete_photo"
                                    action="{{route('utilizador.cliente.foto.destroy', ['cliente' => $cliente])}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form method="POST" action=" {{ route('utilizador.cliente.update', ['cliente' => $cliente]) }}"
                    class="input" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h4>Editar Conta</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Nome</p>
                                    <p><input type="text" name="name" class="form-control"
                                            value="{{ old('name', $cliente->name) }}" required></p>
                                </div>
                                <div class="col-6">
                                    <p>NIF</p>
                                    <p><input type="text" name="nif" class="form-control"
                                            value="{{ old('nif', $cliente->nif) }}" required></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Referência de pagamento</p>
                                    <p><input type="text" name="ref_pagamento" class="form-control"
                                            value="{{ old('ref_pagamento', $cliente->ref_pagamento) }}" required>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>Tipo de pagamento usado</p>
                                    <p for="tipo_pagamento">
                                        <select name="tipo_pagamento" id="tipo-pagamento">
                                            <option value="MBWAY"
                                                {{ 'MBWAY' == old('tipo_pagamento', $cliente->tipo_pagamento) ? 'selected' : '' }}>
                                                MBWAY</option>
                                            <option value="VISA"
                                                {{ 'VISA' == old('tipo_pagamento', $cliente->tipo_pagamento) ? 'selected' : '' }}>
                                                VISA</option>
                                            <option value="PAYPAL"
                                                {{ 'PAYPAL' == old('tipo_pagamento', $cliente->tipo_pagamento) ? 'selected' : '' }}>
                                                PayPal</option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <p>Imagem de perfil</p>
                                <p><input type="file" id="inputFoto" class="form-control" name="foto"
                                        accept="image/jpeg, image/png"
                                        onchange="document.getElementById('img-selecionada').src = window.URL.createObjectURL(this.files[0])">
                                </p>
                                @error('foto')
                                <div class="small text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>Pré-visualização da imagem de perfil</p>
                                    <p><img id="img-selecionada" style="width:100%;" alt="Imagem não carregada" /></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <div class="col mb-3">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success" type="submit" name="ok">Submeter
                                        edição</button>
                                </div>
                            </center>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

</section>
@endsection