@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container">
        <div class="my-5">
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Название тега</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="my-3">
                    <label>Цвет текста:</label>
                    <select class="form-control form-control-lg" name="status_view">
                        <option>Выберете цвет тега</option>
                        @foreach($views as $view)
                            <option value="{{ $view->id_status }}">{{ $view->status_view_ru }}</option>
                        @endforeach
                    </select>
                    @error('status_view')
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