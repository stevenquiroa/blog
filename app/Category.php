<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use ModelHelperTrait;
    public function posts()
    {
         return $this->belongsToMany('App\Post', 'category_post', 'category_id', 'post_id');
    }
    public function scopeSearch($query, $string = ''){
        if ($string != '') {
            $query->where('title', 'like', '%'.$string.'%');
        }   
        return $query;
    }
}
