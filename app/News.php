<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTags;

class News extends Model
{
    use HasTags;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'desc',
        'text'
    ];

    public function category()
    {
        return $this->belongsTo('App\NewsCategory', 'cat_id');
    }
}
