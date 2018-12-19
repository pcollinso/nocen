<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_olevel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('olevel_name', 100);
            $table->integer('status')->default('1');
            $table->unique('olevel_name', 'unique_olevel_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_olevel');
    }
}
