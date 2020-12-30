<?php

namespace App\Http\Controllers\Admin\Parser;

use App\Jobs\ParseNews112Job;
use App\Models\NewsResources;
use App\Models\ParserKorrespondent;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParserCronController extends Controller
{
    // парсинг сайта РБК-Украина
    public function parserRBC()
    {
        
    }

    // парсинг сайта 112.ua
    public function parser112()
    {
        $allLinks = NewsResources::select('url_resource')->where('id_name_site', '1')->get();
        foreach ($allLinks as $link) {
            ParseNews112Job::dispatch($link->url_resource);
        }
        return redirect()->back();
    }

    // парсинг сайта Корреспондент
    public function parserKorrespondent()
    {

    }

    // парсинг сайта Newsru
    public function ParserNewsru()
    {

    }
}
