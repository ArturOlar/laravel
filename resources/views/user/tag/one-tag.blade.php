@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <h2 class="text-center my-5">Все новости по тегу "{{ $newsByTag->title }}"</h2>
                    <div class="row justify-content-center">
                        @foreach($newsByTag->news as $news)
                            <div class="card col-md-5 mb-3 mx-3">
                                <div class="py-3">
                                    <img src="{{ asset('storage/' . $news->images[0]->image_url) }}" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news->title }}</a></h5>
                                    <p class="card-text"><a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news->spoiler }}</a></p>
                                    <div class="row">
                                        <div class="col-md-7 text-left">
                                            <span>Категория: </span><a href="{{ route('one-category', ['id' => $news->id_category] )  }}">{{ $news->category->title }}</a> <br>
                                            @foreach($news->tags as $tag)
                                                @foreach($tag->statuses as $status)
                                                    <a href="{{ route('one-tag', ['id' => $tag->id_tag] ) }}" class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                                    <br>
                                                @endforeach
                                            @endforeach
                                            <mark><em>{{ $news->author->name }} {{ $news->author->surname }}</em></mark>
                                            <br>
                                            <span class="text-right">Дата публикации: </span><mark>{{ $news->created_at->diffForHumans() }}</mark>
                                        </div>
                                        <div class="col-md-5 text-right align-self-center">
                                            <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="btn btn-primary">Читать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="my-5 text-center">
                    <button class="btn btn-primary">Подгрузить еще</button>
                </div>
            </div>
            <div class="col-md-4 border-left">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection