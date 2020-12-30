@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('news.update', ['id' => $news->id_news ]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label><b>ID новости</b></label>
                    <input name="id_news" type="text" class="form-control" value="{{ $news->id_news }}" disabled>
                </div>

                {{-- заголовок новости --}}
                <div class="form-group">
                    <label><b>Заголовок новости</b></label>
                    <textarea id="edit-title" name="title"
                              class="form-control @error('title') is-invalid @enderror">{{ old('title', $news->title) }}</textarea>
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- спойлер новости --}}
                <div class="form-group">
                    <label><b>Спойлер новости</b></label>
                    <textarea id="edit-spoiler" name="spoiler"
                              class="form-control @error('spoiler') is-invalid @enderror"
                              rows="2">{{ old('spoiler', $news->spoiler) }}</textarea>
                    @error('spoiler')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- описание новости --}}
                <div class="form-group">
                    <label><b>Описание новости</b></label>
                    <textarea id="edit-content" name="content"
                              class="form-control @error('content') is-invalid @enderror"
                              rows="7">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- управление изображением --}}
                <div class="border-top border-bottom my-5 py-3">
                    <p class="text-center mt-2 mb-5"><b>Изображения к новости</b></p>
                    <div class="row border-top pt-3">
                        <div class="col-md-3 border-right">
                            <div class="form-group my-5 pb-5">
                                <label>Загрузить изображение</label>
                                <input type="file" name="image" class="form-control-file" multiple>
                                @error('images')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-3">
                                @if(!empty($news->image_url))
                                    <div class="form-group text-center mt-3">
                                        @if( substr($news->image_url, 0, 5) == 'https')
                                            <div class="row justify-content-center mb-5">
                                                <img class="w-75 news-image" src="{{ $news->image_url }}" alt="img">
                                            </div>
                                        @else
                                            <div class="row justify-content-center mb-5">
                                                <img class="w-75 news-image" src="{{ asset('/storage/' . $news->image_url) }}" alt="img">
                                            </div>
                                        @endif
                                        {{--<img class="w-75 news-image" src="{{ asset('storage/' . $news->image_url) }}" alt="img">--}}
                                    </div>
                                    <div class="text-center">
                                        <button onclick="deleteImage({{ $news->id_news }})" class="btn btn-danger mt-2">Удалить</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- управление категориями --}}
                    <div class="col-md-3 border-right">
                        <label><b>Категория</b></label>
                        <select name="id_category" class="custom-select custom-select-lg mb-3">
                            @foreach($allCategory as $category)
                                @if($category->id_category == $news->category->id_category)
                                    <option value="{{ $category->id_category }}"
                                            selected>{{ $category->title }}</option>
                                @else
                                    <option value="{{ $category->id_category }}">{{ $category->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- управление авторами --}}
                    <div class="col md-3 border-right">
                        <label><b>Автор</b></label>
                        <select name="id_author" class="custom-select custom-select-lg mb-3">
                            @foreach($allAuthors as $author)
                                @if($author->id_author == $news->author->id_author)
                                    <option value="{{ $author->id_author }}"
                                            selected>{{ $author->name }} {{ $author->surname }}</option>
                                @else
                                    <option value="{{ $author->id_author }}">{{ $author->name }}</option>
                                @endif
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
                                        <input name="id_tags[]" value="{{ $tag->id_tag }}" type="checkbox"
                                        @if($tag['checked'] == 'plus') checked @endif>
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
                                        <input name="id_status[]" value="{{ $status->id_status }}" type="checkbox"
                                        @if($status['checked'] == 'plus') checked @endif>
                                        <span> {{ $status->title }} </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
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

    var content = document.getElementById('edit-content');
    var spoiler = document.getElementById('edit-spoiler');
    var title = document.getElementById('edit-title');
    CKEDITOR.replace(content, options);
    CKEDITOR.replace(spoiler, options);
    CKEDITOR.replace(title, options);
</script>

@endpush