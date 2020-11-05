<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'article';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title', 'url','content','summary','published_date'
    ];



}
