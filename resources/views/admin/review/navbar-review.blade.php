<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('new-review') }}">Новые отзывы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('publish-review') }}">Опубликованые отзывы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('canceled-review') }}">Отмененные отзывы</a>
            </li>
        </ul>

    </div>
</nav>
