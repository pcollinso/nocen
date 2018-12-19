<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamOfficerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_exam_officer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('staff_id')->nullable();
            $table->string('department_name', 200)->nullable();
            $table->string('department_abbrv', 50)->nullable();
            $table->string('department_code', 100)->nullable();
            $table->bigInteger('entered_by')->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','department_id'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_exam_officer');
    }
}
