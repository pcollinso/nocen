<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 45);
            $table->string('abreviation', 10);
            $table->string('entered_by', 50);
            $table->string('last_modified_by', 50)->nullable();
            $table->timestamps();
            $table->unique('country', 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_country');
    }
}
