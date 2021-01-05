<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'name',
        'about'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Article()
    {
        return $this->belongsTo('App\Article');
    }
}
