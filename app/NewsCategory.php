<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    protected $fillable = [
        'title',
        'desc',
    ];

    public function news()
    {
        return $this->hasMany('App\News', 'cat_id');
    }


    public function latestNews($take = 5)
    {
        return $this->news()->latest()->take($take);
    }
}
