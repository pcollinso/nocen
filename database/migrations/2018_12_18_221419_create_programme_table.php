<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_programme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id');
            $table->string('programme_name', 200);
            $table->bigInteger('entered_by');
            $table->bigInteger('last_modified_by');
            $table->integer('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','programme_name'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_programme');
    }
}
