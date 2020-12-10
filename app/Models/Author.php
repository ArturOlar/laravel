<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'id_author';
    protected $table = 'author';
    protected $fillable = ['name', 'surname'];
}
