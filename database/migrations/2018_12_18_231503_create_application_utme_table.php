<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationUtmeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_application_utme', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('application_id')->unsigned()->index();
            $table->string('j_regno', 20);
            $table->integer('year');
            $table->integer('sub1')->default('1')->unsigned()->index();
            $table->integer('sub2')->default('1')->unsigned()->index();
            $table->integer('sub3')->default('1')->unsigned()->index();
            $table->integer('sub4')->default('1')->unsigned()->index();
            $table->unsignedDecimal('score1', 4, 2);
            $table->unsignedDecimal('score2', 4, 2);
            $table->unsignedDecimal('score3', 4, 2);
            $table->unsignedDecimal('score4', 4, 2);
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_id')->references('id')->on('sch_application_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub1')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub2')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub3')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub4')->references('id')->on('sch_subject')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_application_utme');
    }
}
