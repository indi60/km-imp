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

    public function User()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function AssignedTo()
    {
        return $this->hasMany('App\User', 'id', 'assigned_to_user');
    }

    public function Project()
    {
        return $this->belongsTo('App\Project');
    }

    public function Status()
    {
        return $this->hasMany('App\Status', 'id', 'status_id');
    }

    public function Priority()
    {
        return $this->hasMany('App\Priority', 'id', 'priority_id');
    }

    public function Comment()
    {
        return $this->hasMany('App\Comment');
    }
}
