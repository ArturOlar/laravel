<div>
    <h5 class="text-center my-3 text-danger">Новости дня</h5>
    @foreach($newsByStatus['news_day'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['id' => $news['id_news']]) }}" class="text-dark">{{ $news['title'] }}</a></h5>
            <p>
                @isset($news->images[0]->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->images[0]->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news['spoiler'] }}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger">Важное</h5>
    @foreach($newsByStatus['important'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['id' => $news['id_news']]) }}" class="text-dark">{{ $news['title'] }}</a></h5>
            <p>
                @isset($news->images[0]->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->images[0]->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news['spoiler'] }}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger">Новые новости</h5>
    @foreach($newsByStatus['new'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['id' => $news['id_news']]) }}" class="text-dark">{{ $news['title'] }}</a></h5>
            <p>
                @isset($news->images[0]->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->images[0]->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news['spoiler'] }}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger">Самые читаемые</h5>
    @foreach($newsByStatus['must_read'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['id' => $news['id_news']]) }}" class="text-dark">{{ $news['title'] }}</a></h5>
            <p>
                @isset($news->images[0]->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->images[0]->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['id' => $news->id_news]) }}" class="text-dark">{{ $news['spoiler'] }}</a>
            </p>
        </div>
    @endforeach
</div>