<div class="form-group">
    <label for="inputId">ID</label>
    <input type="text" class="form-control" name="id" id="inputId" value="{{old('id', $user->id)}}" />
    @error('id')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputName">Nome</label>
    <input type="text" class="form-control" name="name" id="inputName" value="{{old('name', $user->name)}}" />
    @error('name')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail" value="{{old('email', $user->email)}}" />
    @error('email')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputCartaz_url">Foto</label>
    <input type="file" id="inputFoto_url" class="form-control" name="foto_url" accept="image/jpeg, image/png">
    @error('foto_url')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>