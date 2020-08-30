<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    //    protected $table1 = 'category';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function tags(){//множ число
        return $this->belongsToMany(Tag::class);
    }

    public function jobs(){//множ число
        return $this->belongsToMany(Job::class);
    }

    public function categories(){//множ число
        return $this->belongsToMany(Category::class);
    }

//    public function categories(){//множ число
//        return $this->hasMany('App\Category' , 'category_id');//поиск вложенных пунктов
//    }


    public function user(){
     return $this->belongsTo('App\User');
    }

}
