<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	use ModelHelperTrait;
    public function scopeSearch($query, $string = ''){
        if ($string != '') {
            $query->where('title', 'like', '%'.$string.'%');
        }   
        return $query;
    }
    static function getURL($tab){
        switch ($tab->type) {
            case 'post':
                $url = action('PostController@preview', ['id' => $tab->entity_id]);
                break;
            case 'page':
                $url = action('PostController@preview', ['id' => $tab->entity_id]);
                break;
            case 'category':
                $url = action('CategoryController@show', ['id' => $tab->entity_id]);
                break;
            case 'link':
                $url = $tab->url;
                break;
        }

        return $url;
    }
}
