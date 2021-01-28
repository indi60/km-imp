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

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function project()
    {
        return $this->belongsTo('App\project');
    }
}
