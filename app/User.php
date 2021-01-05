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

    public function Role()
    {
        return $this->hasMany('App\Role', 'id', 'role_id');
    }

    public function Job()
    {
        return $this->hasMany('App\Job', 'id', 'job_id');
    }

    public function Ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function ProjectAssigned()
    {
        return $this->belongsTo('App\ProjectAssigned');
    }

    public function Comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function CommentReply()
    {
        return $this->belongsTo('App\CommentReply');
    }
}
