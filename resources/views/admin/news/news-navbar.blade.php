<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto">
            <div class="collapse navbar-collapse" id="navbarNews">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarNews" role="button"
                       data-toggle="dropdown">Новости</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('news.create') }}">Создать новость</a>
                        <a class="dropdown-item" href="{{ route('news.index') }}">Все новости (просмотр, редактирование
                            и удаление)</a>
                    </div>
                </li>
            </div>

            <div class="collapse navbar-collapse" id="navbarCategory">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarCategory" role="button"
                       data-toggle="dropdown">Категории</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('category.create') }}">Создать категорию</a>
                        <a class="dropdown-item" href="{{ route('category.index') }}">Все категории (просмотр, редактирование и удаление)</a>
                    </div>
                </li>
            </div>

            <div class="collapse navbar-collapse" id="navbarTag">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarTag" role="button"
                       data-toggle="dropdown">Теги</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('tag.create') }}">Создать тег</a>
                        <a class="dropdown-item" href="{{ route('tag.index') }}">Все теги (просмотр, редактирование и удаление)</a>
                    </div>
                </li>
            </div>

            <div class="collapse navbar-collapse" id="navbarAuthor">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarAuthor" role="button"
                       data-toggle="dropdown">Авторы</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('author.create') }}">Создать автора</a>
                        <a class="dropdown-item" href="{{ route('author.index') }}">Все авторы (просмотр, редактирование и удаление)</a>
                    </div>
                </li>
            </div>

            <div class="collapse navbar-collapse" id="navbarStatus">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarStatus" role="button"
                       data-toggle="dropdown">Статусы</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('status.create') }}">Создать статус</a>
                        <a class="dropdown-item" href="{{ route('status.index') }}">Все статусы (просмотр, редактирование и удаление)</a>
                    </div>
                </li>
            </div>
        </ul>

    </div>
</nav>
