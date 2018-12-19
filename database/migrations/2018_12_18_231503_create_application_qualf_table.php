<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationQualfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_application_qualf', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('application_id')->unsigned()->index();
            $table->string('exam_school', 200)->default('NA');
            $table->integer('olevel_id')->unsigned()->index();
            $table->integer('year');
            $table->string('exam_reg', 50)->default('NA');
            $table->integer('sub1')->default('1')->unsigned()->index();
            $table->integer('sub2')->default('1')->unsigned()->index();
            $table->integer('sub3')->default('1')->unsigned()->index();
            $table->integer('sub4')->default('1')->unsigned()->index();
            $table->integer('sub5')->default('1')->unsigned()->index();
            $table->integer('sub6')->default('1')->unsigned()->index();
            $table->integer('sub7')->default('1')->unsigned()->index();
            $table->integer('sub8')->default('1')->unsigned()->index();
            $table->integer('sub9')->default('1')->unsigned()->index();
            $table->integer('gd1')->unsigned()->index();
            $table->integer('gd2')->unsigned()->index();
            $table->integer('gd3')->unsigned()->index();
            $table->integer('gd4')->unsigned()->index();
            $table->integer('gd5')->unsigned()->index();
            $table->integer('gd6')->unsigned()->index();
            $table->integer('gd7')->unsigned()->index();
            $table->integer('gd8')->unsigned()->index();
            $table->integer('gd9')->unsigned()->index();
            $table->boolean('status')->default('1');
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_id')->references('id')->on('sch_application_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('olevel_id')->references('id')->on('sch_olevel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub1')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub2')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub3')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub4')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub5')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub6')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub7')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub8')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub9')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd1')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd2')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd3')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd4')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd5')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd6')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd7')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd8')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gd9')->references('id')->on('sch_grade_o')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_application_qualf');
    }
}
