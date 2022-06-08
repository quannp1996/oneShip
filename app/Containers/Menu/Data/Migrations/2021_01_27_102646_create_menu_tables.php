<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('extra_link');
            $table->integer('sort_order');
            $table->tinyInteger('status');
            $table->integer('pid');
            $table->string('perm');
            $table->tinyInteger('type');
            $table->tinyInteger('no_follow');
            $table->tinyInteger('newtab');
            $table->string('icon');
            $table->timestamps();
        });

        Schema::create('menu_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('language_id');
            $table->string('name');
            $table->string('short_description');
            $table->string('image');
            $table->string('link');
            $table->string('description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_description');
    }
}
