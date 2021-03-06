<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAssigned extends Model
{
    protected $table = 'project_assigneds';
    protected $fillable = [
        'project_id',
        'assigned_to_user',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function assigned_to()
    {
        return $this->hasOne('App\User', 'id', 'assigned_to_user');
    }
}
