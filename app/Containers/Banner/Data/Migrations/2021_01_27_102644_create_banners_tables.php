<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order');
            $table->integer('is_mobile');
            $table->integer('status');
            $table->string('position');
            $table->integer('category_id');
            $table->time('publish_at');
            $table->string('icon');
            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('banner_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id');
            $table->integer('language_id');
            $table->string('name');
            $table->text('short_description');
            $table->string('image');
            $table->string('link');
            $table->text('item');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('banner');
        Schema::dropIfExists('banner_description');
    }
}
