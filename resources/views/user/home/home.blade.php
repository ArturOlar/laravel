@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">

            {{-- контент страницы --}}
            <div class="col-md-8">

                {{-- список новостей --}}
                <h2 class="text-center my-4">Лента новостей</h2>
                @foreach($allNews as $news)
                    <div class="my-2 border-top border-bottom py-3">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <span><b>Категория:</b> <a href="{{ route('one-category', ['id' => $news->category->id_category]) }}">{{ $news->category->title }}</a></span> <br>
                            </div>
                            <div class="col-md-6 text-right">
                                <span class="text-right pr-4">Статус:
                                    @foreach($news->statuses as $status)
                                        <mark><a href="" class="">{{ $status->title }}</a></mark>
                                    @endforeach
                                </span>
                            </div>
                        </div>

                        <span class="text-left">Теги:
                            @foreach($news->tags as $tag)
                                @foreach($tag->statuses as $status)
                                    <a href="{{ route('one-tag', ['id' => $tag->id_tag] ) }}" class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                @endforeach
                            @endforeach
                        </span>

                        <h5><a href="{{ route('one-news', ['id' => $news->id_news]) }} " class="text-dark">{{ $news->title }}</a></h5>
                        <p><a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news->spoiler }}</a></p>
                        <div class="row">
                            <div class="col-md-6">
                                <span>Автор статьи </span><mark class="text-left"><em>{{ $news->author->name }} {{ $news->author->surname }}</em></mark>
                            </div>
                            <div class="col-md-6 text-right pr-5">
                                <span class="text-right">Дата публикации: </span><mark>{{ $news->created_at->diffForHumans() }}</mark>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- пагинация --}}
                <div class="justify-content-center d-flex border-top pt-5">
                    {{ $allNews->links() }}
                </div>

                {{-- кнопка 'подгрузить еще' --}}
                <div class="my-5 text-center">
                    <button class="btn btn-primary">Подгрузить еще</button>
                </div>
            </div>

            {{-- правый сайдбар страницы --}}
            <div class="col-md-4 border-left">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection