<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state', 45);
            $table->string('abreviation', 10);
            $table->integer('country_id')->unsigned()->index();
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->timestamps();

            $table->unique('state', 'DUPLICATE_COUNTRY');
            $table->foreign('country_id')->references('id')->on('sup_country')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_state');
    }
}
