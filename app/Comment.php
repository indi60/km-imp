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

    public function User()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function Ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function CommentReply()
    {
        return $this->hasMany('App\CommentReply');
    }
}
