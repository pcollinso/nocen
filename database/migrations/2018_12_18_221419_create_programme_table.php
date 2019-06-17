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
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->string('programme_name', 200);
            $table->boolean('require_jamb')->default('1');
            $table->boolean('require_result_check_fee')->default('1');
            $table->boolean('require_application_fee')->default('1');
            $table->boolean('require_acceptance_fee')->default('1');
            $table->boolean('require_school_fee')->default('1');
            $table->bigInteger('entered_by')->nullable();
            $table->timestamps();
            $table->unique(['institution_id','programme_name'], 'DUPLICATE_RECORD');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
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
