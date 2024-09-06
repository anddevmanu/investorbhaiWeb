<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'tbl_seo_dtl';

    protected $guarded = [];

    public function blog(){
        return $this->belongsTo(Blogs::class);
    }
}
