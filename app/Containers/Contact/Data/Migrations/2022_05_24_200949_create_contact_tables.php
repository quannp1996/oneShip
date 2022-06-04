<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->increments('id');
            $table->string('shop_name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('contacts_field', function (Blueprint $table) {

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
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contacts_field');
    }
}
