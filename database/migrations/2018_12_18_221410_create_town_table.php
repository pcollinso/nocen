<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_town', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state', 255);
            $table->string('state_id', 255);
            $table->string('lga', 255);
            $table->string('lga_id', 255);
            $table->string('town', 255);
            $table->string('abbreviation', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_town');
    }
}
