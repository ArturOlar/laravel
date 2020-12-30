<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tag extends Model
{
    protected $primaryKey = 'id_tag';
    protected $fillable = ['title', 'id_status_view', 'slug'];
    protected $visible = ['id_tag', 'title'];
    
    // сформировать и получить массив с "checked" для отображения на странице редактирования новости
    public static function getTagFromCheked($news)
    {
        $allTags = Tag::all();

        for ($i = 0; $i < count($allTags); $i++){
            foreach ($news->tags as $newsTag){
                if ($allTags[$i]->id_tag == $newsTag->id_tag){

                    if ($allTags[$i]['checked'] == 'minus' || !isset($allTags[$i]['checked'])){
                        $allTags[$i]['checked'] = 'plus';
                    }

                } else {

                    if ($allTags[$i]['checked'] == 'minus' || !isset($allTags[$i]['checked'])){
                        $allTags[$i]['checked'] = 'minus';
                    }
                }
            }
        }
        return $allTags;
    }

    // связь с таблицей новости
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_tag', 'id_tag', 'id_news');
    }

    // связь с таблицей статусов для шаблона
    public function statuses()
    {
        return $this->hasMany(TagStatusView::class, 'id_status', 'id_status_view');
    }
}
