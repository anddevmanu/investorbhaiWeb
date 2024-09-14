<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'tbl_comments';

    protected $fillable = [
        'user_id', 'post_id', 'answer_id', 'blog_id', 'type', 'body', 'status'
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public static function types()
    {
        return ['post', 'answer', 'blog'];
    }
}
