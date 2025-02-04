@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Meu perfil</h1>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i> Ocorreu um erro!</h5>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center">
        <form action="{{ route('painel.profile.update') }}" method="POST" class="form-horizontal col-sm-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Nova senha:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password"
                            class="form-control  @error('password') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation"
                        class="col-sm-2 col-form-label  @error('password') is-invalid @enderror">Confirmar senha:</label>
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
