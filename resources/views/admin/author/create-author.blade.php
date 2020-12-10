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
                    <label>Имя автора</label>
                    <input name="name" type="text" class="form-control @error('title') is-invalid @enderror" value="">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Фамилия автора</label>
                    <input name="surname" type="text" class="form-control @error('title') is-invalid @enderror" value="">
                    @error('surname')
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