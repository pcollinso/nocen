<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentNofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_student_nof', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('student_id')->unsigned()->index();
            $table->string('nok_surname', 45);
            $table->string('nok_first_name', 45);
            $table->string('nok_middle_name', 45)->nullable();
            $table->bigInteger('relationship_id')->unsigned()->index();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->boolean('locked')->default('0');
            $table->timestamps();

            $table->unique(['institution_id','student_id','nok_surname','nok_first_name','nok_middle_name','relationship_id','gender_id'], 'DUPLICATE_RECORD');

            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('relationship_id')->references('id')->on('sup_relationships')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('sch_gender')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('sch_student_bio')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_student_nof');
    }
}
