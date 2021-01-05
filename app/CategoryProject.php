<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProject extends Model
{
    protected $table = 'category_projects';
    protected $fillable = [
        'name',
    ];

    public function Project()
    {
        return $this->belongsTo('App\Project');
    }
}
