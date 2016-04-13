<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Post;
use Auth;
use Validator;

class PostController extends Controller
{
	protected $rules = [
		'title' => ['required', 'string'],
		'slug' => ['required', 'string', 'max:15'],
		'content' => ['present', 'string'],
		'type' => ['required', 'regex:(post|page)'],
		'categories' => ['array'],
		'categories.*' => ['integer'],
	];

    public function index(Request $request){
    	$inputs = $request->only(['limit','sort','sortby','status']);
        $inputs = array_filter($inputs);
        
        $posts = Post::byType($request->input('type'))->search($request->input('title'))->superList($inputs);

        $inputs['type'] = $request->input('type');
        $inputs['title'] = $request->input('title');

        $url = '';
        foreach($inputs as $key => $value){
            $url .= '&' . $key . '='. $value;
        }

        return view('admin.posts.index', [
            'posts' => $posts, 
            'next'=> ($posts->hasMorePages()) ? $posts->nextPageUrl() . $url : null,
            'previous' => ($posts->currentPage() > 1) ? $posts->previousPageUrl() . $url : null,
            'inputs' => $inputs,
        ]);
    }

    public function create(){
    	$cats = Category::get();
    	return view('admin.posts.create', ['categories'=>$cats]);
    }

    public function store(Request $request){
    	$this->rules['slug'][] = 'unique:posts';
    	$this->validate($request, $this->rules);

    	$post = new Post();
    	$post->title = $request->input('title');
    	$post->slug = $request->input('slug');
    	$post->content = $request->input('content');
    	$post->type = $request->input('type');
    	$post->status = 'active';
    	$post->user_id = Auth::id();
    	$post->save();

    	if ($categories = $request->input('categories') and !empty($categories)) {
	    	foreach ($categories as $c) {
	    		$post->categories()->attach($c);
	    	}
    	}

    	return redirect(action('PostController@index'));
    }

    public function preview($id){
    	$post = Post::find($id);
    	return view('admin.posts.preview', ['post' => $post]);
    }

    public function edit($id){
    	$post = Post::find($id);
    	$cats_in = [];
    	foreach ($post->categories as $c) {
    		$cats_in[] = $c->id;
    	}
    	$cats = Category::get();
    	return view('admin.posts.edit', [
    		'categories'=>$cats,
    		'post' => $post,
    		'categories_in' => $cats_in
    	]);
    }

    public function update(Request $request, $id){
    	$this->rules['slug'][] = 'unique:posts,slug,'. $id;
    	$this->validate($request, $this->rules);

    	$post = Post::find($id);
    	$post->title = $request->input('title');
    	$post->slug = $request->input('slug');
    	$post->content = $request->input('content');
    	$post->type = $request->input('type');
    	$post->status = $request->input('status');
    	$post->user_id = Auth::id();
    	$post->save();

    	$post->categories()->detach();
    	if ($categories = $request->input('categories') and !empty($categories)) {
	    	foreach ($categories as $c) {
	    		$post->categories()->attach($c);
	    	}
    	}

    	return redirect(action('PostController@preview', ['id' => $id]));
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['string'],
            'type' => ['regex:(post|page|category)'],
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'field_validation', 'message' => 'Algun campo estas enviando mal'], 400);
        }

        if ($request->input('type') == 'category') {
            $posts = Category::where('status', 'active')->search($request->input('title'))->take(5)->get(['id', 'slug', 'title']);
        } else {
            $posts = Post::byType($request->input('type'))->where('status', 'active')->search($request->input('title'))->take(5)->get(['id', 'slug', 'title']);
        }

        return response()->json($posts, 200);
    }
}

