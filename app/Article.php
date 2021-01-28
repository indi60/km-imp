<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'user_id',
        'job_id',
        'author_name',
        'author_email',
        'title',
        'content',
        'status_article_id'
    ];

    public function job()
    {
        return $this->hasMany('App\Job', 'id', 'job_id');
    }

    public function status_article()
    {
        return $this->hasMany('App\StatusArticle', 'id', 'status_article_id');
    }
}
