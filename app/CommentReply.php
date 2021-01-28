<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $table = 'comment_replies';
    protected $fillable = [
        'user_id',
        'comment_id',
        'author_name',
        'author_email',
        'comment_reply_text',
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
