@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все категории --}}
    <div class="container">
        <div class="my-5">
            <form action="{{ route('category.update', ['id' => $category->id_category ]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label><b>ID Категории</b></label>
                    <input name="id_category" type="text" class="form-control" value="{{ $category->id_category }}" disabled>
                </div>

                <div class="form-group">
                    <label><b>Название категории</b></label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $category->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-success" value="Редактировать">
                </div>
            </form>
        </div>
    </div>
@endsection