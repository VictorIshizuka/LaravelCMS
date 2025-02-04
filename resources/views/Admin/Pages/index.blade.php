@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>Páginas
        <a href="{{ route('painel.pages.create') }}" class="btn btn-sm btn-success">Nova página</a>
    </h1>
@endsection

@section('content')
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"  width="50">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col" width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <th scope="row">{{ $page->id }}</th>
                        <td>{{ $page->title }}</td>

                        <td>
                            <a href="{{ '#' }}" target="_blank" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('painel.pages.edit', ['id' => $page->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form class="d-inline" action="{{ route('painel.pages.delete', ['id' => $page->id]) }}"
                                method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>

                            {{-- <a href="{{ route('painel.users.delete', ['id' => $user->id]) }}" class="btn btn-danger">Excluir</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $pages->links('pagination::bootstrap-4') }}
@endsection
