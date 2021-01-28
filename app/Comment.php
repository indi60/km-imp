<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'ticket_id',
        'author_name',
        'author_email',
        'comment_text',
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function comment_reply()
    {
        return $this->hasMany('App\CommentReply');
    }
}
