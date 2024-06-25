@extends('layout_admin')
@section('title', 'Alterar Recibo')
@section('content')

    <form method="POST" action="{{route('admin.recibos.update',['recibo' => $recibo])}}" class="form-group">
        @csrf
        @method('PUT')
        @include('recibos.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.recibos.edit',['recibo' => $recibo])}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
