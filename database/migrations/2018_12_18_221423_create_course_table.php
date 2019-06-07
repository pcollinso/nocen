<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->bigInteger('level_id')->unsigned()->index();
            $table->bigInteger('semester_id')->unsigned()->index();
            $table->tinyInteger('course_student_level_id')->default('4')->comment('this is the application level for students taking this course,eg if set to 1 which is department, then only students in same course department can take course');
            $table->tinyInteger('course_staff_level_id')->default('1')->comment('this is the application level for staff teaching this course,eg if set to 1 which is department, then only staff in same course department can teach course');
            $table->string('course_name', 200)->nullable();
            $table->string('course_code', 30)->nullable();
            $table->boolean('is_general')->default('0');
            $table->decimal('unit_load', 4, 2)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->timestamps();
            $table->unique(['institution_id','programme_id','faculty_id','department_id','course_name','course_code'], 'DUPLICATE_COURSE');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('sch_faculty')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('sch_department')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('sch_level')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('semester_id')->references('id')->on('sch_semester')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_course');
    }
}
