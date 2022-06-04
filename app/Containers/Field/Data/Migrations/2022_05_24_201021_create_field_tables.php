<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {

            $table->increments('id');
            $table->string('key_name');
            $table->tinyInteger('status');
            $table->string('placeholder');
            $table->string('lable');
            $table->integer('sort_order');
            $table->tinyInteger('is_required');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
