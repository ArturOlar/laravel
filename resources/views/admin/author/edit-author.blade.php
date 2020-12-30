@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все категории --}}
    <div class="container">
        <div class="my-5">
            <form action="{{ route('author.update', ['id' => $author->id_author ]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label><b>ID Автора</b></label>
                    <input name="id_author" type="text" class="form-control" value="{{ $author->id_author }}" disabled>
                </div>

                <div class="form-group">
                    <label><b>Имя и Фамилия автора</b></label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $author->name) }}">
                    @error('name')
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