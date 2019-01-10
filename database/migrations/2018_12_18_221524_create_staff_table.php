<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('verification_no', 20)->comment('staff_code');
            $table->bigInteger('user_id')->default('0');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->string('staff_surname', 100);
            $table->string('staff_first_name', 100);
            $table->string('staff_middle_name', 100);
            $table->string('staff_phone', 15);
            $table->string('staff_email', 200);
            $table->string('staff_passport', 200)->nullable();
            $table->integer('gender_id')->unsigned()->index();
            $table->integer('qualf_id')->unsigned()->index();
            $table->string('username', 45);
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
            $table->boolean('active')->default('1');
            $table->boolean('exit_status')->default('0');
            $table->string('exit_reason', 255)->nullable();
            $table->string('reactivation_reason', 255)->nullable();
            $table->string('deactivation_reason', 255)->nullable();
            $table->boolean('biometric_status')->default('0');
            $table->string('biometric_by', 45)->nullable();
            $table->dateTime('biometric_on')->nullable();
            $table->boolean('is_password_reset')->default('0');
            $table->string('auth_code', 255)->nullable();
            $table->string('mobile_token', 255)->nullable();
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->integer('status')->default('1');
            $table->integer('staff_type_id')->default('1')->unsigned()->index();
            $table->timestamps();
            $table->rememberToken();

            $table->unique(['verification_no','institution_id'], 'duplicate_staff_code');
            $table->unique('staff_phone', 'duplicate_phone');
            $table->unique('staff_email', 'duplicate_email');

            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('sch_faculty')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('sch_department')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('sch_gender')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('qualf_id')->references('id')->on('sch_qualf')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_staff');
    }
}
