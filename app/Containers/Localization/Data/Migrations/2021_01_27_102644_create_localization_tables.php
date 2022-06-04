<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizationTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->increments('language_id');
            $table->string('name');
            $table->string('short_code');
            $table->string('code');
            $table->string('locale');
            $table->string('image');
            $table->string('directory');
            $table->smallInteger('sort_order');
            $table->tinyInteger('status');
            $table->tinyInteger('is_default');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('language');
    }
}
