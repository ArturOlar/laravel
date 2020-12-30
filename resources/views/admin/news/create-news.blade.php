@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label><b>Заголовок новости</b></label>
                    <textarea name="title" id="create-title" class="form-control @error('title') is-invalid @enderror">{{ old('title') }}</textarea>
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label><b>Спойлер новости</b></label>
                    <textarea name="spoiler" id="create-spoiler" class="form-control @error('spoiler') is-invalid @enderror"
                              rows="2">{{ old('spoiler') }}</textarea>
                    @error('spoiler')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label><b>Описание новости</b></label>
                    <textarea name="content" id="create-content" class="form-control @error('content') is-invalid @enderror"
                              rows="7">{{ old('content') }}</textarea>
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label><b>Загрузить изображение</b></label>
                    <input type="file" name="image" class="form-control-file" multiple>
                    @error('images')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row border-top border-bottom py-3 my-3">
                    <div class="col-md-3 border-right">
                        <label><b>Категория</b></label>
                        @error('id_category')
                        <br>
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <select name="id_category"
                                class="custom-select custom-select-lg mb-3 @error('id_category') is-invalid @enderror">
                            <option>Выберете категорию</option>
                            @foreach($allCategory as $category)
                                <option value="{{ $category->id_category }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 border-right">
                        <label><b>Автор</b></label>
                        @error('id_author')
                        <br>
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <select name="id_author"
                                class="custom-select custom-select-lg mb-3 @error('id_author') is-invalid @enderror">
                            <option>Выберете автора</option>
                            @foreach($allAuthors as $author)
                                <option value="{{ $author->id_author }}">{{ $author->name }} {{ $author->surname }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- управление тегами --}}
                    <div class="col-md-3 border-right">
                        <p><b>Теги</b></p>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Теги
                        </button>
                        <ul class="dropdown-menu checkbox-menu allow-focus">
                            @foreach($allTags as $tag)
                                <li class="ml-2">
                                    <label>
                                        <input name="id_tags[]" value="{{ $tag->id_tag }}" type="checkbox">
                                        <span> {{ $tag->title }} </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- управление статусами --}}
                    <div class="col-md-3">
                        <p><b>Статусы</b></p>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Статусы
                        </button>
                        <ul class="dropdown-menu checkbox-menu allow-focus">
                            @foreach($allStatuses as $status)
                                <li class="ml-2">
                                    <label>
                                        <input name="id_status[]" value="{{ $status->id_status }}" type="checkbox">
                                        <span> {{ $status->title }} </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}",
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}"
    };

    var content = document.getElementById('create-content');
    var spoiler = document.getElementById('create-spoiler');
    var title = document.getElementById('create-title');
    CKEDITOR.replace(content, options);
    CKEDITOR.replace(spoiler, options);
    CKEDITOR.replace(title, options);
</script>

@endpush