@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.review.navbar-review')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 text-center border-right">
                <h5>Парсинг сайта "РБК-Украина" </h5><a href="{{ route('parser-rbc') }}" class="btn btn-primary mt-3">Парсить</a>
            </div>
            <div class="col-md-4 text-center">
                <h5>Парсинг сайта "112.ua" </h5><a href="{{ route('parser-112') }}" class="btn btn-primary mt-3">Парсить</a>
            </div>
            <div class="col-md-4 text-center border-left">
                <h5>Парсинг сайта "Корреспондент" </h5><a href="{{ route('parser-korrespondent') }}" class="btn btn-primary mt-3">Парсить</a>
            </div>
        </div>
    </div>
@endsection