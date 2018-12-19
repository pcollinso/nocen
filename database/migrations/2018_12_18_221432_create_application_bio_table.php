<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationBioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_application_bio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->string('regno', 20);
            $table->string('j_regno', 20);
            $table->string('stud_surname', 200)->nullable();
            $table->string('stud_first_name', 200)->nullable();
            $table->string('stud_middle_name', 200)->nullable();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('stud_phone', 20);
            $table->string('stud_email', 200);
            $table->dateTime('stud_dob')->nullable();
            $table->boolean('is_disabled')->default('0');
            $table->integer('nationality_id')->unsigned()->index();
            $table->integer('state_id')->unsigned()->index();
            $table->integer('lga_id')->unsigned()->index();
            $table->integer('town_id')->unsigned()->index();
            $table->integer('religion_id')->unsigned()->index();
            $table->string('stud_resaddr', 200)->nullable();
            $table->string('stud_passport', 200)->nullable();
            $table->boolean('verified')->default('0');
            $table->string('username', 45)->nullable();
            $table->string('user_password', 300)->nullable();
            $table->string('temp_password', 300)->nullable();
            $table->tinyInteger('first_login')->default('0')->comment('1: First login ; 0: not logged in ever; 2: has used account');
            $table->string('hash_code', 55)->nullable();
            $table->dateTime('hash_code_sent_on')->nullable();
            $table->string('email_link', 255)->nullable();
            $table->boolean('email_validated')->default('0');
            $table->boolean('phone_validated')->default('0');
            $table->dateTime('email_validated_on')->nullable();
            $table->dateTime('phone_validated_on')->nullable();
            $table->boolean('active')->default('0');
            $table->string('reactivation_reason', 255)->nullable();
            $table->string('deactivation_reason', 255)->nullable();
            $table->boolean('biometric_status')->default('0');
            $table->string('biometric_by', 45)->nullable();
            $table->dateTime('biometric_on')->nullable();
            $table->boolean('is_password_reset')->default('0');
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->integer('student_bio_status')->default('1');
            $table->string('auth_code', 255)->nullable();
            $table->string('mobile_token', 255)->nullable();
            $table->boolean('locked')->default('0');
            $table->timestamps();

            $table->unique(['regno','institution_id'], 'duplicate_regno');
            $table->unique(['j_regno','institution_id'], 'duplicate_jamb_regno');
            $table->unique('stud_phone', 'duplicate_phone');
            $table->unique('stud_email', 'duplicate_email');

            $table->foreign('gender_id')->references('id')->on('sch_gender')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('sup_state')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lga_id')->references('id')->on('sup_lga')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('religion_id')->references('id')->on('sch_religion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nationality_id')->references('id')->on('sup_country')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('town_id')->references('id')->on('sup_town')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sch_application_bio');
    }
}
