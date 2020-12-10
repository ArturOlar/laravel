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
                    <label>Заголовок новости</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Спойлер новости</label>
                    <textarea name="spoiler" class="form-control @error('spoiler') is-invalid @enderror" rows="2">{{ old('spoiler') }}</textarea>
                    @error('spoiler')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Первая часть описания новости</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="7">{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Вторая часть описания новости</label>
                    <textarea name="content_second" class="form-control @error('content_second') is-invalid @enderror" rows="7">{{ old('content_second') }}</textarea>
                    @error('content_second')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Загрузить изображение</label>
                    <input type="file" name="images[]" class="form-control-file" multiple>
                    @error('images')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <label>Категория</label>
                @error('id_category')
                    <br><small class="text-danger">{{ $message }}</small>
                @enderror
                <select name="id_category" class="custom-select custom-select-lg mb-3 @error('id_category') is-invalid @enderror">
                    <option>Выберете категорию</option>
                @foreach($allCategory as $category)
                        <option value="{{ $category->id_category }}" >{{ $category->title }}</option>
                    @endforeach
                </select>

                <label>Автор</label>
                @error('id_author')
                    <br><small class="text-danger">{{ $message }}</small>
                @enderror
                <select name="id_author" class="custom-select custom-select-lg mb-3 @error('id_author') is-invalid @enderror">
                    <option>Выберете автора</option>
                    @foreach($allAuthors as $author)
                        <option value="{{ $author->id_author }}">{{ $author->name }} {{ $author->surname }}</option>
                    @endforeach
                </select>

                <div class="my-3 border-bottom pb-2">
                    <span>Добавить теги</span> <br>
                    @foreach($allTags as $tag)
                        <div class="form-check form-check-inline">
                            <input name="id_tags[]" class="form-check-input" type="checkbox" id="tag_{{ $tag->id_tag }}"
                                   value="{{ $tag->id_tag }}">
                            <label class="form-check-label {{ $tag->status_view }}">{{ $tag->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="my-3">
                    <span>Добавить или забрать статус: </span> <br>
                    @foreach($allStatuses as $status)
                        <div class="form-check form-check-inline">
                            <input name="id_status[]" class="form-check-input" type="checkbox"
                                   value="{{ $status->id_status }}">
                            <label class="form-check-label">{{ $status->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection