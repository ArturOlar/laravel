@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.parser.parser-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container my-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ссылка</th>
                <th scope="col">Сайт</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sites as $site)
                <tr>
                    <th scope="row">{{ $site->id }}</th>
                    <td>{{ $site->url_resource }}</td>
                    <td>{{ $site->site->name_site }}</td>
                    <td>
                        <a href="{{ route('edit-link-parser', ['id' => $site->id]) }}" class="btn btn-danger">Редактировать</a>
                        <a href="" class="btn btn-warning">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection