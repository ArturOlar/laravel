@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">

            {{-- контент страницы --}}
            <div class="col-md-8 bg-white">

                {{-- карточка с новостью --}}
                <div class="my-5 border-bottom">
                    <h2 class="text-center my-5">{{ $news->title }}</h2>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <span>Автор статьи </span>
                            <mark class="text-left"><em>{{ $news->author->name }} {{ $news->author->surname }}</em>
                            </mark>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="text-right">Дата публикации: </span><mark>{{ $news->created_at->diffForHumans() }}</mark>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <span><b>Категория:</b> <a href="{{ route('one-category', ['id' => $news->category->id_category]) }}">{{ $news->category->title }}</a></span>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            @foreach($news->tags as $tag)
                                @foreach($tag->statuses as $status)
                                    <a href="{{ route('one-tag', ['id' => $tag->id_tag] ) }}"
                                       class="{{ $status->status_view }}">{{ $tag->title }}</a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    {{-- первое описание к новости --}}
                    <p class="my-5">{!! $news->content !!}</p>

                    {{-- первое изображение к новости --}}
                    @isset($news->images[0]->image_url)
                        <div class="row justify-content-center mb-5">
                            <img class="mr-2 mb-2 float-left news-image"
                                 src="
                                 @if(substr($news->images[0]->image_url, 0, 5) == 'https') {{ $news->images[0]->image_url }}
                                 @else {{ asset('storage/' . $news->images[0]->image_url) }}
                                 @endif"
                                 alt="img">
                        </div>
                    @endisset

                    {{-- второе описание к новости --}}
                    <p class="my-5">{{ $news->content_second }}</p>

                    {{-- второе изображение к новости --}}
                    <div class="row justify-content-center mb-5">
                        @isset($news->images[1]->image_url)
                        <img class="mr-2 mb-2 float-left news-image"
                             src="{{ asset('storage/' . $news->images[1]->image_url) }}"
                             alt="img">
                        @endisset
                    </div>
                </div>

                {{-- форма для отзыва --}}
                <div class="my-3 border-bottom">
                    <h3 class="text-center my-3">Оставить отзыв о новости:</h3>
                    <div>

                        <div class="form-group text-center">
                            <textarea class="form-control" id="review" rows="3"></textarea>
                            <input type="hidden" id="idNews" value="{{ $news->id_news }}">
                            <input type="button" onclick="addReview('1')" class="btn btn-success my-3"
                                   value="Отправить">
                        </div>

                    </div>
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

                {{-- все отзывы --}}
                <div class="my-3 border-bottom">
                    <h3 class="text-center my-3">Все отзывы:</h3>
                    @foreach($news->reviews as $review)
                        @if($review->id_status == '2')
                            <div class="py-3 border-top">
                                <div class="row">
                                    <div class="col-md-8 border-right">
                                        <p class="">{{ $review->content }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <span>Имя пользователя</span>
                                        <span>Дата отзыва</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- правый сайдбар страницы --}}
            <div class="col-md-4 border bg-white">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection