@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 bg-white">
                <h2 class="my-5 text-center">Все Теги</h2>
                <div class="row">
                    @foreach($allTags as $tag)
                        <div class="col-md-6 text-center border py-5">
                            <h4 class="mb-4">Категория: {{ $tag->title }}</h4>
                            <a href="{{ route('one-tag', ['id' => $tag->slug]) }}"
                               class="btn btn-primary">Смотреть все новости</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 border-left bg-white">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection