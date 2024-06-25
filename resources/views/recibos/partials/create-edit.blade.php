<div class="form-group">
    <label for="inputCliente_id">Cliente_id</label>
     <input type="text" class="form-control" name="cliente_id" id="inputCliente_id" value="{{old('cliente_id', $recibo->cliente_id)}}" />
       @error('cliente_id')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputData">Data</label>
     <input type="text" class="form-control" name="data" id="inputData" value="{{old('data', $recibo->data)}}" />
       @error('data')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputNif">Nif</label>
     <input type="text" class="form-control" name="nif" id="inputNif" value="{{old('nif', $recibo->nif)}}" />
       @error('nif')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputNome_cliente">Nome_cliente</label>
     <input type="text" class="form-control" name="nome_cliente" id="inputNome_cliente" value="{{old('nome_cliente', $recibo->nome_cliente)}}" />
       @error('nome_cliente')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>


   <div class="form-group">
    <label for="inputTipo_pagamento">Tipo_pagamento</label>
     <input type="text" class="form-control" name="tipo_pagamento" id="inputTipo_pagamento" value="{{old('tipo_pagamento', $recibo->tipo_pagamento)}}" />
       @error('tipo_pagamento')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputRef_pagamento">Ref_pagamento</label>
     <input type="text" class="form-control" name="ref_pagamento" id="inputRef_pagamento" value="{{old('ref_pagamento', $recibo->ref_pagamento)}}" />
       @error('ref_pagamento')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>
