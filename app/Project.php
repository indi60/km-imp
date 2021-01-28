<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'category_id',
        'status_article_id',
    ];

    public function category_project()
    {
        return $this->hasMany('App\CategoryProject', 'id', 'category_id');
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket',  'project_id');
    }

    public function project_assigned()
    {
        return $this->hasMany('App\ProjectAssigned', 'project_id');
    }

    public function status_article()
    {
        return $this->hasMany('App\StatusArticle', 'id', 'status_article_id');
    }
}
