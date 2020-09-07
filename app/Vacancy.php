<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    public function tags(){//множ число
        return $this->belongsToMany(Tag::class);
    }

    public function jobs(){//множ число
        return $this->belongsToMany(Job::class);
    }

    public function categories(){//множ число
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
