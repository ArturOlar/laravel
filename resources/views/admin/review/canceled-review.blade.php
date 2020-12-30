@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.review.navbar-review')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все категории --}}
    <h3 class="text-center my-5">Отмененные отзывы</h3>
    <table class="table table-bordered mx-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Id отзыва</th>
            <th scope="col">Id пользователя</th>
            <th scope="col">Имя пользователя</th>
            <th scope="col">Отзыв</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <th scope="row">{{ $review->id_news }}</th>
                <td>{{ $review->id_user }}</td>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->content }}</td>
                <td>
                    <form action="{{ route('add-to-publish-review') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_review" value="{{ $review->id_review }}">
                        <button class="btn btn-success">Опубликовать</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection