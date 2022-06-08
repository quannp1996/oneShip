<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticPageTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('static_page', function (Blueprint $table) {
            //$table->softDeletes();
        });

        Schema::create('static_page_description', function (Blueprint $table) {

            $table->increments('id');
            $table->string('contact_id');
            $table->string('field_id');
            $table->string('value');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('static_page');
        Schema::dropIfExists('static_page_description');
    }
}
