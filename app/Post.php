<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use ModelHelperTrait;
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
         return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'category_id');
    }
    public function scopeByType($query, $type = ''){
        if ($type != '') {
            $query->where('type', $type);
        }   
        return $query;
    }
    public function scopeSearch($query, $string = ''){
        if ($string != '') {
            $query->where('title', 'like', '%'.$string.'%');
        }   
        return $query;
    }
}
