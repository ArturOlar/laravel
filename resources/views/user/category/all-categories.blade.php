@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="my-5">
                    @foreach($allCategories as $category)
                        <div class="border-top border-bottom py-5 my-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="pl-2">Категория: {{ $category->title }}</p>
                                </div>
                                <div class="text-center col-md-5">
                                    <a href="{{ route('one-category', ['id' => $category->id_category]) }}" class="btn btn-primary">Смотреть все новости</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </h2>
                <div class="row">

                </div>
            </div>
            <div class="col-md-4 border-left">
                @include('user.layout.sidebar')
            </div>
        </div>
    </div>
@endsection