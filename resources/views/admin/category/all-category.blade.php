@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.news.news-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    {{-- все категории --}}
    <div class="container">
        <h3 class="text-center my-5">Все категории</h3>
        <table class="table my-5 table-bordered">
            <thead class="table-info">
            <tr>
                <th scope="col">ID категории</th>
                <th scope="col">Назва категории</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allCategory as $category)
                <tr>
                    <th scope="row">{{ $category->id_category }}</th>
                    <td>{{ $category->title }}</td>
                    <td>
                        <div class="row justify-content-around">
                            <a href="{{ route('category.edit', ['id' => $category->id_category ]) }}" class="btn btn-warning">Редактировать</a>

                            {{-- модальное окно при удалении категории --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory">Удалить</button>
                            <div class="modal fade" id="deleteCategory">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">ВНИМАНИЕ!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Извините, пока удалять категорию нельзя</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection