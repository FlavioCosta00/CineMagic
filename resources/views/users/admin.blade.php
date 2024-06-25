@extends('layout_admin')

@section('title', 'Users')

@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('create', App\Models\User::class)
            <a href="{{ route('admin.users.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
                User</a>
            @endcan
        </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Foto</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img width="128" height="128" alt="Img" src="../storage/fotos/{{$user->foto_url}}"></td>
                    <td nowrap>

                        @can('view',$user)
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                            <i class="fas @cannot('update',$user) fa-eye @else fa-pen @endcan"></i>
                        </a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$user) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete',$user)
                        <form action="{{route('admin.users.destroy',['user' => $user])}}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem a certeza que deseja apagar o registo?')">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa fa-trash"></i></span>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
