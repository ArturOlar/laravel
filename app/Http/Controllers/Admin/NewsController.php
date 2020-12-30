<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreNewsRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\NewsStatus;
use App\Models\NewsTag;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = News::paginate(20);
        return view('admin.news.all-news', [
            'allNews' => $allNews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategory = Category::all();
        $allAuthors = Author::all();
        $allTags = Tag::all();
        $allStatuses = Status::all();

        return view('admin.news.create-news', [
            'allCategory' => $allCategory,
            'allAuthors' => $allAuthors,
            'allTags' => $allTags,
            'allStatuses' => $allStatuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $idNews = News::createNews($request);
        NewsTag::createTagsForNews($request, $idNews);
        NewsStatus::createStatusesForNews($request, $idNews);

        session()->flash('success', 'новость успешно создана');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $allCategory = Category::all();
        $allAuthors = Author::all();
        $allTags = Tag::getTagFromCheked($news);
        $allStatuses = Status::getStatusFromCheked($news);

        return view('admin.news.edit-news', [
            'news' => $news,
            'allCategory' => $allCategory,
            'allAuthors' => $allAuthors,
            'allTags' => $allTags,
            'allStatuses' => $allStatuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsRequest $request, $id)
    {
        // обновить новость
        News::updateNews($request, $id);

        // оновить теги и статусы новости
        NewsTag::updateTagsForNews($request, $id);
        NewsStatus::updateStatusesForNews($request, $id);

        session()->flash('success', 'новость успешно обновлена');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::where('id_news', $id)->delete();
        NewsTag::deleteTagsForNews($id);
        NewsStatus::deleteStatusesForNews($id);

        session()->flash('success', 'новость удалена');
        return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        News::where('id_news', $request->id_image)->update(['image_url' => '']);
        echo json_encode('Изображение удалено!');
    }
}
