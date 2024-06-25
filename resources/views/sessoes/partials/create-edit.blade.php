<div class="form-group">
    <label for="inputFilme_id">Filme ID</label>
     <input type="number" class="form-control" name="filme_id" id="inputFilme_id" value="{{old('filme_id', $sessao->filme_id)}}" />
       @error('filme_id')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputSala_id">Sala</label>
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
    <label for="inputData">Data</label>
     <input type="text" class="form-control" name="data" id="inputData" value="{{old('data', $sessao->data)}}" />
       @error('data')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputHorario_inicio">Horário de Início</label>
     <input type="time" step="1" class="form-control" name="horario_inicio" id="inputHorario_inicio" value="{{old('horario_inicio', $sessao->horario_inicio)}}" />
       @error('horario_inicio')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>
