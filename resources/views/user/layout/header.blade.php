<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('all-news') }}">NEWS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('all-news') }}">Все новости</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('all-categories') }}">Все Категории</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item active">
                        <a class="nav-link"
                           href="{{ route('one-category', ['id' => $category->id_category]) }}">{{ $category->title }}</a>
                    </li>
                @endforeach

                {{-- авторизация и регистрация --}}
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                </li>

                {{--@if (Route::has('register'))--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                    {{--</li>--}}
                {{--@endif--}}

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{--<a class="dropdown-item" href="{{ route('') }}"></a>--}}
                            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выйти</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                @foreach($tags as $tag)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('one-tag', ['id' => $tag->id_tag]) }}">{{ $tag->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>