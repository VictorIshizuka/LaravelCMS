@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
@endsection

@section('content')


    <div class="d-flex justify-content-center">
        <form action="{{ route('painel.users.update', ['id' => $user->id]) }}" method="POST" class="form-horizontal col-sm-6">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ $user->name ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ $user->email ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Senha:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar senha:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
        </form>
    </div>
@endsection
