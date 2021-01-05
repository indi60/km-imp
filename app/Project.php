<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'category_id',
    ];

    public function CategoryProject()
    {
        return $this->hasMany('App\CategoryProject', 'id', 'category_id');
    }

    public function Ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function ProjectAssigned()
    {
        return $this->hasMany('App\ProjectAssigned');
    }
}
