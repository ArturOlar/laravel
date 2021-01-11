<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreStatusRequest;
use App\Models\News;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allStatuses = Status::all();
        return view('admin.status.all-status', [
            'allStatuses' => $allStatuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.create-status');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequest $request)
    {
        Status::create([
            'title' => $request->title,
            'slug' => News::cutTextAndMakeSlug($request->title)
        ]);
        session()->flash('success', 'новый статус успешно создан');
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
        $status = Status::find($id);
        return view('admin.status.edit-status', [
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStatusRequest $request, $id)
    {
        Status::where('id_status', $id)->update([
            'title' => $request->title,
            'slug' => News::cutTextAndMakeSlug($request->title)
        ]);
        session()->flash('success', 'статус обновлен');
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
