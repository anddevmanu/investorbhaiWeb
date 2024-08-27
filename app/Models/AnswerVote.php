<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    use HasFactory;

    protected $table = 'tbl_answers';

    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
