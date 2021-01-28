<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'user_id',
        'role_id',
        'project_id',
        'title',
        'content',
        'author_name',
        'author_email',
        'assigned_to_user',
        'status_id',
        'priority_id',
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function assigned_to()
    {
        return $this->hasMany('App\User', 'id', 'assigned_to_user');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function project_has_many()
    {
        return $this->hasMany('App\Project', 'id', 'project_id');
    }

    public function status()
    {
        return $this->hasMany('App\Status', 'id', 'status_id');
    }

    public function priority()
    {
        return $this->hasMany('App\Priority', 'id', 'priority_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
