<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_student_bio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('application_id')->unsigned()->index();
            $table->string('regno', 20);
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('field_id')->unsigned()->index();
            $table->bigInteger('level_id')->unsigned()->index();
            $table->string('surname', 200)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('middle_name', 200)->nullable();
            $table->integer('gender_id')->unsigned()->index()->nullable();
            $table->string('phone', 20);
            $table->string('email', 200);
            $table->date('dob')->nullable();
            $table->boolean('is_disabled')->default('0');
            $table->integer('nationality_id')->unsigned()->index()->nullable();
            $table->integer('state_id')->unsigned()->index()->nullable();
            $table->integer('lga_id')->unsigned()->index()->nullable();
            $table->integer('town_id')->unsigned()->index()->nullable();
            $table->integer('religion_id')->unsigned()->index()->nullable();
            $table->string('resaddr', 200)->nullable();
            $table->string('passport', 200)->nullable();
            $table->string('user_password', 300)->nullable();
            $table->string('temp_password', 300)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->integer('status')->default('1');
            $table->timestamps();
            $table->rememberToken();

            $table->unique(['regno','institution_id'], 'duplicate_regno');
            $table->unique('phone', 'duplicate_phone');
            $table->unique('email', 'duplicate_email');

            $table->foreign('gender_id')->references('id')->on('sch_gender')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('sup_state')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lga_id')->references('id')->on('sup_lga')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('religion_id')->references('id')->on('sch_religion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nationality_id')->references('id')->on('sup_country')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('town_id')->references('id')->on('sup_town')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_id')->references('id')->on('sch_application_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('field_id')->references('id')->on('sch_field')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('sch_level')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_student_bio');
    }
}
