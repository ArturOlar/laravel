@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">
            <form action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label><b>Имя и Фамилия автора</b></label>
                    <input name="name" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-success my-3" value="Создать">
                </div>
            </form>
        </div>
    </div>
@endsection