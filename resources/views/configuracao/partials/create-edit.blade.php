<div class="form-group">
    <label for="inputPreco_bilhete_sem_iva">preco_bilhete_sem_iva</label>
    <input type="text" class="form-control" name="preco_bilhete_sem_iva" id="inputPreco_bilhete_sem_iva" value="{{old('preco_bilhete_sem_iva', $configuracao->preco_bilhete_sem_iva)}}" >
    @error('preco_bilhete_sem_iva')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPercentagem_iva">percentagem_iva</label>
    <input type="text" class="form-control" name="percentagem_iva" id="inputPercentagem_iva" value="{{old('percentagem_iva', $configuracao->percentagem_iva)}}" >
    @error('percentagem_iva')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>