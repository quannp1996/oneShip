<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersAddressTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_address', function (Blueprint $table) {
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
