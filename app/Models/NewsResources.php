<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsResources extends Model
{
    protected $table = 'news_resources';
    protected $primaryKey = 'id';
    protected $fillable = ['url_resource', 'id_name_site'];

    // связь с таблицей 'сайты для парсинга'
    public function site()
    {
        return $this->belongsTo(NewsResourcesSite::class, 'id_name_site', 'id');
    }
}
