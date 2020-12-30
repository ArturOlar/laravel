<?php

namespace App\Http\Controllers\Admin\Parser;

use App\Http\Requests\StoreLinkParserRequest;
use App\Models\NewsResources;
use App\Models\NewsResourcesSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParserCRUDController extends Controller
{
    // отобразить форму создания ссылки
    public function allLinksParser()
    {
        return view('admin.parser.all-links-parser', ['sites' => NewsResources::all()]);
    }

    // сохранить ссылку
    public function storeLinkParser(StoreLinkParserRequest $request)
    {
        if (!NewsResources::where('url_resource', $request->link)->exists()) {
            NewsResources::create([
                'url_resource' => $request->link,
                'id_name_site' => $request->site_id
            ]);
            session()->flash('success', 'ссылка успешно создана');
            return redirect()->back();
        } else {
            session()->flash('danger', 'ссылка уже существует');
            return redirect()->back();
        }
    }

    // отобразить форму создания ссылки
    public function createLinkParser()
    {
        return view('admin.parser.create-link-parser', ['sites' => NewsResourcesSite::all()]);
    }

    // редактирование ссылки парсинга
    public function editLinkParser($id)
    {
        return view('admin.parser.edit-link-parser', [
            'link' => NewsResources::find($id),
            'sites' => NewsResourcesSite::all(),
        ]);
    }

    // сохранить редактирование ссылки парсинга
    public function updateLinkParser(StoreLinkParserRequest $request)
    {
        if (!NewsResources::where('url_resource', $request->link)->exists()) {
            NewsResources::create([
                'url_resource' => $request->link,
                'id_name_site' => $request->site_id
            ]);
            session()->flash('success', 'ссылка успешно обновлена');
            return redirect()->back();
        } else {
            session()->flash('danger', 'ссылка уже существует');
            return redirect()->back();
        }
    }

    // удалить ссылку
    public function deleteLinkParser($id)
    {
        NewsResources::where('id', $id)->delete();

        session()->flash('success', 'ссылка удалена');
        return redirect()->back();
    }
}
