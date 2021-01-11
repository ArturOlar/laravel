@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">

            {{-- контент страницы --}}
            <div class="col-md-8 bg-white">

                {{-- карточка с новостью --}}
                <div class="my-5 border-bottom">
                    <h2 class="text-center my-5">{!! $news->title !!}</h2>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <span>Автор статьи </span>
                            <mark class="text-left"><em>{{ $news->author->name }}</em>
                            </mark>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="text-right">Дата публикации: </span>
                            <mark>{{ $news->created_at->diffForHumans() }}</mark>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <span><b>Категория:</b> <a
                                        href="{{ route('one-category', ['slug' => $news->category->slug]) }}">{{ $news->category->title }}</a></span>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            @foreach($news->tags as $tag)
                                @foreach($tag->statuses as $status)
                                    <a href="{{ route('one-tag', ['slug' => $tag->slug] ) }}"
                                       class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    {{-- первое описание к новости --}}
                    <div>
                        <p id="one-news-content" class="my-5">{!! $news->content !!}</p>
                    </div>

                    {{-- изображение к новости --}}
                    @isset($news->image_url)
                    @if( substr($news->image_url, 0, 4) == 'http')
                        <div class="row justify-content-center mb-5">
                            <img class="mr-2 mb-2 float-left news-image" src="{{ $news->image_url }}" alt="img">
                        </div>
                    @else
                        <div class="row justify-content-center mb-5">
                            <img class="mr-2 mb-2 float-left news-image"
                                 src="{{ asset('/storage/' . $news->image_url) }}" alt="img">
                        </div>
                    @endif
                    @endisset
                </div>

                {{-- форма для отзыва  --}}
                @auth()
                <div class="my-3 border-bottom">
                    <h3 class="text-center my-3">Оставить коментарий о новости</h3>
                    <div>

                        <div class="form-group text-center">
                            <textarea class="form-control" id="review" rows="3"></textarea>
                            <input type="hidden" id="idNews" value="{{ $news->id_news }}">
                            <input type="button" onclick="addReview('1')" class="btn btn-success my-3"
                                   value="Отправить">
                        </div>

                    </div>
                </div>
                @endauth

                {{-- если пользователь не авторизирован, то форму он не видит --}}
                @guest()
                <h4 class="text-center my-5 pb-5 border-bottom">Что-бы оставить коментарий, Вам нужно
                    авторизироваться</h4>
                @endguest

                {{-- все коментарии --}}
                <div class="my-3 border-bottom">
                    @foreach($reviews as $review)
                        @if(empty($review))
                            <h4 class="text-center my-5">Коментариев пока нет...</h4>
                        @else
                            @if($review->id_status == '2')
                                <div class="py-3 border-top">
                                    <div class="row">
                                        <div class="col-md-8 border-right">
                                            <p class=""><b>{{ $review->content }}</b></p>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Имя: <b>{{ $review->user->name }}</b></span> <br>
                                            <span>{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>

                {{--модальное окно при успешной отправке отзыва на сервер--}}
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Спасибо за отзыв</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Отзыв появиться на сайте после одобрения модератором</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{--модальное окно при ошибках в отправке отзыва на сервер--}}
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ошибка</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="errorModalMessage"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- правый сайдбар страницы --}}
            <div class="col-md-4 border bg-white">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection