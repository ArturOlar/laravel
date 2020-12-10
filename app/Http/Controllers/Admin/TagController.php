<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use App\Models\TagStatusView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTags = Tag::all();
        return view('admin.tag.all-tag', [
            'allTags' => $allTags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $views = TagStatusView::all();
        return view('admin.tag.create-tag', [
            'views' => $views
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        Tag::create([
            'title' => $request->title,
            'id_status_view' => $request->status_view
        ]);
        session()->flash('success', 'новый тег успешно создан');
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
        $tag = Tag::find($id);
        return view('admin.tag.edit-tag', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTagRequest $request, $id)
    {
        Tag::where('id_tag', $id)->update([
            'title' => $request->title
        ]);
        session()->flash('success', 'тег обновлен');
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
        //
    }
}
