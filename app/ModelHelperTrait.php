<?php namespace App;
/**
*  Helpers for model class
*/
trait ModelHelperTrait
{
    public function scopeSuperList($query, $search =array())
    {
        $defaults = [
            // 'role' => null, // null, admin, principal, coord, parent, teacher, student
            'limit' => 2, // int 
            'page' => 1, // int
            'sort' => 'desc', // DESC, ASC
            'sortby' => 'id', // id, name, email, created_at, updated_at
            'status' => 'active' // active, inactive, deleted
        ];
        $search = array_merge($defaults, $search);
        $query->where('status', $search['status']);
        $query->orderBy($search['sortby'], $search['sort']);
        return $query->paginate($search['limit']);
    }
}
