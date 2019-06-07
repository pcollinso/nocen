<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_faculty', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->string('faculty_name', 255)->nullable();
            $table->string('faculty_code', 255)->nullable();
            $table->string('faculty_abbrv', 50)->nullable();
            $table->bigInteger('entered_by')->nullable();
            $table->bigInteger('last_modified_by')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','faculty_name','programme_id'], 'DUPLICATE_RECORD');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_faculty');
    }
}
