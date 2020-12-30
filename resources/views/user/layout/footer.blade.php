<div class="bg-dark mt-5">
    <div class="container">
        <div class="row text-white">
            <div class="col-md-3 mt-5 pd-5">
                <h5>Все категории</h5>
                <ul>
                    @foreach($categoriesFooter as $category)
                        <li><a class="text-white"
                               href="{{ route('one-category', ['id' => $category->id_category ]) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mt-5 pd-5">
                <h5>Все теги</h5>
                <ul>
                    @foreach($tagsFooter as $tag)
                        <li><a class="text-white"
                               href="{{ route('one-tag', ['id' => $tag->id_tag ]) }}">{{ $tag->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mt-5 pd-5">
                <h5>Новости по статусу</h5>
                <ul>
                    @foreach($newsByStatusFooter as $news)
                        <li><a class="text-white" href="{{ route('news-by-status', ['id' => $news->id_status ]) }}">{{ $news->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mt-5 pd-5">
                <h5>Наши авторы</h5>
                <ul>
                    @foreach($authors as $author)
                        <li>{{ $author->name }} {{ $author->surname }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row mt-5 py-5 border-top">
            <div class="col-md-4">
                <p class="text-white">Все права защищены &copy; {{ date('Y') }}</p>
            </div>
            <div class="col-md-4">
                <span class="text-white">Контакты: </span>
                <br>
                <span class="text-white">+380 123 456 789; </span>
                <span class="text-white">+380 987 654 321</span>
            </div>
            <div class="col-md-4">
                <span class="text-white">Email: </span>
                <br>
                <span class="text-white">test@test.gmail.com</span>
            </div>
        </div>
    </div>
</div>