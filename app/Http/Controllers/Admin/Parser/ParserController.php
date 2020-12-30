<?php

namespace App\Http\Controllers\Admin\Parser;

use App\Models\Parser112;
use App\Models\ParserKorrespondent;
use App\Models\ParserNewsru;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{
    // отобразить все парсингы
    public function allParsers()
    {
        return view('admin.parser.all-parsers');
    }

    // парсинг сайта РБК-Украина
    public function parserRBC()
    {
        $objParser = new ParserRBC();
        $objParser->parser();
        return redirect()->back();
    }

    // парсинг сайта 112.ua
    public function parser112()
    {
        $objParser = new Parser112();
        $objParser->parser();
        return redirect()->back();
    }

    // парсинг сайта Корреспондент
    public function parserKorrespondent()
    {
        $objParser = new ParserKorrespondent();
        $objParser->parser();
        return redirect()->back();
    }

    // парсинг сайта Newsru
    public function ParserNewsru()
    {
        $objParser = new ParserNewsru();
        $objParser->parser();
        return redirect()->back();
    }
}
