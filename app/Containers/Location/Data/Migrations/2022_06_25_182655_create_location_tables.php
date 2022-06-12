<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('_geovnprovince', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
        });
        Schema::create('_geovndistrict', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
        });
        Schema::create('_geovnward', function (Blueprint $table) {
            
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('_geovnprovince');
        Schema::dropIfExists('_geovndistrict');
        Schema::dropIfExists('_geovnward');
    }
}
