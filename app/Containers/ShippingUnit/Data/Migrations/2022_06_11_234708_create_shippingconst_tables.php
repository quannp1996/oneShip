<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingconstTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shippingconst', function (Blueprint $table) {
            // $table->increments('id');
            // $table->string('image');
            // $table->tinyInteger('is_dev');
            // $table->tinyInteger('status');
            // $table->text('extra_settings');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('shippingconst');
    }
}
