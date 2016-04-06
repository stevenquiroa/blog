<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')
             ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('post_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['category_id', 'post_id']);
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_post');
        Schema::drop('categories');
    }
}
