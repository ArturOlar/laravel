<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsImage extends Model
{
    protected $primaryKey = 'id_image';
    protected $table = 'news_image';
    protected $fillable = ['id_news', 'image_url'];

    // создание изображений к новости (используется при создании новости)
    public static function createImagesForNews(Request $request, $id)
    {
        if ($request->hasFile('images')){

            foreach ($request->file('images') as $image){
                $names[] = $image->store('images', 'public');
            }

            for ($i = 0; $i < count($names); $i++) {
                NewsImage::create([
                    'id_news' => $id,
                    'image_url' => $names[$i]
                ]);
            }
        }
        return;
    }

    // создание изображений к новости (используется при парсере новостей)
    public static function createImagesForNewsParser($urlImage, $newsId)
    {
        NewsImage::create([
            'id_news' => $newsId,
            'image_url' => $urlImage,
        ]);
        return;
    }

    // удаление изображения
    public static function deleteImage($id)
    {
        NewsImage::where('id_image', $id)->delete();
        return;
    }
}
