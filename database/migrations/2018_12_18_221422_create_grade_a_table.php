<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_grade_a', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade_name', 100);
            $table->integer('grade_range');
            $table->integer('point_for_1')->default('1');
            $table->integer('point_for_2')->default('1');
            $table->integer('point_for_3')->default('1');
            $table->integer('point_for_4')->default('1');
            $table->integer('point_for_5')->default('1');
            $table->integer('point_for_6')->default('1');
            $table->integer('point_for_7')->default('1');
            $table->string('remark', 30)->nullable();
            $table->string('pass_status', 20)->nullable();
            $table->unique('grade_name', 'unique_grade_a_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_grade_a');
    }
}
