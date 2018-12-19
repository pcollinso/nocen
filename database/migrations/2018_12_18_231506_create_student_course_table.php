<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_student_course', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('course_id')->unsigned()->index();
            $table->bigInteger('student_id')->unsigned()->index();
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('batch_id')->unsigned()->index();
            $table->decimal('ca', 10, 2)->default('0.00');
            $table->decimal('assignment', 10, 2)->default('0.00');
            $table->decimal('exam', 10, 2)->default('0.00');
            $table->decimal('score', 10, 2)->default('0.00');
            $table->string('grade_a_id', 2);
            $table->integer('point')->default('0');
            $table->decimal('score_point', 10, 2)->default('0.00');
            $table->boolean('pass_status')->default('0');
            $table->boolean('status')->default('1');
            $table->string('entered_by', 50);
            $table->string('last_modified_by', 50);
            $table->timestamps();
            $table->unique(['student_id','course_id','batch_id','institution_id'], 'duplicate_record');

            $table->foreign('course_id')->references('id')->on('sch_course')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('sch_student_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('batch_id')->references('id')->on('sch_batch')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_student_course');
    }
}
