<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_type extends Model
{
    public function article(){//ед число
        return $this->belongsTo(Article::class , 'id');
    }
}
