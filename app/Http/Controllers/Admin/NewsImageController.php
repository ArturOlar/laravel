<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsImageController extends Controller
{
    // удаление изображения
    public function deleteImage(Request $request)
    {
        NewsImage::deleteImage($request->id_image);
        return 'Изображение удалено';
    }
}
