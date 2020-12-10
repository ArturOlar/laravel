@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все категории --}}
    <div class="container">
        <div class="my-5">
            <form action="{{ route('tag.update', ['id' => $tag->id_tag ]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>ID Тега</label>
                    <input name="id_tag" type="text" class="form-control" value="{{ $tag->id_tag }}" disabled>
                </div>

                <div class="form-group">
                    <label>Название тега</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $tag->title }}">
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