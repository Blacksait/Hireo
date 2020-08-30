<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function articles(){//множ число
        return $this->belongsToMany(Article::class);
    }
}
