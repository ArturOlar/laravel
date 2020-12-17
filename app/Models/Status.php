<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'id_status';
    protected $table = 'status';
    protected $fillable = ['title', 'title_en'];

    // связь с таблицей новостей
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_status', 'id_status', 'id_news');
    }
}
