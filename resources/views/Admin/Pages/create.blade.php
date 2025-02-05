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
                            <textarea name="content" id="content"  class="form-control">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.tiny.cloud/1/2talidxctcgat2w23j1265egr8tlkoh6397px10om5hvhhw2/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea.contentfield',
        plugins: [
            'link', 'table', 'image', 'autosize', 'lists'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | spellcheckdialog a11ycheck typography | aligncenter alignleft alignright alignjustify | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        content_css: [
            '{{ asset('assets/css/content.css') }}'
        ],
        images_upload_url: "/api/imageupload",
        images_upload_credentials: true, //usaurio precisa estar logado
        convert_urls: false, //evitar caminho relativo dos arquivos

        // tinycomments_mode: 'embedded',
        // tinycomments_author: 'Author name',
        // mergetags_list: [{
        //         value: 'First.Name',
        //         title: 'First Name'
        //     },
        //     {
        //         value: 'Email',
        //         title: 'Email'
        //     },
        // ],
        // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
        //     'See docs to implement AI Assistant')),
    });
</script>
@endsection
