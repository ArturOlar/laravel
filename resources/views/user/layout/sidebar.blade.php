<div>
    <h5 class="text-center my-3"><a class="text-danger" href="{{ route('news-by-status', ['id' => 'novosti_dnya']) }}">Новости дня</a></h5>
    @foreach($newsByStatus['novosti_dnya'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['slug' => $news['slug']]) }}" class="text-dark">{!! $news['title'] !!}</a></h5>
            <p>
                @isset($news->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['slug' => $news->slug]) }}" class="text-dark">{!! $news['spoiler'] !!}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger"><a class="text-danger" href="{{ route('news-by-status', ['id' => 'vazhnoe']) }}">Важное</a></h5>
    @foreach($newsByStatus['vazhnoe'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['slug' => $news['slug']]) }}" class="text-dark">{!! $news['title'] !!}</a></h5>
            <p>
                @isset($news->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['slug' => $news->slug]) }}" class="text-dark">{!! $news['spoiler'] !!}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger"><a class="text-danger" href="{{ route('news-by-status', ['id' => 'novye']) }}">Новые новости</a></h5>
    @foreach($newsByStatus['novye'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['slug' => $news['slug']]) }}" class="text-dark">{!! $news['title'] !!}</a></h5>
            <p>
                @isset($news->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['slug' => $news->slug]) }}" class="text-dark">{!! $news['spoiler'] !!}</a>
            </p>
        </div>
    @endforeach
</div>
<div>
    <h5 class="text-center my-3 text-danger"><a class="text-danger" href="{{ route('news-by-status', ['id' => 'samye_chitaemye']) }}">Самые читаемые</a></h5>
    @foreach($newsByStatus['samye_chitaemye'] as $news)
        <div class="border-top border-bottom my-2 py-3">
            <h5><a href="{{ route('one-news', ['slug' => $news['slug']]) }}" class="text-dark">{!! $news['title'] !!}</a></h5>
            <p>
                @isset($news->image_url)
                    <img class="w-25 mr-2 mb-2 float-left" src="{{ asset('storage/' . $news->image_url) }}" alt="img">
                @endisset
                <a href="{{ route('one-news', ['slug' => $news->slug]) }}" class="text-dark">{!! $news['spoiler'] !!}</a>
            </p>
        </div>
    @endforeach
</div>