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
            $table->string('surname', 200)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('middle_name', 200)->nullable();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('phone', 20);
            $table->string('email', 200);
            $table->dateTime('dob')->nullable();
            $table->boolean('is_disabled')->default('0');
            $table->integer('nationality_id')->unsigned()->index();
            $table->integer('state_id')->unsigned()->index();
            $table->integer('lga_id')->unsigned()->index();
            $table->integer('town_id')->unsigned()->index();
            $table->integer('religion_id')->unsigned()->index();
            $table->string('stud_resaddr', 300);
            $table->string('stud_passport', 200);
            $table->boolean('verified')->default('0');
            $table->string('username', 45);
            $table->string('user_password', 300)->nullable();
            $table->string('temp_password', 300)->nullable();
            $table->tinyInteger('first_login')->default('0')->comment('1: First login ; 0: not logged in ever; 2: has used account');
            $table->string('hash_code', 55);
            $table->dateTime('hash_code_sent_on');
            $table->string('email_link', 255);
            $table->boolean('email_validated')->default('0');
            $table->boolean('phone_validated')->default('0');
            $table->dateTime('email_validated_on');
            $table->dateTime('phone_validated_on');
            $table->boolean('active')->default('0');
            $table->string('reactivation_reason', 255);
            $table->string('deactivation_reason', 255);
            $table->boolean('biometric_status')->default('0');
            $table->string('biometric_by', 45);
            $table->dateTime('biometric_on');
            $table->boolean('is_password_reset')->default('0');
            $table->string('entered_by', 50);
            $table->string('last_modified_by', 50);
            $table->integer('student_bio_status')->default('1');
            $table->string('auth_code', 255);
            $table->string('mobile_token', 255);
            $table->boolean('locked')->default('0');
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
