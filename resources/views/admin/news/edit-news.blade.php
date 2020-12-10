@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">
            <form action="{{ route('news.update', ['id' => $news->id_news ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>ID новости</label>
                    <input name="id_news" type="text" class="form-control"  value="{{ $news->id_news }}" disabled>
                </div>

                <div class="form-group">
                    <label>Заголовок новости</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $news->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Спойлер новости</label>
                    <textarea name="spoiler" class="form-control @error('spoiler') is-invalid @enderror" rows="2">{{ $news->spoiler }}</textarea>
                    @error('spoiler')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Первая часть описания новости</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="7">{{ $news->content }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Вторая часть описания новости</label>
                    <textarea name="content_second" class="form-control @error('content_second') is-invalid @enderror" rows="7">{{ $news->content_second }}</textarea>
                    @error('content_second')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="border-top border-bottom my-5 py-3">
                    <p class="text-center mt-2 mb-5">Изображения к новости</p>
                    <div class="row">
                        @foreach($news->images as $image)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <img class="mr-2 mb-2 float-left news-image w-50"
                                         src="{{ asset('storage/' . $image->image_url) }}"
                                         alt="img">
                                </div>
                                <div>
                                    <input type="button" onclick="deleteImage({{ $image->id_image }})" class="btn btn-danger mt-4 ml-2" value="Удалить">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group my-5 pb-5 border-bottom">
                    <label>Загрузить изображение</label>
                    <input type="file" name="images[]" class="form-control-file" multiple>
                    @error('images')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <label>Категория</label>
                <select name="id_category" class="custom-select custom-select-lg mb-3">
                    @foreach($allCategory as $category)
                        @if($category->id_category == $news->category->id_category)
                            <option value="{{ $category->id_category }}" selected>{{ $category->title }}</option>
                        @else
                            <option value="{{ $category->id_category }}">{{ $category->title }}</option>
                        @endif
                    @endforeach
                </select>

                <label>Автор</label>
                <select name="id_author" class="custom-select custom-select-lg mb-3">
                    @foreach($allAuthors as $author)
                        @if($author->id_author == $news->author->id_author)
                            <option value="{{ $author->id_author }}"
                                    selected>{{ $author->name }} {{ $author->surname }}</option>
                        @else
                            <option value="{{ $author->id_author }}">{{ $author->name }} {{ $author->name }}</option>
                        @endif
                    @endforeach
                </select>

                {{-- управление тегами --}}
                <div class="my-3 border-top pt-2">
                    <span>Выбраные теги:
                        @foreach($news->tags as $tag)
                            <span class="{{ $tag->status_view }}">{{ $tag->title }}</span>
                        @endforeach
                    </span>
                </div>

                <div class="my-3 border-bottom pb-2">
                    <span>Добавить или забрать тег</span> <br>
                    @foreach($allTags as $tag)
                        <div class="form-check form-check-inline">
                            <input name="id_tags[]" class="form-check-input" type="checkbox" id="tag_{{ $tag->id_tag }}"
                                   value="{{ $tag->id_tag }}">
                            <label class="form-check-label {{ $tag->status_view }}">{{ $tag->title }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- управление статусами --}}
                <div class="my-3">
                    <span>Выбраные статусы:
                        @foreach($news->statuses as $status)
                            <b><span>{{ $status->title }};</span></b>
                        @endforeach
                    </span>
                </div>

                <div class="my-3">
                    <span>Добавить или забрать статус: </span> <br>
                    @foreach($allStatuses as $status)
                        <div class="form-check form-check-inline">
                            <input name="id_status[]" class="form-check-input" type="checkbox"
                                   id="status_{{ $status->id_status }}" value="{{ $status->id_status }}">
                            <label class="form-check-label">{{ $status->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </div>
            </form>
        </div>
    </div>
@endsection