<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_general_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->timestamps();
            $table->unique(['institution_id','course_id','department_id','level_id','semester_id'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_general_course');
    }
}
