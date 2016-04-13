<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug', 15)->unique();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('menu_tabs', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name');
            $table->string('type'); //url, entity
            
            //url
            $table->string('url')->nullable();

            //menu 
            $table->integer('location')->unsigned();
            $table->integer('order');
            //if tab have a parent
            $table->string('parent')->nullable();

            $table->integer('entity_id');
            //meta from tab
            $table->string('meta')->nullable();
            $table->timestamps();

            $table->foreign('location')->references('id')->on('menus')
                 ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_tabs');
        Schema::drop('menus');
    }
}
