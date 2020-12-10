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
                <li class="nav-item">
                    <a class="nav-link" href="#">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">Админка</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>--}}
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