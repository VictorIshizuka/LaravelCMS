@extends('adminlte::page')

@section('title', 'Editar Página')

@section('content_header')
    <h1>Editar Página</h1>
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
        <form action="{{ route('painel.pages.update', ['id' => $page->id]) }}" method="POST" class="form-horizontal col-sm-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $page->id }}">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title"
                            class="col-sm-2 col-form-label @error('title')
                            is-invalid
                        @enderror">Titulo</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $page->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Conteúdo</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" class="form-control">{{ $page->content }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
