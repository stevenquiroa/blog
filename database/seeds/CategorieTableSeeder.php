<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$userId = User::where('email','steven@nadd.co')->pluck('id')[0];

    	$category = new Category();
    	$category->title = 'Categoría Base';
    	$category->description = 'Esta es la categoria para los que no estén categorizados';
    	$category->status = 'active';
    	$category->user_id = $userId;
		$category->save();  
    }
}
