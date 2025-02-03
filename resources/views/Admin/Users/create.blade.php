@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Cadastrar Usuário</h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i> Ocorreu um erro!</h5>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center">
        <form action="{{ route('painel.users.store') }}" method="POST" class="form-horizontal col-sm-6">
            @csrf
            <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror')" required value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror')" required
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Senha:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror')" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar senha:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror')"
                            required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
        </form>
    </div>
@endsection
