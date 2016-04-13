<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Menu;
use App\Post;
use Auth;
use DB;

class MenuController extends Controller
{
	protected $rules = [
		'title' => ['required', 'string'],
		'slug' => ['required', 'string', 'max:15'],
	];

    public function index(Request $request){
    	$inputs = $request->only(['limit','sort','sortby','status']);
        $inputs = array_filter($inputs);
        
        $menus = Menu::search($request->input('title'))->superList($inputs);

        $inputs['title'] = $request->input('title');

        $url = '';
        foreach($inputs as $key => $value){
            $url .= '&' . $key . '='. $value;
        }

        return view('admin.menus.index', [
            'menus' => $menus, 
            'next'=> ($menus->hasMorePages()) ? $menus->nextPageUrl() . $url : null,
            'previous' => ($menus->currentPage() > 1) ? $menus->previousPageUrl() . $url : null,
            'inputs' => $inputs,
        ]);
    }

    public function create(){
    	return view('admin.menus.create');
    }

    public function store(Request $request){
    	$this->rules['slug'][] = 'unique:menus';
    	$this->validate($request, $this->rules);

    	$menu = new Menu();
    	$menu->title = $request->input('title');
    	$menu->slug = $request->input('slug');
    	$menu->status = 'active';
    	$menu->save();

        $tabs = $request->input('tabs_menu');
        $tabs = json_decode($tabs);
        if ($tabs) {
            foreach ($tabs as $t) {
                $url = Menu::getURL($t);
                DB::table('menu_tabs')->insert([
                    'id' => $t->id,
                    'name' => $t->name,
                    'type' => $t->type,
                    'url' => $url,
                    'location' => $menu->id,
                    'order' => $t->order,
                    'entity_id' => $t->entity_id,
                    'parent' => $t->parent
                ]);
            }
        }
    	return redirect(action('MenuController@index'));
    }

    public function show($id){
    	$menu = Menu::find($id);
    	return view('admin.menus.show', ['menu' => $menu]);
    }

    public function edit($id){
    	$menu = Menu::find($id);
    	return view('admin.menus.edit', [
    		'menu' => $menu
        ]);
    }

    public function update(Request $request, $id){
    	$this->rules['slug'][] = 'unique:menus,slug,'. $id;
    	$this->validate($request, $this->rules);

    	$menu = Menu::find($id);
    	$menu->title = $request->input('title');
    	$menu->slug = $request->input('slug');
    	$menu->status = $request->input('status');
    	$menu->save();

        $tabs = $request->input('tabs_menu');
        $tabs = json_decode($tabs);

        $aux = DB::table('menu_tabs')->where('location', $menu->id)->get();
        $delete = DB::table('menu_tabs')->where('location', $menu->id)->delete();

        foreach ($tabs as $t) {
            $url = Menu::getURL($t);
            DB::table('menu_tabs')->insert([
                'id' => $t->id,
                'name' => $t->name,
                'type' => $t->type,
                'url' => $url,
                'location' => $menu->id,
                'order' => $t->order,
                'entity_id' => $t->entity_id,
                'parent' => $t->parent
            ]);
        }
    	return redirect(action('MenuController@show', ['id' => $id]));
    }

    public function getJson($id){
        $tabs = DB::table('menu_tabs')->where('location', $id)->orderBy('order')->get();
        return response()->json($tabs, 200);
    }
}

