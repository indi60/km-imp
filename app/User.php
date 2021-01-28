<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'jenis_kelamin',
        'role_id',
        'job_id',
        'alamat',
        'no_hp',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasMany('App\Role', 'id', 'role_id');
    }

    public function job()
    {
        return $this->hasMany('App\Job', 'id', 'job_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function project_assigned()
    {
        return $this->hasMany('App\ProjectAssigned', 'assigned_to_user');
    }

    public function project()
    {
        return $this->hasMany('App\Project', 'assigned_to_user');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function comment_reply()
    {
        return $this->belongsTo('App\CommentReply');
    }
}
