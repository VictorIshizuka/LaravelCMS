@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários
        <a href="{{ route('painel.users.create') }}" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>
@endsection

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('painel.users.edit', ['id' => $user->id]) }}"
                                class="btn btn-warning">Editar</a>
                            @if ($user->id != $loggedId)
                                <form class="d-inline" action="{{ route('painel.users.delete', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onsubmit="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            @endif
                            {{-- <a href="{{ route('painel.users.delete', ['id' => $user->id]) }}" class="btn btn-danger">Excluir</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links('pagination::bootstrap-4') }}
@endsection
