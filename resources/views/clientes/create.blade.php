@extends('layout_admin')
@section('title', 'Nova Cliente')
@section('content')

    <form method="POST" action="{{route('admin.clientes.store')}}" class="form-group">
        @csrf
        @include('clientes.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.clientes.create')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
