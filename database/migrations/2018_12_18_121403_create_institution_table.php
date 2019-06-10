<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_institution', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_code', 20);
            $table->string('institution_name', 45);
            $table->integer('institution_type_id');
            $table->string('logo', 45)->nullable();
            $table->string('address', 125)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('lga', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 165)->nullable();
            $table->string('terminal_id', 100)->nullable();
            $table->boolean('course_staff_same_department')->default('1');
            $table->boolean('course_staff_same_faculty')->default('1');
            $table->boolean('course_staff_same_programme')->default('1');
            $table->boolean('course_staff_same_institution')->default('1');
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->boolean('active')->default('1');
            $table->timestamps();
            $table->unique('institution_code', 'DUPLICATE_INSTITUTION_CODE');
            $table->unique('institution_name', 'DUPLICATE_INSTITUTION_NAME');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_institution');
    }
}
