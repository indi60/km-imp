<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';
    protected $fillable = [
        'name',
        'color',
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
