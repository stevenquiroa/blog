<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function tabs()
    {
        return $this->belongsToMany('App\Menu', 'menu_tabs', 'location', 'id');
    }
}
