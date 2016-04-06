<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug', 15)->unique();
            $table->string('type'); //post or page
            $table->text('content')->nullable();
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')
                 ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
