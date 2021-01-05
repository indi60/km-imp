<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusArticle extends Model
{
    protected $table = 'status_articles';
    protected $fillable = [
        'name',
        'color',
    ];

    public function Article()
    {
        return $this->belongsTo('App\Article');
    }
}
