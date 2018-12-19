<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgCoordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_prog_coord', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id');
            $table->bigInteger('programme_id');
            $table->bigInteger('staff_id');
            $table->bigInteger('entered_by');
            $table->bigInteger('last_modified_by');
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','programme_id'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_prog_coord');
    }
}
