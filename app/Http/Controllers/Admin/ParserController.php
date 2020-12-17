<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\Parser112;
use App\Models\ParserKorrespondent;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Carbon\Carbon;

class ParserController extends Controller
{
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

    public function parser112()
    {
        $objParser = new Parser112();
        $objParser->parser();
        return redirect()->back();
    }

    public function parserKorrespondent()
    {
        $objParser = new ParserKorrespondent();
        $objParser->parser();
        return redirect()->back();
    }
}
