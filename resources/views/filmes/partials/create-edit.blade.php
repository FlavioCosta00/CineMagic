<div class="form-group">
    <label for="inputTitulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="inputTitulo" value="{{old('titulo', $filme->titulo)}}" />
    @error('titulo')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputGenero_code">Género</label>
    <select class="form-control" name="genero_code" id="inputGenero">
        @foreach($generos as $genero)
        <option value="{{ $genero->code }}">{{ $genero->nome }}</option>
        @endforeach
    </select>
    @error('genero_code')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAno">Ano</label>
    <input type="text" class="form-control" name="ano" id="inputAno" value="{{old('ano', $filme->ano)}}" />
    @error('ano')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


<div class="form-group">
    <label for="inputSumario">Sumário</label>
    <input type="text" class="form-control" name="sumario" id="inputSumario"
        value="{{old('sumario', $filme->sumario)}}" />
    @error('sumario')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputTrailer_url">Trailer URL</label>
    <input type="text" class="form-control" name="trailer_url" id="inputTrailer_url"
        value="{{old('trailer_url', $filme->trailer_url)}}" />
    @error('trailer_url')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputCartaz_url">Cartaz</label>
    <input type="file" id="inputCartaz_url" class="form-control" name="cartaz_url" accept="image/jpeg, image/png">
    @error('cartaz_url')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
