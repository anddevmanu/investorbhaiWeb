<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'tbl_answers';

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
