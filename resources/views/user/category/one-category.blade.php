@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 bg-white">
                <h2 class="text-center my-5">Все новости категории "{{ $category->title }}"</h2>
                <div class="row justify-content-center">
                    @foreach($newsFromCategory as $news)
                        <div class="card col-md-5 mb-3 mx-3">
                            @isset($news->images[0]->image_url)
                                <div class="py-3">
                                    <img src="{{ asset('storage/' . $news->images[0]->image_url) }}" class="card-img-top" alt="...">
                                </div>
                            @endisset
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news->title }}</a></h5>
                                <p class="card-text"><a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news->spoiler }}</a></p>
                                <div class="row">
                                    <div class="text-left">
                                        {{-- категория --}}
                                        <span>Категория: </span><a href="">{{ $news->category->title }}</a> <br>

                                        {{-- теги --}}
                                        <span>Теги: </span>
                                        @foreach($news->tags as $tag)
                                            @foreach($tag->statuses as $status)
                                                <a href="{{ route('one-tag', ['id' => $tag->id_tag] ) }}" class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                            @endforeach
                                        @endforeach
                                        <br>

                                        {{-- статусы --}}
                                        <span>Статусы: </span>
                                        @foreach($news->statuses as $status)
                                            <a href="{{ route('news-by-status', ['id' => $status->id_status ]) }}">{{ $status->title }}</a>
                                        @endforeach
                                        <br>

                                        {{-- автор и дата --}}
                                        <span>Автор: </span><mark><em>{{ $news->author->name }} {{ $news->author->surname }}</em></mark>
                                        <br>
                                        <span class="text-right">Дата публикации: </span><mark>{{ $news->created_at->diffForHumans() }}</mark>
                                    </div>
                                </div>
                                <div class="text-center align-self-center mt-3">
                                    <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="btn btn-primary">Читать</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- пагинация --}}
                <div class="justify-content-center d-flex border-top pt-5">
                    {{ $newsFromCategory->links() }}
                </div>

                {{-- кнопка 'подгрузить еще' --}}
                @if(isset($_GET['page']))
                    @if($newsFromCategory->lastPage() != $_GET['page'])
                        <div class="my-5 text-center">
                            <button class="btn btn-primary">Подгрузить еще</button>
                        </div>
                    @endif
                @else
                    @if($newsFromCategory->lastPage() != '1')
                        <div class="my-5 text-center">
                            <button class="btn btn-primary">Подгрузить еще</button>
                        </div>
                    @endif
                @endif

            </div>
            <div class="col-md-4 border-left bg-white">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection