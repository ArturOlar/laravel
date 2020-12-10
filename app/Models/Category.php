<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id_category';
    protected $fillable = ['title'];

    // связь с таблицей новостей
    public function news()
    {
        return $this->hasMany(News::class, 'id_category', 'id_category');
    }
}
