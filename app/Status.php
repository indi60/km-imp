<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'name',
        'color',
    ];

    public function Ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
