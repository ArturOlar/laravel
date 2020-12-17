<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('news.index') }}">NEWS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">Управление новостями</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('new-review') }}">Управление отзывами</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-users') }}" class="nav-link">Управление пользователями</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-parsers') }}" class="nav-link">Парсинг</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-news') }}" class="nav-link">На сайт</a>
                </li>
            </ul>
        </div>
    </div>
</nav>