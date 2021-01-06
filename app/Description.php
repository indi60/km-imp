<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = 'descriptions';
    protected $fillable = [
        'desc',
    ];
}
