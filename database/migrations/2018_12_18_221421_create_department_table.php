<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->string('department_name', 200)->nullable();
            $table->string('department_abbrv', 50)->nullable();
            $table->string('department_code', 100)->nullable();
            $table->bigInteger('entered_by')->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','programme_id','faculty_id','department_name'], 'DUPLICATE_RECORD');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('sch_faculty')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_department');
    }
}
