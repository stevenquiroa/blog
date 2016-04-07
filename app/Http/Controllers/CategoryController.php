<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Category;
use App\Post;

use Auth;

class CategoryController extends Controller
{
	protected $rules = [
		'title' => ['required', 'string'],
		'slug' => ['required', 'string', 'max:15'],
		'description' => ['present', 'string'],
	];

    public function index(Request $request){
    	$inputs = $request->only(['limit','sort','sortby','status']);
        $inputs = array_filter($inputs);
        
        $categories = Category::search($request->input('title'))->superList($inputs);

        $inputs['title'] = $request->input('title');

        $url = '';
        foreach($inputs as $key => $value){
            $url .= '&' . $key . '='. $value;
        }

        return view('admin.categories.index', [
            'categories' => $categories, 
            'next'=> ($categories->hasMorePages()) ? $categories->nextPageUrl() . $url : null,
            'previous' => ($categories->currentPage() > 1) ? $categories->previousPageUrl() . $url : null,
            'inputs' => $inputs,
        ]);
    }

    public function create(){
    	return view('admin.categories.create');
    }

    public function store(Request $request){
    	$this->rules['slug'][] = 'unique:categories';
    	$this->validate($request, $this->rules);

    	$category = new Category();
    	$category->title = $request->input('title');
    	$category->slug = $request->input('slug');
    	$category->description = $request->input('description');
    	$category->status = 'active';
    	$category->user_id = Auth::id();
    	$category->save();

    	return redirect(action('CategoryController@index'));
    }

    public function show($id){
    	$category = Category::find($id);
    	return view('admin.categories.show', ['category' => $category]);
    }

    public function edit($id){
    	$category = Category::find($id);
    	return view('admin.categories.edit', [
    		'category' => $category,
    	]);
    }

    public function update(Request $request, $id){
    	$this->rules['slug'][] = 'unique:categories,slug,'. $id;
    	$this->validate($request, $this->rules);

    	$category = Category::find($id);
    	$category->title = $request->input('title');
    	$category->slug = $request->input('slug');
    	$category->description = $request->input('description');
    	$category->status = $request->input('status');
    	$category->user_id = Auth::id();
    	$category->save();

    	return redirect(action('CategoryController@show', ['id' => $id]));
    }
}

