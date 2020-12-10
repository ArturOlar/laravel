@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">
            <form action="{{ route('status.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Название статуса</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Название статуса на английском</label>
                    <input name="title_en" type="text" class="form-control @error('title_en') is-invalid @enderror" value="">
                    @error('title_en')
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