@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações</h1>
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

    @if (session('success'))
        <div class="alert alert-info">
            {{ session('success') }}

        </div>
    @endif

    <div class="d-flex justify-content-center">
        <form action="{{ route('painel.settings.save') }}" method="POST"  class="form-horizontal col-sm-6" >
            @csrf
            @method('PUT')
            <div class="card mx-auto">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label text-left">Título do site:</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $settings->title ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-left">Sub-título do site:</label>
                        <div class="col-sm-9">
                            <input type="text" name="subtitle" id="subtitle" class="form-control"
                                value="{{ $settings->subtitle ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-left">E-mail para contato:</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ $settings->email ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-left">Cor do fundo:</label>
                        <div class="col-sm-9">
                            <input type="color" name="bgcolor" id="bgcolor" class="form-control"
                                value="{{ $settings->bgcolor ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-left">Cor do texto:</label>
                        <div class="col-sm-9">
                            <input type="color" name="textcolor" id="textcolor" class="form-control"
                                value="{{ $settings->textcolor ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
