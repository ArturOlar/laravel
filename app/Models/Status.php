<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Status extends Model
{
    protected $primaryKey = 'id_status';
    protected $table = 'status';
    protected $fillable = ['title', 'title_en', 'slug'];

    // сформировать и получить массив с "checked" для отображения на странице редактирования новости
    public static function getStatusFromCheked($news)
    {
        $allStatuses = Status::all();

        for ($i = 0; $i < count($allStatuses); $i++){
            foreach ($news->statuses as $newsStatus){
                if ($allStatuses[$i]->id_status == $newsStatus->id_status){

                    if ($allStatuses[$i]['checked'] == 'minus' || !isset($allStatuses[$i]['checked'])){
                        $allStatuses[$i]['checked'] = 'plus';
                    }

                } else {

                    if ($allStatuses[$i]['checked'] == 'minus' || !isset($allStatuses[$i]['checked'])){
                        $allStatuses[$i]['checked'] = 'minus';
                    }
                }
            }
        }
        return $allStatuses;
    }
    
    // связь с таблицей новостей
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_status', 'id_status', 'id_news');
    }
}
