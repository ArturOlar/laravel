@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            {{-- результат поиска --}}
            <div class="col-md-8 bg-white">

                {{--список новостей --}}
                @if($allNews->total() == 0)
                    <h3 class="text-center my-5 pt-5">По вашему запросу ничего не найдено...</h3>
                @else
                    <h3 class="text-center my-4">Результат поиска "{{ $request }}"</h3>
                    @foreach($allNews as $news)
                        <div class="my-2 border-top border-bottom py-3">

                            <div class="row">
                                <div class="col-md-6 text-left">
                                <span>
                                    <b>Категория:</b>
                                    <a href="{{ route('one-category', ['slug' => $news->category->slug]) }}">{{ $news->category->title }}</a>
                                </span> <br>
                                </div>
                                <div class="col-md-6 text-right pr-5">
                                    @foreach($news->statuses as $status)
                                        <mark><a href="{{ route('news-by-status', ['slug' => $status->slug ]) }}"
                                                 class="">{{ $status->title }}</a></mark>
                                    @endforeach
                                </div>
                            </div>

                            @foreach($news->tags as $tag)
                                @foreach($tag->statuses as $status)
                                    <a href="{{ route('one-tag', ['slug' => $tag->slug] ) }}"
                                       class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                @endforeach
                            @endforeach

                            <div class="row mx-1">
                                <h5><a href="{{ route('one-news', ['slug' => $news->slug]) }} "
                                       class="text-dark">{!! $news->title !!}</a></h5>
                                <a href="{{ route('one-news', ['id' => $news->slug]) }}"
                                   class="text-dark home-spoiler">{!! $news->spoiler !!}</a>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <span>Автор статьи </span>
                                    <mark class="text-left"><em>{{ $news->author->name }}</em></mark>
                                </div>
                                <div class="col-md-6 text-right pr-5">
                                    <span class="text-right">Дата публикации: </span>
                                    <mark>{{ $news->created_at->diffForHumans() }}</mark>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- пагинация --}}
                <div class="justify-content-center d-flex border-top pt-5">
                    {{ $allNews->appends(['search' => request()->search ])->links() }}
                </div>

            </div>

            {{-- правый сайдбар страницы --}}
            <div class="col-md-4 border bg-white">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection