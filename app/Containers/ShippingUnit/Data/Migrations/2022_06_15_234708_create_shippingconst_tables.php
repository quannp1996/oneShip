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
        Schema::create('shipping_services', function (Blueprint $table) {
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('shipping_services');
    }
}
