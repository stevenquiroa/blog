<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	use ModelHelperTrait;
    public function tabs()
    {
        return $this->belongsToMany('App\Menu', 'menu_tabs', 'location', 'id');
    }
}
