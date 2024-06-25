@extends('layout_admin')
@section('title', 'Novo Recibo')
@section('content')

    <form method="POST" action="{{route('admin.recibos.store')}}" class="form-group">
        @csrf
        @include('recibos.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.recibos.create')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
