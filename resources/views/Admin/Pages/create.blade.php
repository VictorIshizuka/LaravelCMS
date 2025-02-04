@extends('adminlte::page')

@section('title', 'Nova Página')

@section('content_header')
    <h1>Nova Página</h1>
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
        <form action="{{ route('painel.pages.store') }}" method="POST" class="form-horizontal col-sm-6">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Titulo</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Conteúdo</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
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
