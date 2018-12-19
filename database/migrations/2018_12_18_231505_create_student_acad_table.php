<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAcadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_student_acad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned()->index();
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('batch_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->bigInteger('field_id')->unsigned()->index();
            $table->bigInteger('level_id')->unsigned()->index();
            $table->bigInteger('mode_id')->unsigned()->index();
            $table->bigInteger('entered_by');
            $table->bigInteger('last_modified_by');
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['student_id','institution_id'], 'duplicate_student');

            $table->foreign('student_id')->references('id')->on('sch_student_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('field_id')->references('id')->on('sch_field')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('sch_faculty')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('sch_department')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('sch_level')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mode_id')->references('id')->on('sch_mode')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sch_student_acad');
    }
}
