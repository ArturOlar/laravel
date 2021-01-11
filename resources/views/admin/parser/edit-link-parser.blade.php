@extends('admin.layout.layout')

@section('content')
    {{-- навигация по управлению новостей --}}
    @include('admin.parser.parser-navbar')

    {{-- подключение сообщений --}}
    @include('admin.alert.alert')

    <div class="container my-5">
        <div class="mb-5">
            <span>
                Вы можете создать ссылку, только если в списке <b>"Выберете сайт"</b> есть сайт, который нужен. <br>
                Если нужного сайта в списке нет - обратитесь к разработчику.
            </span>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('store-link-parser') }}" method="POST">
            @csrf
            <div class="form-group">
                <label><b>Редактировать</b></label>
                <input name="link" type="text" class="form-control" value="{{ $link->url_resource }}">
            </div>
            <div class="form-group">
                <label><b>Выберете сайт</b></label>
                <select name="site_id" class="custom-select custom-select-lg mb-3">
                    @foreach($sites as $site)
                        @if($site->id == $link->id_name_site)
                            <option value="{{ $site->id }}" selected>{{ $site->name_site }}</option>
                        @else
                            <option value="{{ $site->id }}">{{ $site->name_site }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection