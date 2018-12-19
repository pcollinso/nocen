<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLgaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_lga', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('state_id');
            $table->integer('country_id');
            $table->string('entered_by', 50);
            $table->string('last_modified_by', 50);
            $table->timestamps();
            $table->unique(['name','state_id'], 'DUPLICATE_RECORD');
            $table->index('id');
            $table->dropPrimary('sup_lga_id_primary');
            $table->primary(['id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_lga');
    }
}
