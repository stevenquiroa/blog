<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::where('email','steven@nadd.co')->pluck('id')[0];

    	$post = new Post();
        $post->title = 'Bievenido';
    	$post->slug = 'welcome';
    	$post->content = 'Hola amigo.';
    	$post->status = 'active';
    	$post->user_id = $userId;
		$post->save();  

		$cat = Category::where('slug', 'base')->first();
		$post->categories()->attach($cat);
    }
}
