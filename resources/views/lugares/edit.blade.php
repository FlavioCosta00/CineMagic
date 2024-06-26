@extends('layout_admin')
@section('title','Alterar Lugar' )
@section('content')
    <form method="POST" action="{{route('admin.lugares.update', ['lugar' => $lugar]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('lugares.partials.create-edit')
        <input type="hidden" name="lugar" value="{{$lugar->abreviatura}}">
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.lugares.edit', ['lugar' => $lugar]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection