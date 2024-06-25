<div class="form-group">
    <label for="inputSala_id">Sala ID</label>
    <select class="form-control" name="sala_id" id="inputGenero">
        @foreach($salas as $sala)
        <option value="{{ $sala->id }}">{{ $sala->id }} {{ $sala->nome }}</option>
        @endforeach
    </select>
      @error('sala_id')
          <div class="small text-danger">{{$message}}</div>
      @enderror
  </div>

<div class="form-group">
     <label for="inputFila">Fila</label>
     <input type="text" class="form-control" name="fila" id="inputFila" value="{{old('fila', $lugar->fila)}}" />
       @error('fila')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputPosicao">Posicao</label>
    <input type="text" class="form-control" name="posicao" id="inputPosicao" value="{{old('posicao', $lugar->posicao)}}" />
      @error('posicao')
          <div class="small text-danger">{{$message}}</div>
      @enderror
  </div>