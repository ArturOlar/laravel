<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    protected $primaryKey = 'id_author';
    protected $table = 'author';
    protected $fillable = ['name'];
    protected $visible = ['name'];
}
