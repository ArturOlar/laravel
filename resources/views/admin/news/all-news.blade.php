@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все новости --}}
    <h3 class="text-center my-5">Все новости</h3>
    <div class="mx-5 my-5">
        <table class="table table-bordered">
            <thead class="table-info">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Спойлер</th>
                <th scope="col">Категория</th>
                <th scope="col">Автор</th>
                <th scope="col">Теги</th>
                <th scope="col">Статус</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allNews as $news)
                <tr>
                    <th scope="row">{{ $news->id_news }}</th>
                    <td>{!! $news->title !!} ...</td>
                    <td>{!! $news->spoiler !!} ...</td>
                    <td>{{ $news->category->title }}</td>
                    <td>{{ $news->author->name }} {{$news->author->surname }}</td>
                    <td>
                        @foreach($news->tags as $tag)
                            {{ $tag->title }}; <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($news->statuses as $status)
                            {{ $status->title }}; <br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{ route('news.edit', ['id' => $news->id_news ]) }}" class="btn btn-warning mt-2">Редактировать</a>
                        <form action="{{ route('news.destroy', ['id' => $news->id_news]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger mt-2" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="justify-content-center d-flex">
        {{ $allNews->links() }}
    </div>
@endsection