<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all-parsers') }}">Парсер</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('create-link-parser') }}">Создать ссылку для парсинга</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all-links-parser') }}">Все ссылки парсинга</a>
            </li>
        </ul>

    </div>
</nav>
