@extends('layout_admin')
@section('title', 'Alterar Cliente')
@section('content')

    <form method="POST" action="{{route('admin.clientes.update',['cliente' => $cliente])}}" class="form-group">
        @csrf
        @method('PUT')
        @include('clientes.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.clientes.edit',['cliente' => $cliente])}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
