<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'id_tag';
    protected $fillable = ['title', 'id_status_view'];

    // связь с таблицей новости
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_tag', 'id_tag', 'id_news');
    }

    public function statuses()
    {
        return $this->hasMany(TagStatusView::class, 'id_status', 'id_status_view');
    }
}
