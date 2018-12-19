<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAdvicerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_course_advicer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id');
            $table->bigInteger('department_id');
            $table->bigInteger('level_id');
            $table->bigInteger('staff_id');
            $table->bigInteger('entered_by')->nullable();
            $table->bigInteger('last_modified_by')->nullable();

            $table->integer('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','department_id','level_id','staff_id'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_course_advicer');
    }
}
